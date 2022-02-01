<?php
include('../private/connection.php');
include "confirm.php";

if(isset($_POST['action']) and $_POST['action'] == 'Yes') {
    if (isset($_GET['id'])) {
        $account = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM customers WHERE id=:id");
        $stmt->bindParam(":id", $account);
        if ($stmt->execute()) {
            echo '   <script>
                setTimeout(() => { alert("Success, account is Deleted!") }, 1000);
                setTimeout(function(){  location.href = "../index.php?page=accounts";},3000);
                             </script>';
    }
        else {
            echo 'Something went wrong!';
        }
    } else {
        echo 'No id founded!';
    }

}
else {
    if(isset($_POST['action']) and $_POST['action'] == 'Cancel') {
        header("location: ../index.php?page=accounts");
        exit();
    }
}






