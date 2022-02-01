<?php
if ( $_SESSION['admin'] != true ){
    header("location: index.php");
    exit();
}
$city = $city_err = $street = $street_err = $house = $house_err = $postcode = $postcode_err = $err_msg = $success = "";
if (isset($_POST['submit_add'])) {
    if (!empty($_POST['name']) && !empty($_POST['city']) && !empty($_POST['street']) && !empty($_POST['house']) && !empty($_POST['postcode'])) {
        // check eerst als naam is gebruikt
        $name = trim($_POST["name"]);
        $check_name = "SELECT * FROM stadions where name=:name";
        $stmt = $conn->prepare($check_name);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $input_city = trim($_POST["city"]);
            if (empty($input_city)) {
                $city_err = "Voer a.u.b. plaats in!.";
            } else {
                $city = $input_city;
            }

            $input_street = trim($_POST["street"]);
            if (empty($input_street)) {
                $street_err = "Vul a.u.b. uw straatnaam in!.";
            } else {
                $street = $input_street;
            }

            $input_house = trim($_POST["house"]);
            if (empty($input_house)) {
                $house_err = "Vul a.u.b. uw huisnummer in!.";
            } elseif (!ctype_digit($input_house)) {
                $house_err = "Voer alstublieft een nummer in.";
            } else {
                $house = $input_house;
            }

            $input_postcode = trim($_POST["postcode"]);
            if (empty($input_postcode)) {
                $postcode_err = "Vul a.u.b. postcode in!.";
            } else {
                $postcode = $input_postcode;
            }
            if (empty($err_msg) && empty($city_err) && empty($street_err) && empty($house_err) && empty($postcode_err)) {
                $insert_team = $conn->prepare('INSERT INTO stadions (name, city,street,house,postcode ) VALUES (?,?,?,?,?);');
                if ($insert_team->execute(array($name, $city, $street, $house, $postcode))) {
                    echo '<script> setTimeout(function(){ location.href = "index.php?page=stadions#list-item-1";});</script>';
                    $success = '<i class="fa fa-check" aria-hidden="true"></i> Gedaan, Stadion is toegevoegd!';
                }
            }
        }
        else {
            $err_msg = "Deze naam is al gebruikt!";
        }
    }
    else {
        $err_msg = "Gelieve alle informatie in te vullen!";
    }
}

// code van toevoegen van team aan stadion
if (isset($_POST['submit_addTeamToStad'])) {
    if (!empty($_POST['stadionName']) && !empty($_POST['teamName'])) {
        $stadionName = $_POST['stadionName'];
        $teamName = $_POST['teamName'];
        $insert_team = $conn->prepare('INSERT INTO stadionteams (fkteam, fkstad) VALUES (?,?);');
        $insert_team->execute(array($teamName, $stadionName));
    }
}

?>

<div class="row">
    <div class="col-12" id="stadions-photo" >
        <div class="head-text">
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action btn btn-primary" type="button"  href="#list-item-1">
                    Stadion Toevoegen
                </a>
                <br>
                <a class="list-group-item list-group-item-action btn btn-light" type="button"  href="#list-item-2">
                    Stadion Bewerken
                </a>
                <br>
                <a class="list-group-item list-group-item-action btn btn-warning" type="button"  href="#list-item-3">
                    Stadion Teams
                </a>
                <br>
            </div>
        </div>
    </div>
</div>
    </br> </br> </br> </br>
    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
        <h4 id="list-item-1" class="text-center">Stadion toevoegen</h4>
        </br>
        <div class="text-center w-50 mx-auto border border-info p-5">
            <form action="" method="post" class="teams-add-form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Naam *" name="name" value=""/>
                    </div>
                </div>
                </br> </br>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Plaats *" name="city" value=""/>
                        <p class="text-left text-danger"><?php echo $city_err; ?></p>
                    </div>
                </div>
                </br> </br>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Straatnaam *" name="street" value=""/>
                        <p class="text-left text-danger"><?php echo $street_err; ?></p>
                    </div>
                </div>
                </br> </br>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Huisnummer *" name="house" value=""/>
                        <p class="text-left text-danger"><?php echo $house_err; ?></p>
                    </div>
                </div>
                </br> </br>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Postcode *" name="postcode" value=""/>
                        <p class="text-left text-danger"><?php echo $postcode_err; ?></p>
                    </div>
                </div>
                </br> </br>
                <span style="font-size: 13pt;" class="text-success"><?php echo $success; ?></span>
                <br><br>
                <input type="submit" class="btnRegister btn-primary active" name="submit_add"  value="Toevoegen"/>
                <br><br>
                <span style="color: red; font-size: 14pt;"><?php echo $err_msg;?></span>
            </form>
        </div>
    </div>
    </br> </br> </br> </br> </br> </br>  </br> </br>
    <hr width="100%">
    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h4 id="list-item-2" class="text-center">Stadions Bewerken</h4>
