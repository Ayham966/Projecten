<?php
    $sql = "Select distinct fkfilm from overview 
    inner join movies on overview.fkfilm = movies.id
    where overview.date=:today
    ";
    $stmt = $conn->prepare($sql);
    $today = date("y-m-d");
    $test = "2021-11-14";
    $stmt->bindParam(":today", $today);
    $stmt->execute();
    $result = $stmt->fetchAll();

?>
<div class="container-fluid home-page">
    <br>
        <div id="myCarousel" class="carousel slide " data-ride="carousel">
            <div class="d-flex flex-row">
                <div class="p-2"><h3 class="text-white"> > Vandaag</h3></div>
            </div>
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $info = get_movie_info($row['fkfilm']);
                    foreach ($info as $rows) {
                        $i++;
                        echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
                    }
                }
                ?>
            </ol>
            <!-- Wrapper for carousel items -->
            <div class="row">
                <div class="carousel-inner" role="listbox">
                    <?php
                    $i = -1;
                    foreach ($result as $row) {
                        $info = get_movie_info($row['fkfilm']);
                        foreach ($info as $rows)  { $i++; ?>
                            <div class="carousel-item <?php if ($i === 0) echo "active";?>">
                                <img width="1100" height="600" title="<?php echo $rows["image"] ?>" src="<?php echo $rows["path"]?>" alt="<?php echo $i?>Slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <a class="text-light" href="index.php?page=overview&movie=<?php echo $rows["id"]?>">
                                     <h2 class="display-4"><?php echo $rows['name']?></h2>
                                </div>
                            </div>
                        <?php
                       }
                    }
                    ?>
                </div>
            </div>
            <!-- Carousel controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                Vorige<span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                Volgende<span class="carousel-control-next-icon"></span>
            </a>
        </div>
    <br>
</div>
<div class="container">
    <br>
    <h2 class="text-white">> Deze week</h2>
    <div class="row">
    <?php
    $stmt = $conn->prepare("SELECT * FROM movies");
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() > 0) : foreach ($result as $product) :?>
            <div class="col-md-3">
                <a class="text-light" href="index.php?page=overview&movie=<?php echo $product["id"]?>">
                <div class="film-card"><img src="<?php echo $product['path']?>" class="img img-responsive" alt="<?php echo $product['image']?>">
                    <div class="film-name"><?php echo $product['name']?>
                        <br>
                    </div>
                    <div class="film-overview">
                        <div class="film-overview">
                            <div class="row text-center">
                                <div class="col-xs-4 p-3">
                                    <h3><?php echo $product['year']?></h3>
                                    <p>Jaar</p>
                                </div>
                                <div class="col-xs-4 p-3">
                                    <h3>+<?php echo $product['age']?></h3>
                                    <p>Leeftijd</p>
                                </div>
                                <div class="col-xs-4 p-3">
                                    <h3><?php
                                        $date = strtotime($product['length']);
                                        echo date('H:i', $date); ?></h3>
                                    <p>Lengte</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; endif;?>
    </div>
</div>
