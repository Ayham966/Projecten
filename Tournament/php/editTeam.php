<?php
include('../config/connection.php');
include("../includes/head.inc.php");
$name = $name_err =   $shortName_err =  $shortName = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $teamId = $_POST["id"];
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Voer teamnaam in!.";
    } else{
        $name = $input_name;
    }

    $input_shortName = trim($_POST["shortName"]);
    if(empty($input_shortName)){
        $shortName_err = "Voer Team afkorting in!.";
    } else{
        $shortName = $input_shortName;
    }

    // update the current team
    if(empty($name_err) ) {
        $check_name = "SELECT * FROM teams where name=:name";
        $stmt = $conn->prepare($check_name);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0)  {
            $sql = "UPDATE teams SET name=:name, shortName=:short WHERE id=:id";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":short", $shortName);
                $stmt->bindParam(":id", $teamId);
                if ($stmt->execute()) {
                    echo '   <script>
                    setTimeout(function(){  location.href = "../index.php?page=teams#list-item-2";});
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
    $teamId = $_GET["id"];
    $sql = "SELECT * FROM teams WHERE id = :id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $teamId);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $row["name"];
                $shortName = $row["shortName"];
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
                        <h3 class="text-center" style="color: cornflowerblue">Team bewerken:</h3>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Team name:</h5></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Team Afkorting:</h5></label>
                                <input type="text" class="form-control" name="shortName" value="<?php echo $shortName; ?>">
                                <span class="help-block" style="color: red"><?php echo $shortName_err;?></span>
                            </div>
                        </div>

                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $teamId; ?>">
                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Opslaan</button>
                    </div>
                </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
