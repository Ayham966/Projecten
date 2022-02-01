<?php
include('../private/connection.php');
include("../includes/header.inc.php");
$first_name = $middle_name = $last_name = $street = $house_number = $city = $zip =  "";
$first_err = $middel_err = $last_err = $street_err = $house_err = $city_err = $zip_err = "" ;

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    $input_first = trim($_POST["first_name"]);
    if(empty($input_first)){
        $first_err = "Please enter your first name!.";
    } else{
        $first_name = $input_first;
    }

    $input_middel = trim($_POST["middle_name"]);
    if(empty($input_middel)){
        $middel_err = "Please enter your middle name!.";
    } else{
        $middle_name = $input_middel;
    }

    $input_last = trim($_POST["last_name"]);
    if(empty($input_last)){
        $last_err = "Please enter your last name!.";
    } else{
        $last_name = $input_last;
    }

    $input_house = trim($_POST["house"]);
    if(empty($input_house)){
        $house_err = "Please enter your house number!.";
    } elseif (!ctype_digit($input_house)) {
        $house_err = "Please enter a number.";
    }else{
        $house_number = $input_house;
    }

    $input_zip = trim($_POST["zip"]);
    if(empty($input_zip)){
        $zip_err = "Please enter your zip code!.";
    } else{
        $zip = $input_zip;
    }

    $input_street = trim($_POST["street"]);
    if(empty($input_street)){
        $street_err = "Please enter your street name!.";
    } else{
        $street = $input_street;
    }

    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = "Please enter your city name!.";
    } else{
        $city = $input_city;
    }

    $birth = trim($_POST["birth"]);
    $email = trim($_POST["email"]);



    if(empty($first_err) && empty($middel_err) && empty($last_err)&& empty($street_err)&& empty($house_err)&& empty($city_err)&& empty($zip_err)){
                    $sql = "UPDATE customers SET first=:first, middel=:middel, last=:last, street=:street, house=:house, city=:city, zip=:zip, birth=:birth, email=:email  WHERE id=:id";

                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bindParam(":first", $param_first);
                        $stmt->bindParam(":middel", $param_middel);
                        $stmt->bindParam(":last", $param_last);
                        $stmt->bindParam(":street", $param_street);
                        $stmt->bindParam(":house", $param_house);
                        $stmt->bindParam(":city", $param_city);
                        $stmt->bindParam(":zip", $param_zip);
                        $stmt->bindParam(":birth", $param_birth);
                        $stmt->bindParam(":email", $param_email);
                        $stmt->bindParam(":id", $param_id);

                        $param_first = $first_name;
                        $param_middel = $middle_name;
                        $param_last = $last_name;
                        $param_street = $street;
                        $param_house = $house_number;
                        $param_city = $city;
                        $param_zip = $zip;
                        $param_birth = $birth;
                        $param_email = $email;
                        $param_id = $id;

                        if ($stmt->execute()) {
                            header("location: ../index.php?page=accounts");
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
    $sql = "SELECT * FROM customers WHERE id = :id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $param_id);
        $param_id = $id;

        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $first_name = $row["first"];
                $middle_name = $row["middel"];
                $last_name = $row["last"];
                $street = $row["street"];
                $house_number = $row["house"];
                $city = $row["city"];
                $zip = $row["zip"];
                $birth = $row["birth"];
                $email = $row["email"];

            } else{
                echo "Oops! Something went wrong. Please try again later.";
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
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
                        <h3 style="color: cornflowerblue">Edit account</h3>
                    </div>
                    <hr>
                    <form class="form" action="#" method="post" id="registrationForm">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="first_name"><h4>First name:</h4></label>
                                <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
                                <span class="help-block" style="color: red"><?php echo $first_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="middle_name"><h4>Middle name:</h4></label>
                                <input type="text" class="form-control" name="middle_name" value="<?php echo $middle_name; ?>">
                                <span class="help-block" style="color: red"><?php echo $middel_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="last_name"><h4>Last name:</h4></label>
                                <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
                                <span class="help-block" style="color: red"><?php echo $last_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="birth"><h4>Date of birth:</h4></label>
                                <input type="text" class="form-control" name="birth" readonly value="<?php echo $birth; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Email:</h4></label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="house"><h4>House Number:</h4></label>
                                <input type="text" class="form-control" name="house" value="<?php echo $house_number; ?>">
                                <span class="help-block" style="color: red"><?php echo $house_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="zip"><h4>Zip:</h4></label>
                                <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>">
                                <span class="help-block" style="color: red"><?php echo $zip_err;?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="street"><h4>Street:</h4></label>
                                <input type="text" class="form-control" name="street" value="<?php echo $street; ?>">
                                <span class="help-block" style="color: red"><?php echo $street_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="city"><h4>City:</h4></label>
                                <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                                <span class="help-block" style="color: red"><?php echo $city_err;?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <a class="col-xs-12">
                                <br>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <a href="index.php?page=home"> <button class="btn btn-lg"> Cancel</button> </a>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>