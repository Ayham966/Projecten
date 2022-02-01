<?php
include("../includes/header.inc.php");
include("../config/connection.php");
include("function.php");
session_start();
isAdmin();

$sql = "Select * from movies order by name";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$msg_err = "";
if (isset($_POST['add'])) {
    if (!empty($_POST['filmID']) && !empty($_POST['time']) && !empty($_GET['date']) && !empty($_GET['room'])  ) {
            $date = $_GET['date'];
            $room = $_GET['room'];
            $time = $_POST['time'];
            $filmID = $_POST['filmID'];
            $sql = "INSERT INTO overview (fkfilm, fkroom, date, time) VALUES (?,?,?,?)";
            if ($conn->prepare($sql)->execute([$filmID, $room, $date, $time])) {
                echo '<script>
                      setTimeout(function(){ location.href = "../index.php?page=agenda";});
                      </script>';
            }
        }
        else {
            if (empty($_POST['time'])) {
                $msg_err = 'Selecteer de tijd!';
            } else {
                $msg_err = 'Selecteer een film!';
            }
        }
}

?>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<div class="container-fluid container-addToAgenda">
        <div class="mx-auto p-5">
            <h3 class="text-light text-center">Film tonen!</h3>
            <br>
            <nav class="navbar navbar-light justify-content-center p-3">
                <form class="form-inline">
                    <?php if (isset($_GET['checkAgenda'])): ?>
                        <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" id="searchbox">
                    <?php endif;?>
                </form>
            </nav>
            <form id="myform" action="" method="get" class="child-addToAgenda container-fluid">
                <?php if ($msg_err) :?>
                <div class="alert alert-warning">
                    <h5>Fout!</h5>
                    <p><?php echo $msg_err ?></p>
                </div>
                <?php endif;?>
                <br>
                <?php if (!isset($_GET['checkAgenda'])): ?>
                <div class="row p-4">
                        <div class="col-4 mx-auto">
                        <span class="h3 text-light">Datum: </span>
                            <select id="date_list" class="form-control" name="date">
                                <?php
                                $max_dates = 10;
                                $countDates = 1;
                                while ($countDates < $max_dates) {
                                    $NewDate=Date('Y-m-d', strtotime("+".$countDates." days"));
                                    if ( isset($_GET['date']) && $_GET['date'] === $NewDate) {
                                        echo "<option value='" . $NewDate . "' selected>" . $NewDate . "</option>";
                                    } else {
                                        echo "<option value='" . $NewDate . "'>" . $NewDate . "</option>";
                                    }
                                    $countDates += 1;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 mx-auto">
                            <span class="h3 text-light">Zaal: </span>
                                <select id="room_list" class="form-control" name="room">
                                    <?php
                                    $sql = "Select * from rooms order by name";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $genres = $stmt->fetchAll();
                                    foreach ($genres as $gen) {
                                        echo '<option value="'.$gen["id"].'">' . $gen['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                        </div>
                </div>
                <div class="col-12 text-center p-2">
                    <button type="submit" id="checkAgenda" name="checkAgenda" class="btn btn-primary btn-md mx-auto">Check tijd </button>
                </div>
                <?php endif;?>
           </form>

            <?php if (isset($_GET['checkAgenda'])): ?>
            <form method="post" action="" class="child-addToAgenda container-fluid p-4">
                <div class="row mx-auto" style="min-height: 500px;">
                    <?php foreach ($result as $row) : ?>
                        <div class="text-light custom-films-images" data-role="recipe">
                            <input class="btn-check" type="radio" id="<?php echo $row['id']?>" name="filmID" value="<?php echo $row['id']?>"/>
                            <label for="<?php echo $row['id']?>">
                                <img height="150" width="250" title="<?php echo $row["image"] ?>" src="<?php echo '../' . $row['path']?>">
                                <p class="h4 text-center p-3"><?php echo $row['name']?></p>
                            </label>
                        </div>
                    <?php endforeach;?>
                </div>
                <br>
                <h3 class="text-light">Film begint om: </h3>
                <div class="btn-group btn-group-toggle row mx-auto" data-toggle="buttons">
                    <?php
                    $start = "13:00";
                    $end = "23:00";
                    $tStart = strtotime($start);
                    $tEnd = strtotime($end);
                    $tNow = $tStart;
                    while($tNow <= $tEnd){
                        $times = date("H:i",$tNow);
                        $tNow = strtotime('+30 minutes',$tNow);
                        $room = $_GET['room'];
                        $data =  $_GET['date'];
                        $checked = get_time_toAgenda($data, $room, $times);
                        ?>
                                <label class="btn btn-outline-<?php if ($checked)  echo "secondary" ;else echo "warning";?>" for="<?php echo $times ?>">
                                    <input type="radio" name="time" value="<?php echo $times ?>"
                                    <?php if ($checked)  {
                                         echo " disabled  ";
                                   }
                                   ?> id="time" autocomplete="off"
                                   > <?php echo $times ?>
                                </label>
                        <?php
                    }
                    ?>
                </div>
                <br>
                <hr class="bg-light w-100" />
                    <div class="col-12 text-center">
                        <button type="submit" id="add" name="add" class="btn btn-primary btn-md mx-auto">Selecteer </button>
                    </div>
            </form>
            <?php endif ?>
        </div>
</div>



<script>
    $(document).ready(function() {
        $("#searchbox").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $('div[data-role="recipe"]').filter(function() {
                $(this).toggle($(this).find('p').text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>






