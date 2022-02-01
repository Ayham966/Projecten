<?php
$first_name = $middle_name = $last_name = $street = $house_number = $city = $zip = $psw = $psw2 = $psw_correct =  "";
$first_err = $middel_err = $last_err = $street_err = $house_err = $city_err = $zip_err = $psw_err  = $psw2_err = $pass_err = $email_err= "";

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['first'])) {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['first'])) {

            $input_first = trim($_POST["first"]);
            if (empty($input_first)) {
                $first_err = "Please enter your first name!.";
            } else {
                $first_name = $input_first;
            }

            $input_middel = trim($_POST["middle"]);
            if (empty($input_middel)) {
                $middel_err = "Please enter your middle name!.";
            } else {
                $middle_name = $input_middel;
            }

            $input_last = trim($_POST["last"]);
            if (empty($input_last)) {
                $last_err = "Please enter your last name!.";
            } else {
                $last_name = $input_last;
            }

            $input_house = trim($_POST["house"]);
            if (empty($input_house)) {
                $house_err = "Please enter your house number!.";
            } elseif (!ctype_digit($input_house)) {
                $house_err = "Please enter a number.";
            } else {
                $house_number = $input_house;
            }

            $input_zip = trim($_POST["zip"]);
            if (empty($input_zip)) {
                $zip_err = "Please enter your zip code!.";
            } else {
                $zip = $input_zip;
            }

            $input_street = trim($_POST["street"]);
            if (empty($input_street)) {
                $street_err = "Please enter your street name!.";
            } else {
                $street = $input_street;
            }

            $input_city = trim($_POST["city"]);
            if (empty($input_city)) {
                $city_err = "Please enter your city name!.";
            } else {
                $city = $input_city;
            }

            $birth = trim($_POST["birth"]);
            $email = trim($_POST["email"]);

            $input_psw = trim($_POST["password"]);
            if (empty($input_psw)) {
                $psw_err = "Please enter your new password!.";
            } else {
                $psw = $input_psw;
            }

            $input_psw2 = trim($_POST["current_password"]);
            if (empty($input_psw2)) {
                $psw2_err = "Please repeat the password!.";
            } else {
                $psw2 = $input_psw2;
            }
            if (empty($first_err) && empty($middel_err) && empty($last_err) && empty($street_err) && empty($house_err) && empty($city_err) && empty($zip_err)&& empty($psw_err)&& empty($psw2_err)&& empty($pass_err)) {
                if ($psw == $psw2) {
                    $hash = password_hash($psw, PASSWORD_DEFAULT);
                    $sql = "SELECT email FROM customers";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row['email'] != $email) {
                        $sql = $conn->prepare('INSERT INTO customers (first, middel, last, birth, email, password, street, house, city, zip, role) VALUES (?,?,?,?,?,?,?,?,?,?,?);');
                        if ($sql->execute([$first_name, $middle_name, $last_name, $birth, $email, $hash, $street, $house_number, $city, $zip, 'klant'])) {
                            echo '
                                    <div class="fixed-bottom w-100">
                                    <button class="btn btn-primary text-success-50" style="min-width: 100%;" type="button" disabled>
                                 <span class="spinner-border spinner-border" role="status" aria-hidden="true">
                                 </span>
                                 Loading...
                                     </button>   
                                    </div>
                                    <script> 
                                setTimeout(() => { alert("Success, Your new account is added!") }, 2000)
                                  setTimeout(function(){  location.href = "index.php?page=home";},4000);
                              </script> ';
                        } else {
                            echo 'Something went wrong!';
                        }
                    } else {
                        $email_err = "This email is already existed!";
                    }
                }
                else {
                    $pass_err = "Password does not match!";
                }
                }
            }
        }
        else {
            echo "<div class='alert alert-danger alert-dismissible' >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Please fill all information!
                </div>";
        }
    }
    else {
        echo "<div class='alert alert-danger alert-dismissible' >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Please fill all information!
                </div>";
    }

?>

<br>
<br>
<div class="container col-6" id="cusSignup">
    <div class="card bg-light">
        <article class="card-body mx-auto">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p class="divider-text">
                <span class="bg-light">Sign up for free!</span>
            </p>
            <form action="" method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="first" class="form-control" placeholder="First name" type="text" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $first_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i> </span>
                    </div>
                    <input name="middle" class="form-control" placeholder="middle name" type="text" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $middel_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="last" class="form-control" placeholder="Last name" type="text" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $last_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-birthday-cake"></i> </span>
                    </div>
                    <input class="form-control" name="birth" type="date" value="2000-01-01"" required>
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email address" type="email" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $email_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-home"></i> </span>
                    </div>
                    <input name="street" class="form-control" placeholder="Street" type="text" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $street_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-home"></i> </span>
                    </div>
                    <input name="house" class="form-control" placeholder="House-number" type="text" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $house_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                    </div>
                    <input name="city" class="form-control" placeholder="City" type="text" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $city_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-address-book"></i> </span>
                    </div>
                    <input name="zip" class="form-control" placeholder="Zip code" type="text" maxlength="6" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $zip_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="password" placeholder="Create password" type="password" required>
                </div>
                <span class="help-block" style="color: red"><?php echo $psw_err;?></span>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="current_password" placeholder="Repeat password" type="password">
                </div>
                <span class="help-block" style="color: red"><?php echo $psw2_err;?></span>
                <span class="help-block" style="color: red"><?php echo $pass_err;?></span>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"> Create Account  </button>
                </div>
            </form>
        </article>
    </div>

</div>
<br>
<br>