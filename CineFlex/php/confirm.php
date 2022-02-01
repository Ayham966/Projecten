<?php
include("../includes/header.inc.php");
include("../config/connection.php");
session_start();
?>
<form action="" method="post" style="width: 100%; text-align: center">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete it?</p>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="action" value="Yes">
                <input type="submit" class="btn btn-secondary" data-dismiss="modal" name="action" value="Cancel">
            </div>
        </div>
    </div>
</form>

<!--delete genre-->
<?php
if (isset($_GET['id'])) {
    if (isset($_POST['action']) and $_POST['action'] == 'Yes') {
        $genreID = $_GET['id'];
        $query = $conn->prepare("DELETE FROM genres WHERE id=:id");
        $query->bindParam(":id", $genreID);
        if ($query->execute()) {
            echo '   <script>
                        setTimeout(function(){  location.href = "../index.php?page=genres";});
                                     </script>';
        } else {
            echo 'Er is fout gegaan!';
        }
    } else {
        if (isset($_POST['action']) and $_POST['action'] == 'Cancel') {
            echo '   
           <script>
                setTimeout(function(){  location.href = "../index.php?page=genres";});
           </script>';
            exit();
        }
    }
}
?>

    <!--delete User-->
<?php
if (isset($_GET['userid'])) {
    if (isset($_POST['action']) and $_POST['action'] == 'Yes') {
        $userID = $_GET['userid'];
        $query = $conn->prepare("DELETE FROM users WHERE id=:id");
        $query->bindParam(":id", $userID);
        if ($query->execute()) {
            echo '   <script>
                        setTimeout(function(){  location.href = "../index.php?page=users";});
                                     </script>';
        } else {
            echo 'Er is fout gegaan!';
        }
    } else {
        if (isset($_POST['action']) and $_POST['action'] == 'Cancel') {
            echo '   
           <script>
                setTimeout(function(){  location.href = "../index.php?page=users";});
           </script>';
            exit();
        }
    }
}
?>

<!--delete film-->
<?php
if (isset($_GET['filmID'])) {
    if(isset($_POST['action']) and $_POST['action'] == 'Yes') {
        $filmID = $_GET['filmID'];
        $query = $conn->prepare("DELETE FROM movies WHERE id=:id");
        $query->bindParam(":id", $filmID);
        if ($query->execute()) {
            echo '   <script>
                        setTimeout(function(){  location.href = "../index.php?page=moviesAdmin";});
                                     </script>';
        } else {
            echo 'Er is fout gegaan!';
        }
    } else {
        if(isset($_POST['action']) and $_POST['action'] == 'Cancel') {
            echo '   
           <script>
                setTimeout(function(){  location.href = "../index.php?page=moviesAdmin";});
           </script>';
            exit();
        }
    }
}
?>

<!--delete room -->
<?php
if (isset($_GET['roomid'])) {
    if (isset($_POST['action']) and $_POST['action'] == 'Yes') {
        $roomID = $_GET['id'];
        $query = $conn->prepare("DELETE FROM rooms WHERE id=:id");
        $query->bindParam(":id", $roomID);
        if ($query->execute()) {
            echo '   <script>
                        setTimeout(function(){  location.href = "../index.php?page=rooms";});
                                     </script>';
        } else {
            echo 'Er is fout gegaan!';
        }
    } else {
        if (isset($_POST['action']) and $_POST['action'] == 'Cancel') {
            echo '   
           <script>
                setTimeout(function(){  location.href = "../index.php?page=rooms";});
           </script>';
            exit();
        }
    }
}
?>