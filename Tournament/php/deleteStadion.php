<?php
include("../config/connection.php");
include("../includes/head.inc.php");

if(isset($_POST['action']) and $_POST['action'] == 'Yes') {
    if (isset($_GET['id'])) {
        $teamID = $_GET['id'];
        $query = $conn->prepare("DELETE FROM stadions WHERE id=:id");
        $query->bindParam(":id", $teamID);
        if ($query->execute()){
            echo '   <script>
                setTimeout(function(){  location.href = "../index.php?page=stadions#list-item-2";});
                             </script>';
        }
    }

}

else {
    if(isset($_POST['action']) and $_POST['action'] == 'Cancel') {
        echo '   <script>
                setTimeout(function(){  location.href = "../index.php?page=stadions#list-item-2";});
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
</form>
