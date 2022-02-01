<?php
include("../includes/header.inc.php");
include("../config/connection.php");
session_start();
include("function.php");
isAdmin();

$first = $middle =  $last = $email = $email_err = $name_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $userId = $_POST["id"];
    $input_first = trim($_POST["first"]);
    if(empty($input_first)){
        $name_err = "Vul voornaam in!";
    } else{
        $first = $input_first;
    }

    $middle = trim($_POST["middle"]);

    $input_last = trim($_POST["last"]);
    if(empty($input_last)){
        $name_err = "Vul achternaam in!!";
    } else{
        $last = $input_last;
    }

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Voer e-mail in!.";
    } else{
        $email = $input_email;
    }

    // update the current team
    if(empty($name_err) && empty($email_err) ) {
        $sql = "UPDATE user_details SET first=:first, middle=:middle, last=:last WHERE fkuser=:id";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":first", $first);
            $stmt->bindParam(":middle", $middle);
            $stmt->bindParam(":last", $last);
            $stmt->bindParam(":id", $userId);
            if ($stmt->execute()) {
                $update = "UPDATE users inner join user_details ON users.id = user_details.fkuser SET email=:email WHERE user_details.fkuser=:id";
                $stm = $conn->prepare($update);
                $stm->bindParam(":id", $userId);
                $stm->bindParam(":email", $email);
                if ($stm->execute()) {
                    echo '   <script>
                setTimeout(function(){  location.href = "../index.php?page=users";});
                             </script>';
                    exit();
                }
            } else {
                echo "Er is iets fout gegaan. Probeer het later opnieuw.";
            }
        }
    }

} else{
    $userId = $_GET["id"];
    $sql = $conn->prepare("SELECT * FROM user_details 
    inner JOIN users ON users.id = user_details.fkuser 
    where user_details.fkuser =:id;");
    $sql->bindParam(":id", $userId);
    if($sql->execute()){
        if($sql->rowCount() == 1){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $first = $row["first"];
            $middle = $row["middle"];
            $last = $row["last"];
            $email = $row["email"];
        } else{
            echo "Er is iets fout gegaan. Probeer het later opnieuw.";
            exit();
        }

    } else{
        echo "Er is iets fout gegaan. Probeer het later opnieuw.";
        exit();
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
                    <h3 class="text-center" style="color: cornflowerblue">Gebruiker bewerken:</h3>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Naam Gebruiker:</h5></label>
                                <div class="col p-2">
                                    <label for="first">Voornaam:</label>
                                    <input type="text" class="form-control validate" title="voornaam" name="first" pattern="[A-Za-z]*" value="<?php echo $first; ?>" >
                                </div>
                                <div class="col p-2">
                                    <label for="middle">Tussennaam:</label>
                                    <input type="text" class="form-control" name="middle" title="tussennaam" pattern="[A-Za-z]*" value="<?php echo $middle; ?>">
                                </div>
                                <div class="col p-2">
                                    <label for="last">Achternaam:</label>
                                    <input type="text" class="form-control" name="last" title="achternaam" pattern="[A-Za-z]*" value="<?php echo $last; ?>">
                                </div>

                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Gebruiker email:</h5></label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                                <span class="help-block" style="color: red"><?php echo $email_err;?></span>
                            </div>
                        </div>

                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $userId; ?>">
                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Save</button>
                    </div>
                </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
