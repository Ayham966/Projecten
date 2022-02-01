<?php
include("../includes/header.inc.php");
include("../config/connection.php");
session_start();
include("function.php");
isAdmin();
$name_err = $desc_err = $years_err = $info_err = $length_err = $genre_err = $age_err ="";
if (isset($_POST['addMovie'])) {
    $count_files = count($_FILES['files']['name']);
    if (!empty($_POST['name']) && !empty($_POST['desc']) &&
        !empty($_POST['year']) && !empty($_POST['checkTeams']) &&
        !empty($_POST['age']) && !empty($count_files) ) {
        $input_name = trim($_POST["name"]);
        if (!empty($input_name)) {
            $name = $input_name;
            $check_name = "SELECT * FROM movies where name=:name";
            $stmt = $conn->prepare($check_name);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                $input_desc = trim($_POST["desc"]);
                if (!empty($input_desc)) {
                    $desc = $input_desc;
                    $year = trim($_POST["year"]);
                    $age = trim($_POST["age"]);
                    $video = trim($_POST["tubeLink"]);
                    $length = $_POST["hours"] . ":" . $_POST["minutes"];
                    $date = date_create($length);
                    $time = date_format($date, 'H:i');

                    // photo code
                    $count_files = count($_FILES['files']['name']);
                    // Loop all files
                    for($i=0;$i<$count_files;$i++){
                        // File name
                        $filename = $_FILES['files']['name'][$i];
                        // Location
                        $target_file = '../upload/'.$filename;
                        // file extension
                        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                        $file_extension = strtolower($file_extension);
                        // Valid image extension
                        $valid_extension = array("png","jpeg","jpg");
                        if(in_array($file_extension, $valid_extension)){
                            // clear path
                            $clearPath = substr($target_file, 3);
                            // Upload file
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
                                // Execute query
                                $insert_movie = $conn->prepare('INSERT INTO movies (name,description,image, path,year, age, video, length) VALUES (?,?,?,?,?,?,?,?);');
                                if ($insert_movie->execute(array($name, $desc, $filename, $clearPath, $year, $age, $video, $time ))) {
                                    $last_id = $conn->lastInsertId();
                                    $genres = $_POST['checkTeams'];
                                    for($i=0; $i < count($genres); $i++) {
                                        $insert_genre = $conn->prepare('INSERT INTO genres_film (FKfilm, FKgenre) VALUES (?,?);');
                                        if ($insert_genre->execute(array($last_id, $genres[$i]))) {
                                            echo '<script>
                                                  setTimeout(function(){ location.href = "../index.php?page=moviesAdmin";});
                                                  </script>';
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
                else {
                    $name_err = "Vul a.u.b. filmpje beschrijven in!.";
                }

            } else {
                $name_err = 'this name is used!';
            }

        }
        else {
            $name_err = "Vul a.u.b. filmpje naam in!.";
        }
    }
    else {
        $name_err = "Please fill all info.";
    }
}
?>
<div class="container-fluid bg-dark ">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center text-danger">Film toevoegen!</h3>
                    <hr class="bg-light">
                    <form action="" method="post" class="text-warning" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Film naam:</h5></label>
                                <input type="text" class="form-control" name="name">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="desc"><h5>Film Beschrijven:</h5></label>
                                <textarea class="form-control" rows="4" name="desc"></textarea>
                                <span class="help-block" style="color: red"><?php echo $desc_err;?></span>
                                <p class="text-muted text-right">Max 200 woorden!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="year"><h5>Jaar:</h5></label>
                                <?php $years = range(1900, strftime("%Y", time())); ?>
                                <select class="form-control w-50" name="year">
                                    <option selected disabled>Selecteer jaar:</option>
                                    <?php foreach($years as $yearsOutput) : ?>
                                        <option value="<?php echo $yearsOutput; ?>"><?php echo $yearsOutput; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block" style="color: red"><?php echo $years_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="length"><h5>Film Lengte:</h5></label>
                                <br>
                                <label for="hours">Uren:</label>
                                <select name="hours" id="hours" class="p-1">
                                    <?php
                                    for ( $i = 0; $i <= 5; $i++)  {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="minutes">Minuten:</label>
                                <select name="minutes" id="minutes" class="p-1">
                                    <?php
                                    for ( $i = 0; $i < 60; $i++)  {
                                        if ( $i < 10 ) {
                                            echo '<option value="'. 0 . $i.'">'. 0 . $i.'</option>';
                                        }
                                        else {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="help-block" style="color: red"><?php echo $length_err;?></span>
                            </div>
                        </div>
                        <span class="help-block" style="color: red"><?php echo $info_err;?></span>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="checkTeams"><h5>Genres:</h5></label><br>
                                <div class="row">
                                    <?php
                                    $sql = "SELECT * FROM genres";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $allTeams = $stmt->fetchAll();
                                    foreach ($allTeams as $row) {
                                        $genreName = $row['name'];
                                        $genreId = $row['id'];
                                        echo'<div class="col-3 p-3 bg-danger m-1 mw-100 rounded position-relative">
                                                <input type="checkbox" name="checkTeams[]" value="'.$genreId.'"/> <b class="p-2">'.$genreName.'</b> <br />   
                                             </div> ';
                                    }
                                    ?>
                                </div>
                                <span class="help-block" style="color: red"><?php echo $genre_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="age"><h5>Leeftijd:</h5></label>
                                <select class="form-control w-50" name="age">
                                    <?php
                                    for ($i = 12; $i <= 23 ; $i++) {
                                        echo '<option value="'.$i.'"> + '.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <span class="help-block" style="color: red"><?php echo $age_err;?></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group w-75">
                            <label for="tubeLink"><h5>Video link:</h5></label>
                                <input type="text" class="form-control" name="tubeLink" placeholder="youtube link...(optioneel)">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="files"><h5>Foto:</h5></label>
                                <div class="col">
                                    <input type="file" name="files[]" multiple />
                                </div>
                        </div>
                        <p class="text-muted">Png, jpeg or jpg</p>

                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <br>
                                <button class="btn btn-md btn-danger px-5" type="submit" name="addMovie"><i class="glyphicon glyphicon-ok-sign"></i> Aanmaken</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>


