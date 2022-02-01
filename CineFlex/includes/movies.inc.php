<!-- Search functionality -->
<nav class="navbar navbar-light justify-content-center p-3">
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" id="searchbox">
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </form>
</nav>

<!-- Cards -->
<div class="layout-margin-8 mt-5">
    <div class="row">
        <?php
        $stmt = $conn->prepare("SELECT * FROM movies");
        $stmt->execute();
        $result = $stmt->fetchAll();
        if ($stmt->rowCount() > 0) :
        foreach ($result as $product) : ?>
        <div class="col-lg-4 pb-4" data-role="recipe">
            <div class="card h-100">
                <a href="index.php?page=overview&movie=<?php echo $product["id"]?>">
                    <img height="250" class="card-img-top" title="<?php echo $product["image"] ?>" src="<?php echo $product["path"]?>" alt="card-img"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="index.php?page=overview&movie=<?php echo $product["id"]?>"><?php echo $product["name"]?></a></h5>
                    <p class="card-text">
                        <span><b>leeftijd:</b> +<?php echo $product["age"]?></span>
                    </p>
                    <p class="card-text">
                        <span><b>Jaar:</b> <?php echo $product["year"]?></span>
                    </p>
                    <p class="card-text" id="desc">
                        <span><b>Beschrijven: </b> <br><p id="desc_info"><?php echo $product["description"]?></p> </span>
                    </p>
                </div>
                <div class="card-footer text-muted text-truncate">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM genres 
                        inner join genres_film on genres_film.FKgenre = genres.id
                        where genres_film.FKfilm = :id");
                    $stmt->bindParam("id" , $product["id"]);
                    $stmt->execute();
                    $resultGenre = $stmt->fetchAll();
                    foreach ($resultGenre as $genreNaam)  {
                        echo '<span class="badge badge-secondary m-1"> '. $genreNaam['name'] .'</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach; endif?>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#searchbox").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $('div[data-role="recipe"]').filter(function() {
            $(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)
});
    });
});
</script>


