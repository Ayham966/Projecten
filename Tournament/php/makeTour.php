<?php
include("../includes/head.inc.php");
include("../config/connection.php");
session_start();
if ( $_SESSION['admin'] != true ){
    header("location: ../index.php");
    exit();
}

$name_err = $datum_err = $teams_err = $info_err = "";
if (isset($_POST['tourMake'])) {
    if (!empty($_POST['name']) && !empty($_POST['date'])) {
        $name = trim($_POST['name']);
        $Startdate = trim($_POST['date']);
        $check_name = "SELECT * FROM tournaments where name=:name";
        $stmt = $conn->prepare($check_name);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            if (isset($_POST['checkTeams'])) {
                foreach ($_POST['checkTeams'] as $teams) {
                    $joiner[] = $teams;
                }
                    $total = sizeof($joiner);

                    if (sizeof($joiner) % 2 == 0 && (sizeof($joiner) & (sizeof($joiner) - 1)) == 0) {
                        $total = sizeof($joiner);
                        $insert = $conn->prepare('INSERT INTO tournaments (name,startDate) VALUES (?,?);');
                        if ($insert->execute([$name, $Startdate])) {
                            $tourId = $conn->lastInsertId();
                            shuffle($joiner);
                            $joiners = array_chunk($joiner, 2);
                            foreach ($joiners as $teammate) {
                                $sql = "SELECT * FROM users where role='user'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $row1 = $stmt->fetchAll();
                                $allReferee = array();
                                foreach ($row1 as $referee) {
                                    $allReferee[] = $referee['id'];
                                }
                                shuffle($allReferee);
                                $refers = array_chunk($allReferee, 1);
                                foreach ($refers as $refs) {
                                }

                                $insertMatch = $conn->prepare('INSERT INTO matches (fktour,fkuser,team1,team2, round) VALUES (?,?,?,?,?);');
                                if ($insertMatch->execute([$tourId, $refs[0], $teammate[0], $teammate[1], $total])) {
                                    echo '   <script>
                                        setTimeout(function(){  location.href = "../index.php?page=tournament";});
                                                     </script>';
                                }
                            }
                        }
                    }
                    else {
                        $info_err = sizeof($joiner) . " Teams geselecteed! Het moet een even getal zijn (bijv. 2,4,8,16 of 32)!";
                    }
                }
               else {
                $info_err = "Selecteer deelnemers!";
            }
        }
        else {
            $info_err = "Toernooi naam bestaat al";
        }
    }
    else {
        $info_err = "Vul de naam en de datum van toernooi!";
    }
}


?>
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto"><!--right col-->
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center" style="color: cornflowerblue">Toernooi Maken!</h3>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Toernooi naam:</h5></label>
                                <input type="text" class="form-control" name="name">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Startdatum:</h5></label>
                                <input type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>">
                                <span class="help-block" style="color: red"><?php echo $datum_err;?></span>
                            </div>
                        </div>
                        <span class="help-block" style="color: red"><?php echo $info_err;?></span>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Deelnemers:</h5></label><br>
                                <?php
                                $sql = "SELECT * FROM teams";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $allTeams = $stmt->fetchAll();
                                foreach ($allTeams as $row) {
                                    $teamName = $row['name'];
                                    $teamId = $row['id'];
                                    echo'<input type="checkbox" name="checkTeams[]" value="'.$teamId.'"/> <b>'.$teamName.'</b> <br /> ';
                                }
                                ?>

                                <span class="help-block" style="color: red"><?php echo $teams_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-md btn-success" type="submit" name="tourMake"><i class="glyphicon glyphicon-ok-sign"></i> Aanmaken</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
