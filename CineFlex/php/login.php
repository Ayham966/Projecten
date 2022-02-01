<?php
include("../includes/header.inc.php");
include("../config/connection.php");
session_start();
$msg_err = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE email = :email";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = $email;
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["id"];
                        $roleID = $row["fkrole"];
                        $sql2 = "SELECT * FROM user_role WHERE id =:id";
                        if ($stmt2 = $conn->prepare($sql2)) {
                            $stmt2->bindParam(":id", $roleID, PDO::PARAM_STR);
                            $stmt2->execute();
                            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                            $currentRole = $row2["name"];
                            if (password_verify($password, $row['password'])) {
                                if ($currentRole == 'user') {
                                    $_SESSION["user"] = true;
                                    $_SESSION['loginID'] = $id;
                                    header("location: ../index.php?page=home");
                                }
                                if ($currentRole == 'customer') {
                                    $_SESSION["customer"] = true;
                                    $_SESSION['loginID'] = $id;
                                    header("location: ../index.php?page=home");
                                }
                                if ($currentRole == 'admin') {
                                    $_SESSION['admin'] = true;
                                    $_SESSION['loginID'] = $id;
                                    header("location: ../index.php?page=home");
                                }
                            }
                            $msg_err = "Het wachtwoord is niet correct.";
                        }
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
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-5 mx-auto ">
                <div class="card my-5 card-login bg-light">
                    <div class="card-body p-5">
                        <h5 class="card-title text-center">CineFlex</h5>
                        <span class="help-block" style="color: red;"><?php ?></span>
                        <br>
                        <form method="post" action="">
                            <div class="form-label-group">
                                <label for="inputEmail">Email address:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email address"  autofocus>
                            </div>
                            <br>
                            <div class="form-label-group">
                                <label for="inputPass">Wachtwoord:</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" >
                            </div>
                            <br>
                            <button class="btn btn-danger btn-block text-uppercase" type="submit" name="submit">Login</button>
                            </br>
                            <span class="help-block text-warning"><?php echo $msg_err;?></span>
                            <!--                        <div class="row mb-4 px-3"> <span>Hebt u geen account? <a class="primary" href="index.php?page=register">Register</a></span> </div>-->
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



