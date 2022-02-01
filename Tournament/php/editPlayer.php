<?php
include('../config/connection.php');
include("../includes/head.inc.php");

$name = $name_err =   $team_err =  $team = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $playerId = $_POST["id"];
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $input_name = trim($_POST["name"]);
        if (empty($input_name)) {
            $name_err = "Voer de naam van de speler in!.";
        } else {
            $name = $input_name;
        }
        // update the current team
        if (empty($name_err)) {
            $check_name = "SELECT * FROM players where name=:name";
            $stmt = $conn->prepare($check_name);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                $sql = "UPDATE players SET name=:name WHERE id=:id";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":id", $playerId);
                    if ($stmt->execute()) {
                        echo '   <script>
                    setTimeout(function(){  location.href = "../index.php?page=spelers#list-item-2";});
                                 </script>';
                        exit();
                    } else {
                        echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                    }
                }
            } else {
                echo 'Deze naam is al gebruikt!';
            }
        }
    } else {
        $input_team = trim($_POST["teamName"]);
        if (empty($input_team)) {
            $team_err = "Voer de naam van de team in!.";
        } else {
            $team = $input_team;
        }
        // update the current team
        if (empty($team_err)) {
            $sql = "UPDATE players SET fkteam=:fkteam WHERE id=:id";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":fkteam", $team);
                $stmt->bindParam(":id", $playerId);
                if ($stmt->execute()) {
                    echo '   <script>
                    setTimeout(function(){  location.href = "../index.php?page=spelers#list-item-2";});
                                 </script>';
                    exit();
                } else {
                    echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                }
            }
        }
    }

} else{

    if(isset($_GET["team"])) {
        $playerId = $_GET["team"];
    }
    else {
        $playerId = $_GET["id"];
    }
    $sql = "SELECT * from players WHERE players.id=:id";
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(":id", $playerId);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $row["name"];
            } else{
                echo "Er is iets fout gegaan. Probeer het later opnieuw.";
                exit();
            }

        } else{
            echo "Er is iets fout gegaan. Probeer het later opnieuw.";
            exit();
        }
    }
    unset($stmt);
    unset($conn);
}
?>

<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-6 mx-auto"><!--right col-->
            <div class="tab-content">
                <div class="tab-pane active">
                    <h3 class="text-center" style="color: cornflowerblue">Edit player:</h3>
                    <hr>
                    <?php
                    if(isset($_GET["id"]) && !empty($_GET["id"])){
                        ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h5>Naam speler:</h5></label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                            </div>
                        </div>



                    <?php
                    }
                        if(isset($_GET["team"]) && !empty($_GET["team"])){
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="teamName"><h5>Team name:</h5></label>
                                    <select class="form-control" name="teamName">
                                        <?php
                                        include('../config/connection.php');
                                        $stmt = $conn->prepare("SELECT * FROM teams");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        var_dump($result);
                                        foreach ($result as $rows) {
                                            $teamName = $rows['name'];
                                            $teamId = $rows['id'];
                                            echo '<option value="' . $teamId . '">' . $teamName . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="help-block" style="color: red"><?php echo $team_err;?></span>
                                </div>
                            </div>
                            <?php
                            }
                            ?>

                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $playerId; ?>">
                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Opslaan</button>
                    </div>
                </div>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>

