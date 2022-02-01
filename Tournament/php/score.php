<?php
include("../includes/head.inc.php");
include("../config/connection.php");
session_start();

if(!isset($_GET["id"]) && empty($_GET["id"])){
    header("location: index.php");
    exit();
}

if(!isset($_SESSION["loginID"]) || $_SESSION['user'] = false ){
    header("location: index.php");
    exit();
}
$userid = $_SESSION['loginID'];
$matchId = $_GET["id"];
// team 1
$sql = "SELECT * FROM matches
    inner join teams on matches.team1 = teams.id
    where matches.id=:id and matches.fkuser=:user";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $matchId, PDO::PARAM_STR);
$stmt->bindParam(":user", $userid, PDO::PARAM_STR);
$stmt->execute();
$row1 = $stmt->fetchAll();
foreach ( $row1 as $match1) {
    $team1 = $match1['name'];
    $team1ID = $match1['id'];
    $tourId = $match1['fktour'];
}

// team 2
$sql = "SELECT * FROM matches
    inner join teams on matches.team2 = teams.id
    where matches.id=:id and matches.fkuser=:user";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $matchId, PDO::PARAM_STR);
$stmt->bindParam(":user", $userid, PDO::PARAM_STR);
$stmt->execute();
$row2 = $stmt->fetchAll();
foreach ( $row2 as $match2) {
    $team2 = $match2['name'];
    $team2ID = $match2['id'];
    $firstRound = $match2['round'];
}

$msg_err = $score1_err =  $score2_err = $score1 = $score2 = $score = "";
if (isset($_POST['submit'])) {
    // score 1
    $input_score1 = trim($_POST["score1"]);
   if (!is_numeric($input_score1)) {
        $score1_err = "Please enter a number.";
    } else {
        $score1 = $input_score1;
    }

    // score 2
    $input_score2 = trim($_POST["score2"]);
    if (!is_numeric($input_score2)) {
        $score2_err = "Please enter a number.";
    } else {
        $score2 = $input_score2;
    }


    if (empty($score1_err) && empty($score2_err)) {
        if ( $score1 != $score2 ) {
            if ( $score1 > $score2) {
                $winner = $team1ID;
            }
            else {
                $winner = $team2ID;
            }
                $sql = "UPDATE matches SET score1=:score1, score2=:score2, winner=:winner WHERE id=:id";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bindParam(":score1", $score1);
                    $stmt->bindParam(":score2", $score2);
                    $stmt->bindParam(":winner", $winner);
                    $stmt->bindParam(":id", $matchId);
                    if ($stmt->execute()) {
                            // check if all teams played
                            $check_team = "SELECT * FROM matches where fktour=:id and round=:firstRound and winner is not null";
                            $stmt = $conn->prepare($check_team);
                            $stmt->bindParam(":firstRound", $firstRound, PDO::PARAM_STR);
                            $stmt->bindParam(":id", $tourId, PDO::PARAM_STR);
                            $stmt->execute();
                            $row3 = $stmt->fetchAll();
                            $firstCheck = $stmt->rowCount();
                            $nextRound = $firstRound / 2;

                            // check if next round already added
                           $check_teams = "SELECT * FROM matches where fktour=:id and round=:nextRound";
                           $stmt2 = $conn->prepare($check_teams);
                           $stmt2->bindParam(":nextRound", $nextRound, PDO::PARAM_STR);
                           $stmt2->bindParam(":id", $tourId, PDO::PARAM_STR);
                           $stmt2->execute();
                           $secondCheck = $stmt2->rowCount();
                            if ($firstCheck == $nextRound && $secondCheck == 0) {
                                // get the winners
                                foreach ($row3 as $toNext) {
                                    $winners[] = $toNext['winner'];
                                }
                                shuffle($winners);
                                $theWinners = array_chunk($winners, 2);
                                foreach ($theWinners as $teammate) {
                                    // get scheidsrechters
                                    $sql = "SELECT * FROM users where role='user'";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $row1 = $stmt->fetchAll();
                                    $allReferee = array();
                                    foreach ($row1 as $referee) {
                                        $allReferee[] = $referee['id'];
                                    }
                                    shuffle($allReferee);
                                    $refers = array_chunk($allReferee, 1);
                                    foreach ($refers as $refs) {
                                    }
                                    if ( $nextRound > 1) {
                                        $insertMatch = $conn->prepare('INSERT INTO matches (fktour,fkuser,team1,team2,round) VALUES (?,?,?,?,?);');
                                        if ($insertMatch->execute([$tourId, $refs[0], $teammate[0], $teammate[1], $nextRound])) {
                                            echo '   <script>
                                        setTimeout(function(){  location.href = "../index.php?page=tournament";});
                                                     </script>';
                                        }
                                    }
                                    else {
                                        echo '   <script>
                                        setTimeout(function(){  location.href = "../index.php?page=tournament";});
                                                     </script>';
                                    }
                                }
                            }
                            else {
                                echo '   <script>
                                        setTimeout(function(){  location.href = "../index.php?page=tournament";});
                                                     </script>';
                            }
                    }
                }
                else {
                    $msg_err = 'Score kan niet gelijk zijn!';
                }
        }
    }
}



?>
<div class="container">
    <div class="d-flex justify-content-center h-100 p-5">
        <div class="card w-75 mx-auto">
            <div class="card-header">
                <h3>Uitslag Invullen</h3>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><?php echo $team1?></span>
                        </div>
                        <input type="text" name="score1" maxlength="1" required>
                        <h4 class="p-2">VS</h4>
                        <input type="text" name="score2" maxlength="1" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text"><?php echo $team2 ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Invullen" name="submit" class="btn float-right login_btn">
                    </div>
                    <span class="text-danger"><?php echo $msg_err , $score1_err , $score2_err?></span>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>