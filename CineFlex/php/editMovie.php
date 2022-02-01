<?php
include("../includes/header.inc.php");
include("../config/connection.php");
session_start();
include("function.php");
isAdmin();

$name = $name_err = $desc_err = $years_err = $info_err = $genre_err = $age_err = $length_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $movieID = $_GET["id"];
    $sql = "SELECT * from movies WHERE id=:id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $movieID);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } else{
                echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                exit();
            }

        } else{
            echo "Er is iets fout gegaan. Probeer het later opnieuw.";
            exit();
        }
    }
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $count_files = count($_FILES['files']['name']);
        if (!empty($_POST['name']) && !empty($_POST['desc']) &&
            !empty($_POST['year']) && !empty($_POST['checkTeams']) &&
            !empty($_POST['age']) && !empty($count_files)) {
            $input_name = trim($_POST["name"]);
            if(empty($input_name)){
                $name_err = "Vul voornaam in!";
            } else{
                $name = $input_name;
            }
            if (!empty($name)) {
                $check_name = "SELECT * FROM movies where name=:name and id!=:id";
                $stmt = $conn->prepare($check_name);
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":id", $movieID, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() == 0) {
                    $input_desc = trim($_POST["desc"]);
                    if(empty($input_desc)){
                        $name_err = "Vul beschrijven in!";
                    } else{
                        $desc = $input_desc;
                    }
                    if (!empty($desc)) {
                        $input_year = trim($_POST["year"]);
                        if(empty($input_year)){
                            $years_err = "Vul jaar in!";
                        } else{
                            $year = $input_year;
                        }

                        $genres = $_POST['checkTeams'];
                        $input_genres = $_POST['checkTeams'];
                        if(empty($input_genres)){
                            $genre_err = "Vul genres in!";
                        } else{
                            $genres = $input_genres;
                        }

                        $length =  $_POST["length"];

                        $input_age = trim($_POST["age"]);
                        if(empty($input_age)){
                            $age_err = "Vul leeftijd in!";
                        } else{
                            $age = $input_age;
                        }
                        $length =  $_POST["length"];
                        // photo code
                        $count_files = count($_FILES['files']['name']);
                        // Loop all files
                        for ($i = 0; $i < $count_files; $i++) {
                            // File name
                            $filename = $_FILES['files']['name'][$i];
                            if ( !empty($filename)) {
                                // Location
                                $target_file = '../upload/' . $filename;
                                // file extension
                                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                                $file_extension = strtolower($file_extension);
                                // Valid image extension
                                $valid_extension = array("png", "jpeg", "jpg");
                                if (in_array($file_extension, $valid_extension)) {
                                    // clear path
                                    $clearPath = substr($target_file, 3);
                                    // Upload file
                                    move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file);
                                    $insertedFile = $target_file;
                                    $insertedPath = $clearPath;
                                }
                            }
                            else {
                                $insertedFile = $row['image'];
                                $insertedPath = $row['path'];
                            }
                                    // Execute query
                                    $sql = "UPDATE movies SET name=?, description=?, image=?, path=?, year=?, age=?, length=? WHERE id=?";
                                    $stmt = $conn->prepare($sql);
                                    if ($stmt->execute([$name, $desc, $insertedFile, $insertedPath, $year, $age, $length, $movieID])){
                                        $query = $conn->prepare("DELETE FROM genres_film WHERE FKfilm=:id");
                                        $query->bindParam(":id", $movieID);
                                        if ($query->execute()) {
                                            for ($i = 0; $i < count($genres); $i++) {
                                                $insert_genre = $conn->prepare('INSERT INTO genres_film (FKfilm, FKgenre) VALUES (?,?);');
                                                if ($insert_genre->execute(array($movieID, $genres[$i]))) {
                                                    echo '<script>
                                                  setTimeout(function(){ location.href = "../index.php?page=moviesAdmin";});
                                                  </script>';
                                                }
                                            }
                                        }
                                    }
                        }
                    } else {
                        $desc_err = "Vul filmpje beschrijven in!.";
                    }

                } else {
                    $name_err = 'this name is used!';
                }
            } else {
                $name_err = 'Vul naam in!';
            }
        }
        else {
            $info_err = 'Moet alle info invullen!';
        }
    }
} else{
    if(isset($_GET["id"])) {
        $filmID = $_GET["id"];
        $sql = "SELECT * from movies WHERE id=:id";
        if($stmt = $conn->prepare($sql)){
            $stmt->bindParam(":id", $filmID);
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $name = $row["name"];
                } else{
                    echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                    exit();
                }

            } else{
                echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                exit();
            }
        }
        unset($stmt);
        unset($conn);
    }
}
?>
<div class="container-fluid bg-dark ">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto"><!--right col-->
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center text-info" style="color: cornflowerblue">Film Bewerken!</h3>
                    <hr class="bg-info">
                    <?php if(isset($_GET["id"]) && !empty($_GET["id"])) :?>
                    <form action="" method="post" class="text-warning" enctype="multipart/form-data">
                        <?php if ( $info_err ) : ?>
                        <div class="alert alert-warning" role="alert">
                            <span class="help-block text-danger p-1" style="color: red"><?php echo $info_err;?></span>
                        </div>
                        <?php endif ?>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Film naam:</h5></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="desc"><h5>Film Beschrijven:</h5></label>
                                <textarea class="form-control" rows="4" name="desc"><?php echo $row['description']; ?></textarea>
                                <span class="help-block" style="color: red"><?php echo $desc_err;?></span>
                                <p class="text-muted text-right">Max 200 woorden!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="year"><h5>Jaar:</h5></label>
                                <?php $years = range(1900, strftime("%Y", time())); ?>
                                <select class="form-control w-50" name="year">
                                    <option disabled>Selecteer jaar:</option>
                                    <option value="<?php echo $row['year'] ?>" selected> <?php echo $row['year'] ?> </option>
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
                                <input name="length" type="time" value="<?php  echo $row['length'] ?>">
                                <span class="help-block" style="color: red"><?php echo $length_err;?></span>
                                <br>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="checkTeams"><h5>Genres:</h5></label><br>
                                <div class="row">
                                    <?php
                                    require "../config/connection.php";
                                    $sql = "SELECT * FROM `genres_film` right JOIN genres on genres.id = genres_film.FKgenre where genres_film.FKfilm = :id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(":id", $_GET['id']);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    foreach ($result as $rows) {
                                        echo '<div class="col-3 p-3 bg-danger m-1 mw-100 rounded position-relative">
                                                <input type="checkbox" name="checkTeams[]" value="' . $rows['id'] . '" checked /> <b class="p-2">' . $rows['name'] . '</b> <br />   
                                              </div> ';
                                    }
                                    if (isset($_POST['submitAdd'])) {
                                        $newGenre = $_POST['selectedGenre'];
                                        $sql = "SELECT name FROM genres where id = :id ";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bindParam(":id", $newGenre);
                                        $stmt->execute();
                                        $nameGenre = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo '<div class="col-3 p-3 bg-danger m-1 mw-100 rounded position-relative">
                                                <input type="checkbox" name="checkTeams[]" value="' . $newGenre . '" checked /> <b class="p-2">' . $nameGenre['name'] . '</b> <br />   
                                              </div> ';
                                    }
                                    ?>
                                </div>
                                <br>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">+ Genre toevoegen</button>
                                <span class="help-block" style="color: red"><?php echo $genre_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="age"><h5>Leeftijd:</h5></label>
                                <select class="form-control w-50" name="age">
                                    <option value="<?php echo $row['age'] ?>" selected> + <?php echo $row['age'] ?> </option>
                                    <?php
                                    for ($i = 12; ; $i++) {
                                        if ($i > 23) {
                                            break;
                                        }
                                        echo '<option value="'.$i.'"> + '.$i.'</option>';
                                    }
                                    ?>
                                </select>
                                <span class="help-block" style="color: red"><?php echo $age_err;?></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="files"><h5>Foto:</h5></label>
                            <br>
                            <img src="<?php echo '../' . $row['path']?>" title="<?php echo $row['image']?>" width="300" height="350">
                            <div class="col">
                                <br>
                                <input type="file" name="files[]" multiple />
                            </div>
                        </div>
                        <p class="text-muted">Png, jpeg or jpg</p>

                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <br>
                                <input type="hidden" name="id" value="<?php echo $movieID; ?>">
                                <button class="btn btn-md btn-danger px-5"><i class="glyphicon glyphicon-ok-sign"></i> Annuleren</button>
                                <button class="btn btn-md btn-info px-5" type="submit" name="submit"><i class="glyphicon glyphicon-ok-sign"></i> Bewerken</button>
                            </div>
                        </div>
                    </form>
                    <?php endif;?>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Genre toevoegen:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                        <select class="selectpicker" data-live-search="true" name="selectedGenre" >
                            <?php
                             $sql = "SELECT * FROM genres WHERE Not EXISTS( SELECT id FROM genres_film WHERE genres_film.FKfilm = :id AND genres.id = genres_film.FKgenre)";
                              $stmt = $conn->prepare($sql);
                              $stmt->bindParam(":id", $_GET['id']);
                              $stmt->execute();
                              $results = $stmt->fetchAll();
                              foreach ( $results as $gens)  {
                                 echo '<option  value="'.$gens['id'].'">'.$gens['name'].'</option>';
                              }
                              ?>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    <button type="submit" class="btn btn-danger" name="submitAdd"> Toevoegen </button>
                </div>
            </form>
        </div>
    </div>
</div>