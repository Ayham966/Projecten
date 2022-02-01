<?php
if ( $_SESSION['admin'] != true ){
    header("location: index.php");
    exit();
}

$err_msg = "";

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['shortName'])) {
        // check eerst als naam is gebruikt
        $name = trim($_POST["name"]);
        $check_name = "SELECT * FROM teams where name=:name";
        $stmt = $conn->prepare($check_name);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $shortName = trim($_POST["shortName"]);
            $insert_team = $conn->prepare('INSERT INTO teams (name, shortName, image, path) VALUES (?,?,?,?);');
            // photo code
            $count_files = count($_FILES['files']['name']);
            // Loop all files
            for($i=0;$i<$count_files;$i++){
                // File name
                $filename = $_FILES['files']['name'][$i];
                // Location
                $target_file = 'upload/'.$filename;
                // file extension
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
                // Valid image extension
                $valid_extension = array("png","jpeg","jpg");
                if(in_array($file_extension, $valid_extension)){
                    // Upload file
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
                        // Execute query
                        if ($insert_team->execute(array($name, $shortName, $filename,$target_file)) ) {
                            echo '<script>
                              setTimeout(function(){ location.href = "index.php?page=teams#list-item-2";});
                              </script>';
                        }
                    }
                }
             }
        }
        else {
            $err_msg = "Deze naam is al gebruikt!";
        }
    }
    else {
        $err_msg = "Please vul de naam en afkorting!";
    }
}
?>
<div class="row">
    <div class="col-12" id="teams-photo" >
        <div class="overlay"></div>
        <div class="head-text">
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action btn btn-light active" type="button"  href="#list-item-1">
                    Teams Toevoegen
                </a>
                <br>
                <a class="list-group-item list-group-item-action btn btn-info active" type="button"  href="#list-item-2">
                    Teams Bewerken
                </a>
                <br>
            </div>
        </div>
    </div>
</div>
</br> </br> </br> </br>
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h3 id="list-item-1" class="text-center">Team toevoegen</h3>
    </br>
    <div class="text-center w-50 mx-auto border border-info p-5">
        <form action="" method="post" class="teams-add-form" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Naam *" name="name" value=""/>
                </div>
            </div>
        </br> </br>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Afkorting *" name="shortName" value=""/>
                </div>
            </div>
            </br> </br>
            <div class="row">
                <div class="col">
                    <input type="file" name="files[]" multiple />
                </div>
            </div>
            <br><br>
            <input type="submit" class="btnRegister btn-primary active" name="submit"  value="Toevoegen"/>
            <br><br>

            <span style="color: red; font-size: 14pt;"><?php echo $err_msg; ?></span>

        </form>
    </div>
</div>
</br> </br> </br> </br> </br> </br>  </br> </br>
<hr width="100%">
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h3 id="list-item-2" class="text-center">Team Bewerken</h3>
    <?php
    // check if there are teams
    $check = $conn->prepare("SELECT * FROM teams");
    $check->execute();
    $teamTotal= $check->rowCount();
    if ($check->rowCount() > 0) {
    ?>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-12 p-1">
                <h5 class="text-info p-1">Er zijn: <strong class="text-danger"> <?php echo $teamTotal?> </strong>teams gevonden!</h5>
                    <table class="table table-image border table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">foto</th>
                            <th scope="col">Naam</th>
                            <th scope="col">Afkorting</th>
                            <th scope="col">Verwijderen</th>
                            <th scope="col">Bewerken</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM Teams");
                        $stmt->execute();
                        $teams = $stmt->fetchAll();
                        foreach($teams as $row)
                        {
                        ?>
                        <tr>
                            <td class="w-25 h-auto">
                                <img src="<?php echo $row['path']?>" title="<?php echo $row['image']?>" class="img-circle" width="150" height="150" alt="">
                            </td>
                            <td scope="row"><?php echo $row['name']?></td>
                            <td scope="row"><?php echo $row['shortName']?></td>
                            <td><?php echo '<a href="php/deleteTeam.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button> </a>'?></td>
                            <td><?php echo '<a href="php/editTeam.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-info"><i class="fas fa-edit"></i></button> </a>'?></td>
                        </tr>
                        <?php  } ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
                            <?php
                        }
                        else {

                            echo '<br> <p class="font-italic text-center text-danger"> Geen teams gevonden!.</p>';
                        }