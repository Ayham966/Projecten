<?php
header("Cache-Control: no cache");
isAdmin();
$sql = $conn->prepare("SELECT * FROM genres order by name");
$sql->execute();
$genres = $sql->fetchAll();
$err_msg = "";

//add genre
if (isset($_POST['submit'])) {
    $newGenre = $_POST['genre'];
    $sql = "SELECT * from genres where name=:name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $newGenre);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $checkOld = strtolower($row['name']);
    $checkNew = strtolower($newGenre);
    if ($checkOld != $checkNew) {
        $sql = $conn->prepare('INSERT INTO genres (name) VALUES (?);');
        if ($sql->execute([$newGenre])) {
            echo '
                  <script> 
                    setTimeout(function(){  location.href = "index.php?page=genres";});
                  </script> ';
        } else {
            echo 'Er is iets misgegaan!';
        }
    } else {
        $err_msg = 'Deze genre bestaat al!';
    }
}

?>
<div class="layout-margin-8 mt-5 ">
    <div class="d-flex flex-row">
        <div class="p-2"><h2 class="text-white"> > Genres</h2></div>
    </div>
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <button class="btn bg-success text-white" data-toggle="modal" data-target="#exampleModalCenter">Toevoegen +</button>
        </div>
    </div>
    <?php if ( ($err_msg)) : ?>
    <div class="alert alert-danger w-50 text-center mx-auto" role="alert">
        <?php echo $err_msg; ?>
    </div>
    <?php endif;?>
    <br>
    <div class="row rounded p-3 genreContent">
        <div class="col-2">
                <form method="post" action="">
                    <label class="text-light">Seleteer een genre:</label>
                    <select class="form-control" name="genre">
                        <?php
                            foreach($genres as $row) :
                            $sql = $conn->prepare("SELECT * FROM genres_film where FKgenre = :id");
                            $sql->bindParam(":id" , $row['id']);
                            $sql->execute();
                            $amount = $sql->rowCount(); ?>
                            <option value="<?php echo $row['id']?>"
                            <?php
                            if ( isset($_POST['selectGenre']))  {
                                if ( $_POST['genre'] == $row['id'] ) {
                                    echo 'selected';
                                }
                            } ?> >
                             <?php echo $row['name'] . " " . "(" . $amount . ")"; ?></option>
                        <?php endforeach ?>
                    </select> <br>
                    <button class="btn btn-secondary btn-sm w-100" type="submit" name="selectGenre">Zoeken</button>
                </form>
            <br>
                <?php if ( isset($_POST['selectGenre'])) :
                    $genreID = $_POST['genre'];?>
                    <a  class="btn btn-danger btn-md" href="php/confirm.php?id=<?php echo $genreID?>" ><i class="fa fa-trash fa-xs"></i> </a>
                    <a  class="btn btn-info btn-md" href="php/editGenre.php?id=<?php echo $genreID?>"><i class="fa fa-edit fa-xs"></i> </a>
                <?php endif; ?>
        </div>
        <div class="col-10">
                 <div class="row">
             <?php
             if ( isset($_POST['selectGenre']) ) :
                    $genreID = $_POST['genre'];
                    $sql = $conn->prepare("SELECT * FROM genres_film
                    inner join movies on genres_film.FKfilm = movies.id
                    where genres_film.FKgenre = :id");
                     $sql->bindParam(":id" , $genreID);
                     $sql->execute();
                     $movies = $sql->fetchAll();
                     foreach ($movies as $product) : ?>
                         <div class="col-lg-4 pb-4">
                             <div class="card h-100">
                                 <a href="index.php?page=overview&movie=<?php echo $product["id"]?>"><img height="250" class="card-img-top" title="<?php echo $product["image"] ?>" src="<?php echo $product["path"]?>" alt="film-Name"></a>
                                 <div class="card-body">
                                     <h5 class="card-title"><a href="index.php?page=overview&movie=<?php echo $product["id"]?>"><?php echo $product["name"]?></a></h5>
                                     <p class="card-text">
                                         <span><b>leeftijd:</b> +<?php echo $product["age"]?></span>
                                     </p>
                                     <p class="card-text">
                                         <span><b>Jaar:</b> <?php echo $product["year"]?></span>
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
                     <?php endforeach;?>
                 <?php endif;?>
                 </div>
             </div>
        </div>
    </div>
</div>

<!-- Modal Add genre-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Genre toevoegen:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    <input class="form-control form-control-lg" name="genre" type="text" placeholder="Genre naam">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Annuleren</button>
                    <button type="submit" class="btn btn-danger" name="submit"> Toevoegen </button>
                </div>
            </form>
        </div>
    </div>
</div>

