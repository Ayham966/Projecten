<?php
if(!isset($_GET["id"]) && empty($_GET["id"])){
    header("location: index.php");
    exit();
}

// tournament name view
$tourId = $_GET["id"];
$sql = "SELECT *, MAX(round) AS allround FROM tournaments 
    inner join  matches on tournaments.id = matches.fktour
    where tournaments.id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $tourId, PDO::PARAM_STR);
$stmt->execute();
$row0 = $stmt->fetch(PDO::FETCH_ASSOC);
$tourName = $row0['name'];
$allTeams = $row0['allround'];

?>
<div class="row">
    <div class="col-12" id="tour-photo" >
        <div class="overlay"></div>
        <div class="head-text">
        </div>
    </div>
</div>
<div class="container">
    <br><br>
    <h3 class="text-center">Toernooi: <b class="text-info"><?php echo $tourName?></b></h3>
    <br><br>
        <table class="table table-image border table-hover">
            <thead class="bg-warning">
            <tr>
                <th scope="col">Wedstrijd</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Sheidsrechter</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
    <?php
    // get tournament info
    $tourId = $_GET["id"];
    $sql = "SELECT *, matches.id as matchID FROM matches 
            inner join tournaments on tournaments.id = matches.fktour
            inner join teams on teams.id = matches.team1 and matches.team2
            where matches.fktour=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $tourId, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetchAll();
    foreach ($row as $rounds) {
        $matchID = $rounds['matchID'];
        $refreeID = $rounds['fkuser'];

        // get user name
        $sql = "SELECT * FROM user_details where fkuser=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $refreeID, PDO::PARAM_STR);
        $stmt->execute();
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $refree = $row2['first'] . " " .  $row2['last'];

        // get team 1 name
        $team1 = $rounds['team1'];
        $sql1 = "SELECT * FROM teams where id=:id ";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bindParam(":id", $team1, PDO::PARAM_STR);
        $stmt1->execute();
        $row1 = $stmt1->fetchAll();
        foreach ( $row1 as $teamsName ) {
        }

        // get team 2 name
        $team2 = $rounds['team2'];
        $sql1 = "SELECT * FROM teams where id=:id";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bindParam(":id", $team2, PDO::PARAM_STR);
        $stmt1->execute();
        $row1 = $stmt1->fetchAll();
        foreach ( $row1 as $teamsName2 ) {
        }
        $firstRound = $allTeams;
        $nextRound = $firstRound / 2;
        $i = 1;
        if ( $firstRound == $rounds['round'] ) {
        ?>
            <tr> <td scope="row" class="bg-info">Ronde <?php echo $i;?></td>
            <td scope="row"><?php echo $teamsName['name']?></td>
            <td scope="row" class="text-danger h5"><?php echo $rounds['score1']?></td>
            <td scope="row">VS</td>
            <td scope="row" class="text-danger h5"><?php echo $rounds['score2']?></td>
            <td scope="row"><?php echo $teamsName2['name']?></td>
            <td scope="row"></td>
            <td scope="row"><?php echo $refree;?></td>

        <?php
            if (isset($_SESSION['user']) && $refreeID == $_SESSION['loginID']) {
                $edit = $rounds['score1'];
                $edit2 = $rounds['score2'];
                if ( $edit == null || $edit2 == null ) {
                    echo '<td><a href="php/score.php?id=' . $matchID . '" type="button"><button class="btn btn-success">Uitslag invullen</button></a>
                      </td>';
                }
                else {
                    echo '<td><a href="php/score.php?id='.$matchID.'" type="button"><button class="btn btn-secondary">Uitslag Bewerken</button></a>
                      </td>  </tr> ';
                }
            }
        }
        elseif ($nextRound == $rounds['round'] && $nextRound > 2  ) {
            $i = $i + 1;
             ?>
            <tr> <td scope="row" class="bg-danger">Ronde <?php echo $i?></td>
            <td scope="row"><?php echo $teamsName['name']?></td>
            <td scope="row" class="text-danger h5"><?php echo $rounds['score1']?></td>
            <td scope="row">VS</td>
            <td scope="row" class="text-danger h5"><?php echo $rounds['score2']?></td>
            <td scope="row"><?php echo $teamsName2['name']?></td>
            <td scope="row"></td>
            <td scope="row"><?php echo $refree;?></td>

            <?php
            if (isset($_SESSION['user']) && $refreeID == $_SESSION['loginID'] ) {
                $edit = $rounds['score1'];
                $edit2 = $rounds['score2'];
                if ( $edit == null || $edit2 == null ) {
                    echo '<td><a href="php/score.php?id=' . $matchID . '" type="button"><button class="btn btn-success">Uitslag invullen</button></a>
                      </td>';
                }
                else {
                    echo '<td><a href="php/score.php?id='.$matchID.'" type="button"><button class="btn btn-secondary">Uitslag Bewerken</button></a>
                      </td>  </tr>';
                }
            }
        }
        elseif ($rounds['round'] == 2) {
            ?>
            <tr> <td scope="row" class="bg-dark text-white">Finale</td>
                <td scope="row"><?php echo $teamsName['name']?></td>
                <td scope="row" class="text-danger h5"><?php echo $rounds['score1']?></td>
                <td scope="row">VS</td>
                <td scope="row" class="text-danger h5"><?php echo $rounds['score2']?></td>
                <td scope="row"><?php echo $teamsName2['name']?></td>
                <td scope="row"></td>
                <td scope="row"><?php echo $refree;?></td>
        <?php
            if (isset($_SESSION['user']) && $refreeID == $_SESSION['loginID']) {
                $edit = $rounds['score1'];
                $edit2 = $rounds['score2'];
                if ( $edit == null || $edit2 == null ) {
                    echo '<td><a href="php/score.php?id=' . $matchID . '" type="button"><button class="btn btn-success">Uitslag invullen</button></a>
                      </td>';
                }
                else {
                    echo '<td><a href="php/score.php?id='.$matchID.'" type="button"><button class="btn btn-secondary">Uitslag Bewerken</button></a>
                      </td>  </tr>';
                }
            }
            }
        }
            ?>
        </tbody>
        </table>
    <?php
    if ($rounds['round'] == 2) {
    $sql1 = "SELECT teams.name FROM matches
    inner join teams on teams.id = matches.winner
    where matches.fktour =:id and matches.round = 2 and matches.winner is not null";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(":id", $tourId, PDO::PARAM_STR);
    $stmt1->execute();
    if ($stmt1->rowCount() == 1) {
        $row = $stmt1->fetch(PDO::FETCH_ASSOC);
            echo '
        <div class="row w-25 mx-auto"><img src="images/winner.gif" title="winner.gif" width="300" height="250" alt="winner">
        </div> <h4 class="text-center text-success">【 '.$row['name'].' 】</h4>
        ';
        }
    }
    ?>
</div>