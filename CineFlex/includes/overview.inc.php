<?php
if ( !isset($_GET['movie'])) {
    header("location: index.php");
}else {
    $movieID = $_GET['movie'];
    $stmt = $conn->prepare("SELECT fkfilm FROM overview where id=:id");
    $stmt->bindParam(":id", $movieID);
    $stmt->execute();
    $check = $stmt->rowCount();
    if ( $check > 0 ) {
        $stmt = $conn->prepare("SELECT *, overview.date as fdate, overview.time as ftime FROM movies
        inner join overview on movies.id = overview.fkfilm
        where movies.id=:id
        ");
        $stmt->bindParam(":id", $movieID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ( $result as $row ) {
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM movies where id=:id");
        $stmt->bindParam(":id", $movieID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ( $result as $row ) {
        }
    }


    $row['video'] =! ""  ? $link = $row['video'] : $link = "";
    $clear =  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$row['video']);
}

?>
    <div class="container-fluid overview-page" style="background-image: url(<?php echo $row['path'];?>)">
        <div class="overview-text">
            <h1><?php echo $row['name'];?></h1>
            <?php if ($row['video']) : ?>
            <a href="#videoTube" class="btn btn-danger btn-lg" data-toggle="modal"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            <?php endif;?>
        </div>
    </div>

    <div class="container p-3 text-light">
        <h2>Beschrijven:</h2>
        <p class="font-bold"> <?php echo $row['description'] ?></p>
        <hr>
        <ul class="list-items h5">
            <li class="p-3">Productiejaar: <span class="badge badge-pill m-2 badge-info"><?php echo $row['year'] ?></span></li>
            <li class="p-3">Leeftijd:<span class="badge badge-pill m-2 badge-danger">+<?php echo $row['age'] ?></span></li>
            <li class="p-3">Genre: <?php
                $sql = $conn->prepare("SELECT * FROM genres
                inner join genres_film on genres_film.FKgenre = genres.id
                where FKfilm = :id");
                $sql->bindParam(":id" , $movieID);
                $sql->execute();
                $resultGen = $sql->fetchAll();
                foreach ($resultGen as $genRow) {
                    echo '<span class="badge badge-pill m-2 badge-warning">'.$genRow['name'].'</span>';
                } ?>

            </li>
            <li class="p-3">Lengte: <span class="badge badge-pill m-2 badge-secondary p-2">
                    <?php $date = strtotime($row['length']); echo date('H:i', $date); ?>
                </span></li>
            <?php if (isset($_SESSION['loginID'])) : ?>
                <li class="p-3 ">Speeltijden:
                    <?php
                $stmt = $conn->prepare("SELECT distinct fkfilm, date from overview where fkfilm=:id order by date");
                $stmt->bindParam(":id", $movieID);
                $stmt->execute();
                if ($stmt->rowCount() > 0)  {
                    echo '(klik op de tijden om tickets te kopen)';
                $result2 = $stmt->fetchAll();
                foreach ( $result2 as $row2 ) :
                    $weekday_dutch = array(
                        "Sun" => "Zo",
                        "Mon" => "Ma",
                        "Tue" => "Di",
                        "Wed" => "Wo",
                        "Thu" => "Do",
                        "Fri" => "Vr",
                        "Sat" => "Za",
                    );
                    $dayToDutch = date("D", strtotime($row2['date']));
                    $days = $weekday_dutch[$dayToDutch];
                    $dates = date(" d M", strtotime($row2['date']));
                    $resultDate = $days . $dates;
                    ?>
                    <div class="mt-3 mx-auto">
                        <span class="h3"><?php  echo $resultDate ?> </span>
                        <?php $get_time = get_time_reserveren($row2['date'] , $movieID);
                        foreach ($get_time as $timesRow) : ?>
                            <form  action="php/reserve.php" method="get">
                                <span class="h3 text-center ">
                                    <button class="btn btn-sm btn-success" type="submit"><?php echo $timesRow['time'] ?></button>
                                    <input type="hidden" value="<?php echo $timesRow['id']?>" name="id">
                                </span>
                            </form>
                        <?php endforeach;?>
                    </div>
                    <hr class="bg-light">
                <?php endforeach;
                }
                else {
                    echo '<span class="h5 text-muted text-center">Nog niet gepland</span>';
                }
                ?>
                </li>
            <?php endif; ?>
        </ul>
    </div>

<!-- Modal HTML -->
<div id="videoTube" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $row['name'];?> trailer</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <?php echo $clear; ?>
                </div>
            </div>
        </div>
    </div>
</div>