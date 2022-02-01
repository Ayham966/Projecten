<?php
include("../includes/header.inc.php");
include("../config/connection.php");
include("function.php");
session_start();

if ( !isset($_SESSION['loginID'])) {
    header("location: ../index.php?page=login");
}

$error = "";
$success = "";
if ( isset($_GET['id']))  {
    $overview =  $_GET['id'];
    if(isset($_SESSION['loginID'])) {
        $userID  = $_SESSION['loginID'];
    } else  {
        $register = false;
    }
    $sql = "Select fkroom, seats, rooms.id as roomID, rooms.name as roomName from overview 
    inner join rooms on overview.fkroom = rooms.id
    where overview.id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id",$overview);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['myBtn'])){
        if ( isset($_POST['selSeats'])) {
        $options = $_POST['selSeats'];
            for($i=0; $i < count($options); $i++) {
                $insert = $conn->prepare('INSERT INTO overview_users (seatNumber, fkuser, fkover ) VALUES (?,?,?);');
                if ($insert->execute(array($options[$i], $_SESSION['loginID'], $overview))) {
                    $success =  'Gelukt, stoel '.$options[$i].' is gereserveerd!';
                    echo ' <meta http-equiv="refresh" content="3;url=../index.php?page=home" /> ';
                }
            }
        }
        else {
            $error = 'Select aub een stoel te reserveren!';
        }
    }
    ?>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <div class="layout-margin-8 mt-5">
        <?php if($error || $success) : ?>
            <div class="alert alert-secondary text-center" role="alert">
                <?php echo $error . $success?>
            </div>
        <?php endif;?>


        <div class="container row p-5">
            <form class="col-3 mx-auto" method="post" action="">
                <table class="text-light">
                    <?php
                    $range = $row['seats'];
                    $rowRange  = $row['seats']  / 10;

                    for ( $i = 1; $i <= $range; $i++ ) {
                        $check = checkDisable($_GET['id'], $i - 1);
                        if ( $check ) {
                            $setClass = "disabeldSeat";
                        } else {
                            $setClass = "";
                        }
                        echo '<td>
                                 <div class="seat '.$setClass.'"></div>
                            </td>';
                        if ( $i % 5 == 0 ) {
                            echo '<td class="walk"> </td>';
                        }
                        if ( $i % 10 == 0 ) {
                            echo '</tr>';
                            }
                    }

                    ?>
                </table>
                <br>
                <button class="btn btn-success" type="submit" name="myBtn">Selecteer</button>
            </form>
        </div>

        <div class="squares d-flex justify-content-center mt-3">
            <div class="square square-available"></div>
            <span>Beschikbaar</span>
            <div class="square square-disable"></div>
            <span>Niet beschikbaar</span>
            <div class="square square-selected"></div>
            <span>Geselecteerd</span>
        </div>
    </div>

<?php
}  else {
    echo 'Er is een fout gegaan, probeer later!';
}
?>
<script>
    $('.cinema-seats .seat').on('click', function() {
        $(this).toggleClass('active');
    });
    allSeats = document.querySelectorAll('.seat');
    for (let i = 0; i < allSeats.length; i++) {
        let seat = allSeats[i];
        if ( !seat.classList.contains('disabeldSeat')) {
            seat.addEventListener('click', function () {
                let bgclr = this.style.backgroundColor;
                let input = document.createElement("input");
                if (!seat.childNodes.length > 0) {
                    this.appendChild(input);
                    input.setAttribute("type", "hidden");
                    input.setAttribute("value", [i]);
                    input.setAttribute("name", "selSeats[]");
                    input.setAttribute("id", [i]);
                    input.setAttribute("checked", "");
                } else {
                    this.innerHTML = "";
                }
                if(bgclr ==='white')
                    this.style.background = 'linear-gradient(to top, #761818, #761818, #761818, #761818, #761818, #B54041, #F3686A)';
                else
                    this.style.background = 'white';
                // debugger
            }, false);
        }
    }


</script>



