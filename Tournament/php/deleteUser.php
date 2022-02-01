<?php
include("../config/connection.php");
include("../includes/head.inc.php");
$msg_err = "";
if(isset($_POST['action']) and $_POST['action'] == 'Yes') {
    if (isset($_GET['id'])) {
        $userID = $_GET['id'];
        $sql = "SELECT * FROM matches WHERE fkuser =:user";
        if ($check = $conn->prepare($sql)) {
            $check->bindParam(":user", $userID, PDO::PARAM_STR);
            if ($check->execute()) {
                if ($check->rowCount() == 0) {
                    $query = $conn->prepare("DELETE FROM user_details WHERE fkuser=:id");
                    $query->bindParam(":id", $userID);
                    if ($query->execute()) {
                        $delete = $conn->prepare("DELETE FROM users WHERE id=:id");
                        $delete->bindParam(":id", $userID);
                        if ($delete->execute()) {
                            echo '   <script>
                            setTimeout(function(){  location.href = "../index.php?page=scheidsrechters#list-item-1";});
                                         </script>';
                        }
                    }
                } else {
                    $msg_err = 'Deze gebruiker bestaat als scheidsrechter voor een toernooi!';
                }
            }
        }
    }
}
else {
    if(isset($_POST['action']) and $_POST['action'] == 'Cancel') {
        echo '   <script>
                setTimeout(function(){  location.href = "../index.php?page=scheidsrechters#list-item-1";});
                             </script>';
        exit();
    }
}
?>

<form action="" method="post" style="width: 100%; text-align: center">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bevestigen</h5>
            </div>
            <div class="modal-body">
                <p>Ben je zeker dat je het wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="action" value="Yes">
                <input type="submit" class="btn btn-secondary" data-dismiss="modal" name="action" value="Cancel">
            </div>
        </div>
    </div>
    <span class="text-danger"> <?php echo $msg_err ?></span>
</form>
