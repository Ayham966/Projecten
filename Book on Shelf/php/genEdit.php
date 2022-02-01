<?php
include('../private/connection.php');
include("../includes/header.inc.php");
$name = $name_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter language name!.";
    } else{
        $name = $input_name;
    }
    if(empty($name_err) ){
        $sql = "UPDATE genres SET name=:name WHERE id=:id";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                header("location: ../index.php?page=genreAndlang");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    }
    unset($conn);

} else{
    $id = $_GET["id"];
    $sql = "SELECT * FROM genres WHERE id = :id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $row["name"];
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
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
                    <div class="col-6 mx-auto">
                        <h3 style="color: cornflowerblue">Edit Genre</h3>
                    </div>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h4>Genre name:</h4></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                    </div>
                </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
