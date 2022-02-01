<?php
session_start();
include("../private/connection.php");
$email = $password = "";
$email_err = $password_err = "";
$msg_err = "Login failed!";

if (isset($_POST['submit_in1']) || (isset($_POST['submit_in2']) )) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT * FROM customers WHERE email = :email";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["id"];
                        $role = $row["role"];
                            if (password_verify($password, $row['password'])) {
                                if ($role == 'klant') {
                                    $_SESSION["klant"] = true;
                                    $_SESSION['loginID'] = $id;
                                    header("location: ../index.php?page=mybooks");
                                }
                                if ($role == 'admin') {
                                    $_SESSION["admin"] = true;
                                    header("location: ../index.php?page=dashboard");
                                }
                            }
                            $password_err = "The password is not correct.";

                    } else {
                        $email_err = "No account found with that email.";
                    }
                } else {
                    $email_err = "No account found with that email.";
                }
                unset($stmt);

            }
            unset($conn);
        }
    }
}
?>
<?php
include("../includes/header.inc.php");
?>
 <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <div class="avatar">
                    <img src="http://localhost/website/images/logo.png" alt="Avatar">
                </div>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <?php
                        echo '<p style="color: red">'.$msg_err.'</p>';
                        echo '<p style="color: red">'.$password_err.'</p>';
                        echo '<p style="color: red">'.$email_err.'</p>';
                            ?>
                        <span>Email:</span>
                        <input type="text" class="form-control" name="email" placeholder="Email.."  required="required">
                    </div>
                    <div class="form-group">
                        <span>Password:</span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">

                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit_in2" class="btn btn-primary btn-lg btn-block login-btn" id="submit-in">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




