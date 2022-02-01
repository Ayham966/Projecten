<?php

function isAdmin() {
    if ( $_SESSION['admin'] === true ) {
        return true;
    } else {
        header("location: index.php");
        return false;
    }
}

function get_time_toAgenda ($checkDate , $checkRoom, $checkTimes)
{
    include("../config/connection.php");
    $sql = "Select * from overview where date=:date and fkroom=:room";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("date", $checkDate);
    $stmt->bindParam("room", $checkRoom);
    $stmt->execute();
    $disabled = $stmt->fetchAll();
    foreach ($disabled as $item) {
        if ($checkTimes === $item['time']) {
            return true;
        }
    }
    return false;
}
function get_time_reserveren($checkDate , $checkFilm)
{
    include("config/connection.php");
    $sql = "Select * from overview where date=:date and fkfilm=:film";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("date", $checkDate);
    $stmt->bindParam("film", $checkFilm);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function get_movie_info($filmID)
{
    include("config/connection.php");
    $sql = "Select * from movies where id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam("id", $filmID);
    $stmt->execute();
    $movieInfo = $stmt->fetchAll();
    return $movieInfo;
}

function checkDisable($overviewID , $numberI) {
    include("../config/connection.php");
    $sql = "SELECT * FROM `overview_users` where fkover =:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $overviewID);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $item) {
        if ($numberI == $item['seatNumber']) {
            return true;
        }
    }
    return false;

}

