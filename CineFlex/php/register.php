<?php
include("../includes/header.inc.php");
include("../config/connection.php");
include("function.php");
isAdmin();

$password =  $email = $role = $repeat = "";
$password_err = $email_err = $role_err = "";

if (isset($_POST['submit'])) {
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Vul je email in!";
    } else {
        $email = $input_email;
    }

    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Vul je wachtwoord in!";
    } else {
        $password = $input_password;
    }

    $input_repeat = trim($_POST["password-repeat"]);
    if (empty($input_repeat)) {
        $repeat_err = "herhaal je wachtwoord!";
    } else {
        $repeat = $input_repeat;
    }

    if (empty($password_err)&& empty($email_err) && empty($repeat_err)) {
        // check if password is repeated correctly
        if ($password == $repeat) {
            // set a hash to password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // connection to check if email is existed
            $sql = "SELECT email FROM users";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['email'] != $email) {
                $sql = $conn->prepare('INSERT INTO users (email, password, fkrole) VALUES (?,?,?);');
                if ($sql->execute([$email, $hash, 2])) {
                    echo '
                                    <script> 
                                  setTimeout(function(){  location.href = "../index.php?page=home";},100);
                              </script> ';
                } else {
                    echo 'Something went wrong!';
                }
            } else {
                $email_err = "This email is already existed!";
            }
        }
        else {
            $repeat_err = "Password does not match!";
        }
    }
    $msg_err = $password_err = $email_err = $repeat_err = "";
}