<?php
// check if there are teams
$check = $conn->prepare("SELECT * FROM stadions");
$check->execute();
if ($check->rowCount() > 0) {
    ?>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-12 p-1">
                <table class="table table-image border table-hover ">
                    <thead class="thead-info">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Plaats</th>
                        <th scope="col">Adres</th>
                        <th scope="col"></th>
                        <th scope="col">Verwijderen</th>
                        <th scope="col">Bewerken</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM stadions");
                    $stmt->execute();
                    $teams = $stmt->fetchAll();
                    foreach($teams as $row)
                    {
                        ?>
                        <tr>
                            <td scope="row"><?php echo $row['name']?></td>
                            <td scope="row"><?php echo $row['city']?></td>
                            <td scope="row"><?php echo $row['street'] . ', ' . $row['house'] . '<br>' . $row['postcode'] ?></td>
                            <td></td>
                            <td><?php echo '<a href="php/deleteStadion.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button> </a>'?></td>
                            <td><?php echo '<a href="php/editStadion.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-info"><i class="fas fa-edit"></i></button></a>'?></td>
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

    echo '<br> <p class="font-italic text-center text-danger"> Geen Stadion gevonden!.</p>';
}
?>
<hr width="100%">
</br> </br> </br> </br>
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h4 id="list-item-3" class="text-center">Stadion Teams</h4>
    </br>
    <div class="text-center w-50 mx-auto border border-info p-5">
        <form action="" method="post" class="teams-add-form" enctype="multipart/form-data">
            <div class="row">
                <div class="col text-left">
                    <label class="font-weight-bold" for="teamName">Team naam:</label>
                    <select class="form-control" name="teamName">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM teams where id not in (select fkteam from stadionteams)");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        if ($stmt->rowCount() > 0) {
                            foreach ($result as $rows) {
                                $teamName = $rows['name'];
                                $teamid = $rows['id'];
                                echo '<option value="' . $teamid . '">' . $teamName . '</option>';
                            }
                        }
                        else {
                            echo 'All teams has stadion!';
                        }
                        ?>
                    </select>
                </div>
            </div>
            </br> </br>
            <div class="row">
                <div class="col text-left">
                        <label class="font-weight-bold text-left" for="stadionName">Stadion naam:</label>
                        <select class="form-control" name="stadionName">';
                            <?php
                        $stmt = $conn->prepare("SELECT * FROM stadions");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $rows) {
                            $stadName = $rows['name'];
                            $stadCity = $rows['city'];
                            $stadionId = $rows['id'];
                            echo '<option value="' . $stadionId . '">' . $stadName . " , " . $stadCity . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <br><br>
             <input type="submit" class="btnRegister btn-primary active" name="submit_addTeamToStad"  value="Toevoegen"/>
            <br><br>

            <span style="color: red; font-size: 14pt;"><?php echo $err_msg; ?></span>

        </form>
    </div>
</div>


    <hr width="100%">
    <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h3 id="list-item-3" class="text-center">Team in stadions</h3>
<?php
// check if there are teams
$check = $conn->prepare("SELECT * FROM stadionteams");
$check->execute();
$stadionsTotal= $check->rowCount();
if ($stadionsTotal > 0) {
    ?>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-12 p-1">
                <h5 class="text-info p-1">Er zijn: <strong class="text-danger"> <?php echo $stadionsTotal?> </strong>teams gevonden!</h5>
                <table class="table table-image border table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Team</th>
                        <th scope="col">Stadion Naam</th>
                        <th scope="col">Plaats</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT stadionteams.id as currentID, teams.*, stadions.*  FROM stadionteams 
                    inner join teams on stadionteams.fkteam = teams.id
                    inner join stadions on stadionteams.fkstad = stadions.id
                    ");
                    $stmt->execute();
                    $stadions = $stmt->fetchAll();
                    foreach($stadions as $row)
                    {
                        ?>
                        <tr>
                            <td class="w-25 h-auto">
                                <img src="<?php echo $row['path']?>" title="<?php echo $row['image']?>" class="img-circle" width="150" height="150" alt="">
                            </td>
                            <td scope="row"><?php echo $row['name']?></td>
                            <td scope="row"><?php echo $row['city']?></td>
                            <td><?php echo '<a href="php/deleteTeamStadion.php?id='. $row['currentID'] .'"> <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button> </a>'?></td>
<!--                            <td>--><?php //echo '<a href="php/editTeamStadion.php?id='. $row['currentID'] .'"> <input type="submit" name="submit" value="Bewerken" class="btn btn-info" > </a>'?><!--</td>-->
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

    echo '<br> <p class="font-italic text-center text-danger"> Geen teams in all stadions gevonden!.</p>';
}

