<?php
include('../private/connection.php');
include("../includes/header.inc.php");

$name = $writer = $genre = $ISBN = $lang = $pages = $copy = $price = "";
$name_err = $writer_err = $genre_err = $ISBN_err = $lang_err = $pages_err = $copy_err = $price_err = "";


if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } else{
        $name = $input_name;
    }

    $input_writer = trim($_POST["writer"]);
    if(empty($input_writer)){
        $writer_err = "Please enter a writer.";
    } else{
        $writer = $input_writer;
    }

    $input_genre = trim($_POST["genre"]);
    if(empty($input_genre)){
        $genre_err = "Please enter the genre.";
    }  else{
        $genre = $input_genre;
    }

    $input_ISBN = trim($_POST["ISBN"]);
    if(empty($input_ISBN)){
        $ISBN_err = "Please enter ISBN-number.";
    } elseif(!ctype_digit($input_ISBN)){
        $ISBN_err = "Please enter a positive integer value.";
    } else{
        $ISBN = $input_ISBN;
    }

    $input_lang = trim($_POST["lang"]);
    if(empty($input_lang)){
        $lang_err = "Please enter the language.";
    }
    else{
        $lang = $input_lang;
    }

    $input_pages = trim($_POST["pages"]);
    if(empty($input_pages)){
        $pages_err = "Please enter the pages amount.";
    } elseif(!ctype_digit($input_pages)){
        $pages_err = "Please enter a positive integer value.";
    } else{
        $pages = $input_pages;
    }

    $input_copy = trim($_POST["copy"]);
    if(empty($input_copy)){
        $copy_err = "Copies amount can't be 0, please enter the copy amount.";
    } elseif(!ctype_digit($input_copy)){
        $copy_err = "Please enter a positive integer value.";
    } else{
        $copy = $input_copy;
    }

    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }

    if(empty($name_err) && empty($writer_err) && empty($genre_err)  && empty($ISBN_err)  && empty($lang_err)  && empty($pages_err)  && empty($copy_err)&& empty($price_err)){

        $sql = "UPDATE books SET name=:Name, writer=:Writer, genre=:Genre, ISBN=:ISBN, language=:Language, pages=:Pages, copies=:Copies, price=:Price  WHERE id=:id";

        if($stmt = $conn->prepare($sql)){

            $stmt->bindParam(":Name", $param_name);
            $stmt->bindParam(":Writer", $param_writer);
            $stmt->bindParam(":Genre", $param_genre);
            $stmt->bindParam(":ISBN", $param_ISBN);
            $stmt->bindParam(":Language", $param_lang);
            $stmt->bindParam(":Pages", $param_pages);
            $stmt->bindParam(":Copies", $param_copy);
            $stmt->bindParam(":Price", $param_price);
            $stmt->bindParam(":id", $param_id);

            $param_name = $name;
            $param_writer = $writer;
            $param_genre = $genre;
            $param_ISBN = $ISBN;
            $param_lang = $lang;
            $param_pages = $pages;
            $param_copy = $copy;
            $param_price = $price;
            $param_id = $id;

            if($stmt->execute()){
                header("location: ../index.php?page=product");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        unset($stmt);

    }

    unset($conn);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM books WHERE id = :id";
        if($stmt = $conn->prepare($sql)){
            $stmt->bindParam(":id", $param_id);
            $param_id = $id;

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $name = $row["Name"];
                    $writer = $row["Writer"];
                    $genre = $row["Genre"];
                    $ISBN = $row["ISBN"];
                    $lang = $row["Language"];
                    $pages = $row["Pages"];
                    $copy = $row["Copies"];
                    $price = $row["Price"];
                } else{
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        unset($stmt);

        unset($conn);
    }  else{
        exit();
    }
}
?>
</br></br>
<div class="wrapper ">
    <div class="container-fluid col-4 mx-auto">
        <div class="row">
            <div class="col-md-12 ">
                <div class="page-header">
                    <h2>Update Book</h2>
                </div>
                <p>Please edit and submit to update the book info.</p>
                <form action="" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block" style="color: red"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($writer_err)) ? 'has-error' : ''; ?>">
                        <label>Writer</label>
                        <input type="text" name="writer" class="form-control" value="<?php echo $writer; ?>">
                        <span class="help-block" style="color: red"><?php echo $writer_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>">
                        <label>Genre:</label>
                        <select class="form-control" name="genre">
                            <?php
                            include('../private/connection.php');
                            $stmt = $conn->prepare("SELECT * FROM genres");
                            $stmt->execute();
                            $genres = $stmt->fetchAll();
                            foreach($genres as $rows){
                                $result = $rows['name'];
                                echo"<option>$result</option>";
                            }
                            ?>
                        </select>
                        <span class="help-block" style="color: red"><?php echo $genre_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($ISBN_err)) ? 'has-error' : ''; ?>">
                        <label>ISBN-Number</label>
                        <input type="text" name="ISBN" class="form-control" value="<?php echo $ISBN; ?>">
                        <span class="help-block" style="color: red"><?php echo $ISBN_err;?></span>

                        <div class="form-group <?php echo (!empty($lang_err)) ? 'has-error' : ''; ?>">
                            <label>Language</label>
                            <select class="form-control" name="lang">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM languages");
                                $stmt->execute();
                                $lang = $stmt->fetchAll();
                                foreach($lang as $rows){
                                    $result = $rows['name'];
                                    echo"<option>$result</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block" style="color: red"><?php echo $lang_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pages_err)) ? 'has-error' : ''; ?>">
                            <label>Pages:</label>
                            <input type="text" name="pages" class="form-control" value="<?php echo $pages; ?>">
                            <span class="help-block" style="color: red"><?php echo $pages_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($copy_err)) ? 'has-error' : ''; ?>">
                            <label>Copies:</label>
                            <input type="text" name="copy" class="form-control" value="<?php echo $copy; ?>">
                            <span class="help-block" style="color: red"><?php echo $copy_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Price:</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block" style="color: red"><?php echo $price_err;?></span>
                        </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="../index.php?page=product" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</br></br>
