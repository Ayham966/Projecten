<?php
include('../private/connection.php');

include "confirm.php";

if(isset($_POST['action']) and $_POST['action'] == 'Yes') {
    if (isset($_GET['id'])) {
        $bookID = $_GET['id'];
        //Check if the book is borrowed
        $stmt = $conn->prepare("SELECT * FROM lenen where Fkbook=:found");
        $stmt->bindParam(":found", $bookID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if( !$row ) {
            // if not then delete it
            $query = $conn->prepare("DELETE FROM books WHERE id=:id");
            $query->bindParam(":id", $bookID);
            $query->execute();
            echo '   <script>
                setTimeout(() => { alert("Success, book is Deleted!") }, 1000);
                setTimeout(function(){  location.href = "../index.php?page=product";},3000);
                             </script>';
        }
        else {
            echo "This book is borrowed for a customer, you can not delete it right now!";
        }
    } else {
        echo 'No id founded!';
    }

}
else {
    if(isset($_POST['action']) and $_POST['action'] == 'Cancel') {
        header("location: ../index.php?page=product");

        exit();
    }
}






