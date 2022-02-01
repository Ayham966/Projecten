<?php
include('../config/connection.php');
include("../includes/head.inc.php");
$name = $name_err =   $date_err =  $date = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $tourID = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Voer toernooien naam in!.";
    } else{
        $name = $input_name;
    }

    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Voer Startdatum in!.";
    } else{
        $date = $input_date;
    }

    // update the current team
    if(empty($name_err) && empty($date_err) ) {
        $check_name = "SELECT * FROM tournaments where name=:name and id NOT IN (:id)";
        $stmt = $conn->prepare($check_name);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":id", $tourID);
        $stmt->execute();
        if ($stmt->rowCount() == 0)  {
            $sql = "UPDATE tournaments SET name=:name, startDate=:date WHERE id=:id";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":date", $date);
                $stmt->bindParam(":id", $tourID);
                if ($stmt->execute()) {
                    echo '   <script>
                    setTimeout(function(){  location.href = "../index.php?page=tournament";});
                                 </script>';
                    exit();
                } else {
                    echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                }
            }
        }
        else {
            echo 'Deze naam is al gebruikt!';
        }
    }
} else{
    $tourID = $_GET["id"];
    $sql = "SELECT * FROM tournaments WHERE id = :id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $tourID);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $row["name"];
                $date = $row["startDate"];
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
?>

<div class="container-lg">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto"><!--right col-->
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center" style="color: cornflowerblue">Toernooi bewerken:</h3>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Toernooi name:</h5></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Toernooi datum:</h5></label>
                                <input type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $date; ?>">
                                <span class="help-block" style="color: red"><?php echo $date_err;?></span>
                            </div>
                        </div>

                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $tourID; ?>">
                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Opslaan</button>
                    </div>
                </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
