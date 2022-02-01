
<div class="layout-margin-8 mt-5">
    <div class="d-flex flex-row">
        <div class="p-2"><h2 class="text-white"> > Agenda</h2></div>
    </div>
    <?php if (isset($_SESSION['admin'])) : ?>
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <a href="./php/addToAgenda.php"><button class="btn bg-success text-white">Toevoegen +</button></a>
        </div>
    </div>
    <?php endif ?>
        <div class="container">
            <hr />
            <div class="agenda">
                <div class="table-responsive bg-light">
                    <table class="table table-condensed">
                        <thead class="text-success">
                        <tr>
                            <th>Datum</th>
                            <th>Tijd</th>
                            <th class="text-center">Film</th>
                            <th>Zaal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT DISTINCT date FROM overview order by date ASC";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $dates = $stmt->fetchAll();
                        foreach ($dates as $row):

                            $sql2 = "Select *, movies.name as movieName, rooms.name as roomName from overview 
                            inner join movies on overview.fkfilm = movies.id
                            inner join rooms on overview.fkroom = rooms.id 
                            where overview.date=:dates order by time ASC
                            ";
                            $stmt = $conn->prepare($sql2);
                            $stmt->bindParam(":dates", $row['date']);
                            $stmt->execute();
                            $count = $stmt->rowCount();
                            $result = $stmt->fetchAll();

                            $weekday_dutch = array(
                                "Sun" => "Zondag",
                                "Mon" => "Maandag",
                                "Tue" => "Dinsdag",
                                "Wed" => "Woensdag",
                                "Thu" => "Donderdag",
                                "Fri" => "Vrijdag",
                                "Sat" => "Zaterdag",
                            );
                            $dayToDutch = date("D", strtotime($row['date']));
                            $currDay = $weekday_dutch[$dayToDutch];
                            setlocale(LC_TIME, 'nl_NL');
                            ?>
                        <tr>
                                <td class="agenda-date active">
                                    <div class="dayofmonth"><?php echo date("d", strtotime($row['date'])); ?></div>
                                    <div class=""><?php echo $currDay; ?></div>
                                    <div class="shortdate text-muted"><?php echo date("M-Y", strtotime($row['date'])); ?></div>
                                </td>

                                <td class="agenda-time">
                                    <?php foreach ($result as $row2) : ?>
                                    <div class="agenda-time">
                                    <?php echo $row2['time']; ?>
                                    </div>
                                    <?php endforeach;?>
                                </td>
                                <td class="agenda-events text-center">
                                    <?php foreach ($result as $row2) : ?>
                                    <div class="agenda-event">
                                        <i class="glyphicon glyphicon-repeat text-muted" title="Repeating event"></i>
                                        <a href="index.php?page=overview&movie=<?php echo $row2["fkfilm"]?>"><?php echo $row2['movieName']?></a>
                                    </div>
                                    <?php endforeach;?>
                                </td>
                                <td class="agenda-room">
                                    <?php foreach ($result as $row2) : ?>
                                    <div class="agenda-room">
                                        <?php echo $row2['roomName']?>
                                    </div>
                                    <?php endforeach;?>
                                </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <br>
</div>

