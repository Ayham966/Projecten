<?php
if ( $_SESSION['admin'] != true ){
    header("location: index.php");
    exit();
}
$err_msg = "";

// speler toevoegen
if (isset($_POST['submit_add'])) {
    if (!empty($_POST['name'])) {
        $name = trim($_POST["name"]);
        $check_name = "SELECT * FROM players where name=:name";
        $stmt = $conn->prepare($check_name);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $team = trim($_POST["teamName"]);
            if ( $team === "none") {
                $team = null;
            }
            $insert_player = $conn->prepare('INSERT INTO players (name,fkteam) VALUES (?,?);');
            if ($insert_player->execute(array($name,$team)) ) {
                echo '<script>
                              setTimeout(function(){ location.href = "index.php?page=spelers#list-item-2";});
                              </script>';
            }

        }
        else {
            $err_msg = 'Deze speler bestaat al!';
        }
    }
    else {
        $err_msg = 'voeg de naam van de speler toe';
    }

}
?>

<div class="row">
    <div class="col-12" id="players-photo" >
        <div class="overlay"></div>
        <div class="head-text">
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action btn btn-light active" type="button"  href="#list-item-1">
                    Speler Toevoegen
                </a>
                <br>
                <a class="list-group-item list-group-item-action btn btn-info active" type="button"  href="#list-item-2">
                    Speler Bewerken
                </a>
                <br>
            </div>
        </div>
    </div>
</div>
</br> </br> </br> </br>
    <hr width="100%">
    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h3 id="list-item-1" class="text-center">All Spelers</h3>
<?php
// check if there are teams
$check = $conn->prepare("SELECT * FROM players");
$check->execute();
$playersTotal= $check->rowCount();
if ($playersTotal > 0) {
    ?>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-12 p-1">
                <h5 class="text-info p-1">Er zijn: <strong class="text-danger"> <?php echo $playersTotal?> </strong>spelers gevonden!</h5>
                <table class="table table-image border table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Speler id</th>
                        <th scope="col">SpelerNaam</th>
                        <th scope="col">Team</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $playersTotal = $check->fetchAll();
                    foreach($playersTotal as $row)
                    {
                        $playerTeam = $row['fkteam'];
                        if ($playerTeam) {
                            // Team naam halen
                            $check = $conn->prepare("SELECT name FROM teams where id=:id");
                            $check->bindParam(":id", $playerTeam, PDO::PARAM_STR);
                            $check->execute();
                            $result = $check->fetch(PDO::FETCH_ASSOC);
                            $currentTeam = $result['name'];
                            $btnText = "Team bewerken";
                        }
                        else {
                            $currentTeam = '<b class="text-danger">Geen team nog!</b>';
                            $btnText = "+ toevoegen aan team";
                        }
                        ?>
                        <tr>
                            <td scope="row"><?php echo $row['id']?></td>
                            <td scope="row"><?php echo $row['name']?></td>
                            <td scope="row"><?php echo $currentTeam ?></td>
                            <td><?php echo '<a href="php/deleteplayer.php?id='. $row['id'] .'" class="btn btn-danger"> <i class="fas fa-trash fa-lg"></i> </a>'?></td>
                            <td><?php echo '<a href="php/editPlayer.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-info"><i class="fas fa-edit"></i></button> </a>'?></td>
                            <td><?php echo '<a href="php/editPlayer.php?team='. $row['id'] .'"> <input type="submit" name="submit" value="'.$btnText.'" class="btn btn-secondary" > </a>'?></td>
                        </tr>
                    <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <?php
}
else {

    echo '<br> <p class="font-italic text-center text-danger"> Geen spelers gevonden!.</p>';
}
?>

</br> </br> </br> </br>
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h3 id="list-item-2" class="text-center">Speler toevoegen</h3>
    </br>
    <div class="text-center w-50 mx-auto border border-info p-5">
        <form action="" method="post" class="teams-add-form" enctype="multipart/form-data">
        </br> </br>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="SpelerNaam *" pattern="[A-Za-z]*" title="Spelernaam" name="name" value=""/>
                </div>
            </div>
            </br> </br>
            <div class="row">
                <div class="col text-left">
                    <label class="font-weight-bold text-left" for="teamName">Team naam:</label>
                    <select class="form-control" name="teamName">';
                        <option value="none">Geen team</option>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM teams");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $rows) {
                            $teamName = $rows['name'];
                            $teamId = $rows['id'];
                            echo '<option value="' . $teamId . '">'.$teamName .'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br><br>
            <input type="submit" class="btnRegister btn-primary active" name="submit_add"  value="Toevoegen"/>
            <br><br>

            <span style="color: red; font-size: 14pt;"><?php echo $err_msg; ?></span>

        </form>
    </div>
</div>