<?php
include('../private/connection.php');
session_start();
if (isset($_POST['yes'])) {
    //Check if user has more than 3 books
    $userId = $_SESSION['loginID'];
    $stmt = $conn->prepare("SELECT
                      *
                    FROM
                      lenen
                      INNER JOIN customers ON lenen.FKuser = customers.id
                      INNER JOIN books ON lenen.Fkbook = books.id
                    WHERE
                      customers.id =:id and start is not null");
    $stmt->bindParam(":id", $param_id);
    $param_id = $userId;
    $stmt->execute();
    $result = $stmt->fetch();
    if ($stmt->rowCount() < 3) {
        //add the book to lenen books.
        $userId = $_SESSION['loginID'];
        $BookId = $_SESSION['thisBook'];
        $add = $conn->prepare("update lenen set start=:today, resTime=null where FKuser=:userId AND Fkbook=:bookID AND start is null");
        $add->bindParam(":userId", $userId);
        $add->bindParam(":today", $param_date);
        $add->bindParam(":bookID", $BookId);
        $param_date = date('Y-m-d H:i:s');
        $add->execute();

        // delete a copy from this book
        $bookCopy = $_SESSION['thisCopy'];
        $newCopy = (int)$bookCopy - 1;
        $update = $conn->prepare("update books set copies=:Copies where id=:id");
        $update->bindParam(":Copies", $newCopy, PDO::PARAM_INT);
        $update->bindParam(":id", $param_id);
        $param_id = $BookId;
        if ($update->execute()) {
            unset($_SESSION['thisBook']);
            unset($_SESSION['thisCopy']);
            echo '<h2>Done!</h2>
                <script>
                setTimeout(function(){  location.href = "../index.php?page=mybooks";},500);
                             </script>
                ';
            unset($conn);
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
    else {
        echo '
            <script>
            setTimeout(() => { alert("Sorry, you can not borrow more than 3 books at the same time!") }, 200);
              setTimeout(function(){  location.href = "../index.php?page=mybooks";},500);
                                     </script> 
        
        ';
        unset($conn);
    }

}