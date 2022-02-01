<?php
include("../includes/head.inc.php");
include("../config/connection.php");
session_start();
$email = $password = "";
$email_err = $password_err = "";
$msg_err = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT * FROM users WHERE email = :email";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = $email;
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["id"];
                        $role = $row["role"];
                        if (password_verify($password, $row['password'])) {
                            if ($role == 'user') {
                                $_SESSION["user"] = true;
                                $_SESSION['loginID'] = $id;
                                header("location: ../index.php?page=home");
                            }
                            if ($role == 'admin') {
                                $_SESSION['admin'] = true;
                                header("location: ../index.php?page=home");
                            }
                        }
                        $msg_err = "Het wachtwoord is niet correct.";

                    }
                } else {
                    $msg_err = "Geen account gevonden met dit e-mailadres.";
                }
                unset($stmt);

            }
            unset($conn);
        }
    }
    else {
        $msg_err = "Vul uw inloggegevens in!";
    }
}


?>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<body class="body-login">
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Inloggen</h5>
                    <span class="help-block" style="color: red;"><?php echo $msg_err?></span>
                    <br>
                    <form class="form-signin" method="post" action="">

                        <div class="form-label-group">
                            <label for="inputEmail">E-mailadres</label>
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        </div>
                        </br>
                        <div class="form-label-group">
                            <label for="inputPass">Wachtwoord</label>
                            <input type="password" name="password" id="inputPass" class="form-control" placeholder="Password" required>
                        </div>
                        </br>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Inloggen</button>
                        </br>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>



