<?php
include("../includes/header.inc.php");
include("../config/connection.php");
session_start();
include("function.php");
isAdmin();

$name = $name_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $genreID = $_POST["id"];
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $input_name = trim($_POST["name"]);
        if (empty($input_name)) {
            $name_err = "Voer de naam van de genre in!.";
        } else {
            $name = $input_name;
        }
        // update the current team
        if (empty($name_err)) {
            $check_name = "SELECT * FROM genres where name=:name and id!=:id";
            $stmt = $conn->prepare($check_name);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":id", $genreID, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                $sql = "UPDATE genres SET name=:name WHERE id=:id";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":id", $genreID);
                    if ($stmt->execute()) {
                        echo '   <script>
                    setTimeout(function(){  location.href = "../index.php?page=genres";});
                                 </script>';
                        exit();
                    } else {
                        echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                    }
                }
            } else {
                echo 'Deze naam is al gebruikt!';
            }
        }
    }
} else{

    if(isset($_GET["id"])) {
        $genreID = $_GET["id"];
        $sql = "SELECT * from genres WHERE id=:id";
        if($stmt = $conn->prepare($sql)){
            $stmt->bindParam(":id", $genreID);
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

<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto"><!--right col-->
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center" style="color: cornflowerblue">Edit Genre:</h3>
                    <hr>
                    <?php
                    if(isset($_GET["id"]) && !empty($_GET["id"])) :?>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Genre naam:</h5></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <input type="hidden" name="id" value="<?php echo $genreID; ?>">
                                <button class="btn btn-md btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Opslaan</button>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

