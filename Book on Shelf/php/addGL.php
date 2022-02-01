<?php
include('../private/connection.php');
include("../includes/header.inc.php");
$last_err = "";
?>
<br><br><br><br>
<div class="wrapper">
    <div class="container-fluid col-4 mx-auto">
        <div class="row">
            <div class="col-md-12 ">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="lang" class="font-weight-bold col-sm-12 col-form-label">New Language:</label>
                        <div class="col-sm-12">
                            <span class="help-block" style="color: red"><?php echo $last_err;?></span>
                            <input type="text" class="form-control" name="lang" placeholder="Enter a new Language">
                            <input type="submit" class="form-control btn-success" name="new_lang" value="Add">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Genres" class="font-weight-bold col-sm-12 col-form-label">New Genre:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="genre" placeholder="Enter a new Genre">
                            <input type="submit" class="form-control btn-success" name="new_genre" value="Add">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['new_lang'])) {
    if (!empty($_POST['lang'])) {
        $newLang = trim($_POST["lang"]);
        $sql = $conn->prepare('INSERT INTO languages (name) value (?);');
        if ($sql->execute([$newLang])) {
            echo '
                                    <div class="fixed-bottom w-100">
                                    <button class="btn btn-primary text-success-50" style="min-width: 100%;" type="button" disabled>
                                 <span class="spinner-border spinner-border" role="status" aria-hidden="true">
                                 </span>
                                 Loading...
                                     </button>   
                                    </div>
                                    <script> 
                                setTimeout(() => { alert("Success, Your new Language is added!") }, 1000)
                                  setTimeout(function(){  location.href = "../index.php?page=genreAndlang";},2000);
                              </script> ';
        } else {
            echo 'Something went wrong!';
        }

    }
    else {
        $lang_err = "Please enter the new lang";

    }
}

if (isset($_POST['new_genre'])) {
    if (!empty($_POST['genre'])) {
        $newGenre = trim($_POST["genre"]);
        $stmt = $conn->prepare('INSERT INTO genres (name) value (?);');
        if ($stmt->execute([$newGenre])) {
            echo '
                                    <div class="fixed-bottom w-100">
                                    <button class="btn btn-primary text-success-50" style="min-width: 100%;" type="button" disabled>
                                 <span class="spinner-border spinner-border" role="status" aria-hidden="true">
                                 </span>
                                 Loading...
                                     </button>   
                                    </div>
                                    <script> 
                                setTimeout(() => { alert("Success, Your new Genre is added!") }, 1000)
                                  setTimeout(function(){  location.href = "../index.php?page=genreAndlang";},2000);
                              </script> ';
        } else {
            echo 'Something went wrong!';
        }

    }
    else {
        $lang_err = "Please enter the new Genre";

    }
}

