<?php
include('../config/connection.php');
include("../includes/head.inc.php");
$name = $name_err =  $city = $city_err = $street = $street_err = $house = $house_err = $postcode = $postcode_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $stadionId = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Voer de naam 'Stadion' in!.";
    } else{
        $name = $input_name;
    }

    $input_city = trim($_POST["city"]);
    if (empty($input_city)) {
        $city_err = "Voer a.u.b. plaats in!.";
    } else {
        $city = $input_city;
    }

    $input_street = trim($_POST["street"]);
    if (empty($input_street)) {
        $street_err = "Voer straatnaam in!.";
    } else {
        $street = $input_street;
    }

    $input_house = trim($_POST["house"]);
    if (empty($input_house)) {
        $house_err = "Vul a.u.b. uw huisnummer in!.";
    } elseif (!ctype_digit($input_house)) {
        $house_err = "Voer alstublieft een nummer in.";
    } else {
        $house = $input_house;
    }

    $input_postcode = trim($_POST["postcode"]);
    if (empty($input_postcode)) {
        $postcode_err = "Vul a.u.b. postcode in!.";
    } else {
        $postcode = $input_postcode;
    }

    // update the current team
    if(empty($name_err)&&empty($city_err)&&empty($street_err)&&empty($house_err)&& empty($postcode_err) ) {
        $check_name = "SELECT name FROM stadions WHERE name=:name and id NOT IN (:id)";
        $stm = $conn->prepare($check_name);
        $stm->bindParam(":name", $name);
        $stm->bindParam(":id", $stadionId);
        $stm->execute();
        if ($stm->rowCount() == 0) {
            $sql = "UPDATE stadions SET name=:name, city=:city, street=:street, house=:house, postcode=:postcode WHERE id=:id";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":city", $city);
                $stmt->bindParam(":street", $street);
                $stmt->bindParam(":house", $house);
                $stmt->bindParam(":postcode", $postcode);
                $stmt->bindParam(":id", $stadionId);
                if ($stmt->execute()) {
                    echo '   <script>
                setTimeout(function(){  location.href = "../index.php?page=stadions#list-item-2";});
                             </script>';
                    exit();
                } else {
                    echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                }
            }
        }
        else {
            $name_err =  'deze naam is al gebruikt!';
        }
    }

} else{
    $stadionId = $_GET["id"];
    $sql = "SELECT * FROM stadions WHERE id = :id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $stadionId);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $row["name"];
                $city = $row["city"];
                $street = $row["street"];
                $house = $row["house"];
                $postcode = $row["postcode"];
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

<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto"><!--right col-->
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center" style="color: cornflowerblue">Stadion bewerken</h3>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Stadion naam:</h5></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Stadion plaats:</h5></label>
                                <input type="text" class="form-control" placeholder="Plaats *" name="city" value="<?php echo $city; ?>">
                                <span class="help-block" style="color: red"><?php echo $city_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Stadion straatnaam:</h5></label>
                                <input type="text" class="form-control" placeholder="straatnaam *" name="street" value="<?php echo $street; ?>">
                                <span class="help-block" style="color: red"><?php echo $street_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Stadion huisnummer:</h5></label>
                                <input type="text" class="form-control" placeholder="Huisnummer *" name="house" value="<?php echo $house; ?>">
                                <span class="help-block" style="color: red"><?php echo $house_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Stadion postcode:</h5></label>
                                <input type="text" class="form-control" placeholder="Postcode *" name="postcode" value="<?php echo $postcode; ?>">
                                <span class="help-block" style="color: red"><?php echo $postcode_err;?></span>
                            </div>
                        </div>

                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $stadionId; ?>">
                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Opslaan</button>
                    </div>
                </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
