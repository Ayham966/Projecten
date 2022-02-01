<?php isAdmin(); ?>
<div class="layout-margin-8 mt-5">
    <div class="d-flex flex-row">
        <div class="p-2"><h2 class="text-white"> > Movies</h2></div>
    </div>
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <a href="./php/addMovie.php"><button class="btn bg-success text-white">Toevoegen +</button></a>
        </div>
    </div>
    <?php
    // get movies
    $stmt = $conn->prepare("SELECT * FROM movies");
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($stmt->rowCount() > 0) :
    foreach ($result as $product) : ?>
    <div class="row p-2 m-1 bg-white border border-dark rounded">
        <div class="col-md-3 mt-1">
            <a href="index.php?page=overview&movie=<?php echo $product["id"]?>">
                <img class="img-fluid img-responsive rounded" width="250" title="<?php echo $product["image"] ?>" src="<?php echo $product["path"]?>">
            </a>
        </div>
        <div class="col-md-6 mt-1">
            <form method="post" action="">
                <a href="index.php?page=overview&movie=<?php echo $product["id"]?>">
                    <h5 class="text-center text-success"><?php echo $product["name"] ?></h5>
                </a>
                <?php
                // get genres of movies
                $stmt = $conn->prepare("SELECT * FROM genres 
                        inner join genres_film on genres_film.FKgenre = genres.id
                        where genres_film.FKfilm = :id");
                $stmt->bindParam("id" , $product["id"]);
                $stmt->execute();
                $resultGenre = $stmt->fetchAll();
                ?>
                <div class="mt-1 mb-1 spec-1"><span><b>leeftijd:</b></span><span class="dot"></span><span> + <?php echo $product["age"] ?> </span></div>
                <div class="mt-1 mb-1 spec-1"><span><b>Jaar:</b></span><span class="dot"></span><span> <?php echo $product["year"]?> </span></div>
                <div class="d-flex flex-row">
                    <div class="ratings mr-2">
                         <div class="d-flex flex-row">
                             <span><b>Genre:</b></span>
                         </div>
                        <?php foreach ($resultGenre as $genreNaam) : ?>
                            <i class="fa fa-star p-2 bg-dark text-white"><?php echo " " . $genreNaam["name"] ?> </i>
                        <?php endforeach;?>
                    </div>
                </div>
                <p class="text-justify text-truncate para mb-0"><b>Description:</b><br><?php echo $product["description"]?><br></p>
        </div>
        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
            <div class="d-flex flex-column mt-4">
                <a href="php/editMovie.php?id=<?php echo $product['id']?>"> <input type="button" class="btn btn-outline-info btn-sm mt-2 w-100 active" value="Bewerken"></a>
                <a href="php/confirm.php?filmID=<?php echo $product['id']?>"> <input type="button" class="btn btn-outline-danger btn-sm mt-2 w-100 active" value="Verwijderen"></a>
            </div>
            </form>
        </div>
    </div>
    <?php
    endforeach;
    else : echo '<h2 class="text-danger">Geen movies gevonden!</h2>';
    endif;
    ?>

