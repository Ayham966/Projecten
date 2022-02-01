<div class="row">
    <div class="col-12" id="tour-photo" >
        <div class="overlay"></div>
        <div class="head-text">
        </div>
    </div>
</div>
</br> </br>

<?php
if( isset($_SESSION['admin'])) {
    echo '
             <ul class="nav justify-content-reserve">
                <li class="nav-item">
                    <a class="nav-link" href="php/makeTour.php"><button class="btn btn-success">Toernooi Aanmaken</button></a>
                </li>
             </ul>
                    ';
}
?>
</br> </br>
<hr width="100%">
<div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-teams">
    <h3 id="list-item-1" class="text-center">Alle Toernooien</h3>
    <?php
    // check if there are teams
    $stmt = $conn->prepare("SELECT * FROM tournaments");
    $stmt->execute();
    $toursTotal= $stmt->rowCount();
    $teams = $stmt->fetchAll();
    if ($toursTotal > 0) {
    ?>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-12 p-1">
                <h5 class="text-info p-1">Er zijn: <strong class="text-danger"> <?php echo $toursTotal?> </strong>Toernooi!</h5>
            </div>
        </div>

        <div class="row p-3">
            <table class="table table-image border table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Startdatum:</th>
                    <th scope="col">Naam:</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach($teams as $row)
                {
                    $date = $row['startDate'];
                    $name = $row['name'];
                    $tourId = $row['id'];
                    ?>
                    <tr>
                        <td scope="row"><?php echo$date?></td>
                        <td scope="row"><?php echo $name?></td>
                        <td><?php echo '<a href="index.php?page=tournament_details&id='. $tourId .'"> <input type="submit" name="submit" value="Bekijk" class="btn btn-warning" > </a>'?></td>
                        <?php
                        if( isset($_SESSION['admin'])) {
                            ?>
                        <td><?php echo '<a href="php/deleteTour.php?id='. $tourId .'"> <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button> </a>'?></td>
                        <td><?php echo '<a href="php/editTour.php?id='. $tourId .'"> <button type="submit" name="submit" class="btn btn-info"><i class="fas fa-edit"></i> </button> </a>'?></td>
                            <?php
                        }
                        ?>
                    </tr>
                <?php
                } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php
}
else {
    echo '<br> <p class="font-italic text-center text-danger" style="font-size: 14pt;"> Geen Tournaments gevonden!</p>';
}



?>





