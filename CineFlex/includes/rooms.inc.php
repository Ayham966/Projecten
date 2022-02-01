<?php
isAdmin();

$err_msg = "";
//add room
if (isset($_POST['submit'])) {
    $newRoom = $_POST['room'];
    $sql = "SELECT * from rooms where name=:name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $newRoom);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $seats = $_POST['seats'];

    $checkOld = strtolower($row['name']);
    $checkNew = strtolower($newRoom);

    if ($checkOld != $checkNew) {
        $sql = $conn->prepare('INSERT INTO rooms (name, seats) VALUES (?,?);');
        if ($sql->execute([$newRoom, $seats])) {
            echo '
                  <script> 
                    setTimeout(function(){  location.href = "index.php?page=rooms";});
                  </script> ';
        } else {
            echo 'Er is iets misgegaan!';
        }
    }
    else {
        $err_msg = 'Deze zaal bestaat al!';;
    }
}
?>

<div class="layout-margin-8 mt-5">
    <div class="d-flex flex-row">
        <div class="p-2"><h2 class="text-white"> > Zalen</h2></div>
    </div>
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <button class="btn bg-success text-white" data-toggle="modal" data-target="#addModal">Toevoegen +</button>
        </div>
    </div>
    <?php if ( ($err_msg)) : ?>
        <div class="alert alert-danger w-50 text-center mx-auto" role="alert">
            <?php echo $err_msg; ?>
        </div>
    <?php endif;?>
    <?php
    $sql = $conn->prepare("SELECT * FROM rooms");
    $sql->execute();
    $rooms = $sql->fetchAll();
    $count = $sql->rowCount();
    ?>
    <div class="row table-responsive col-6 mx-auto">
        <h3 class="text-info">Aantal zalen: <?php echo $count?></h3>
        <table class="table table-image border table-hover table-bordered bg-light">
            <thead class="thead-dark ">
            <tr>
                <th scope="col">Zaal naam:</th>
                <th scope="col">Aantal stoelen:</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($rooms as $row) :?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['seats']?></td>
                    <td class="d-flex justify-content-center">
                        <a class="btn btn-info btn-sm m-2" href="php/editRoom.php?id=<?php echo $row['id']?>"><i class="fa fa-edit fa-xs"></i></a>
                        <a class="btn btn-danger btn-sm m-2" href="php/confirm.php?roomid=<?php echo $row['id']?>"><i class="fa fa-trash fa-xs"></i></a>
                    </td>
                </tr>
             <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal add-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Zaal toevoegen:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <input class="form-control form-control-lg" name="room" type="text" placeholder="Zaal naam">
                    <br> <input class="form-control form-control-lg w-50" name="seats" type="text" placeholder="Aantal stoelen">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Annuleren</button>
                    <button type="submit" class="btn btn-danger" name="submit"> Toevoegen </button>
                </div>
            </form>
        </div>
    </div>
</div>
