<?php
include("../private/connection.php");
include("../includes/header.inc.php");

$name = $writer = $genre = $ISBN = $lang = $pages = $copy = $price = "";
$name_err = $writer_err = $genre_err = $ISBN_err = $lang_err = $pages_err = $copy_err = $price_err = $info_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    $input_writer = trim($_POST["writer"]);
    if (empty($input_writer)) {
        $writer_err = "Please enter a writer.";
    } else {
        $writer = $input_writer;
    }

    $input_genre = trim($_POST["genre"]);
    if (empty($input_genre)) {
        $genre_err = "Please enter the genre.";
    } else {
        $genre = $input_genre;
    }

    $input_ISBN = trim($_POST["ISBN"]);
    if (empty($input_ISBN)) {
        $ISBN_err = "Please enter ISBN-number.";
    } elseif (!ctype_digit($input_ISBN)) {
        $ISBN_err = "Please enter a positive integer value.";
    } else {
        $ISBN = $input_ISBN;
    }

    $input_lang = trim($_POST["lang"]);
    if (empty($input_lang)) {
        $lang_err = "Please enter the language.";
    } else {
        $lang = $input_lang;
    }

    $input_pages = trim($_POST["pages"]);
    if (empty($input_pages)) {
        $pages_err = "Please enter the pages amount.";
    } elseif (!ctype_digit($input_pages)) {
        $pages_err = "Please enter a positive integer value.";
    } else {
        $pages = $input_pages;
    }

    $input_copy = trim($_POST["copy"]);
    if (empty($input_copy)) {
        $copy_err = "Copies amount can't be 0, please enter the copy amount.";
    } elseif (!ctype_digit($input_copy)) {
        $copy_err = "Please enter a positive integer value.";
    } else {
        $copy = $input_copy;
    }

    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price amount.";
    } elseif (!ctype_digit($input_price)) {
        $price_err = "Please enter a positive integer value.";
    } else {
        $price = $input_price;
    }


    if (!empty($name) && !empty($writer) && !empty($genre) && !empty($ISBN) && !empty($lang) && !empty($pages) && !empty($copy) && !empty($price)) {
        if (empty($name_err) && empty($writer_err) && empty($genre_err) && empty($ISBN_err) && empty($lang_err) && empty($pages_err) && empty($copy_err) && empty($price_err)) {
            $sql = "INSERT INTO books (name, writer, genre, ISBN, language, pages, copies, price) VALUES (:Name, :Writer, :Genre, :ISBN, :Language, :Pages, :Copies, :Price )";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":Name", $param_name);
                $stmt->bindParam(":Writer", $param_writer);
                $stmt->bindParam(":Genre", $param_genre);
                $stmt->bindParam(":ISBN", $param_ISBN);
                $stmt->bindParam(":Language", $param_lang);
                $stmt->bindParam(":Pages", $param_pages);
                $stmt->bindParam(":Copies", $param_copy);
                $stmt->bindParam(":Price", $param_price);

                $param_name = $name;
                $param_writer = $writer;
                $param_genre = $genre;
                $param_ISBN = $ISBN;
                $param_lang = $lang;
                $param_pages = $pages;
                $param_copy = $copy;
                $param_price = $price;

                if ($stmt->execute()) {
                    echo '
                               <button class="btn btn-primary" type="button" disabled>
                                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                  Loading...
                                </button>   
                                  <script> 
                                    setTimeout(() => { alert("Success, Book is added!") }, 1000)
                                  setTimeout(function(){  location.href = "../index.php?page=product";},3000);
                             </script> ';
                } else {
                    echo "<div class='alert alert-danger alert-dismissible'  >
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Error!
                </div>";
                }

                unset($stmt);

            }

            unset($conn);
        }


    } else {
        $info_err = "** Please fill all information!";
    }
}
?>
</br></br>
<div class="wrapper">
    <div class="container-fluid col-4 mx-auto">
        <div class="row">
            <div class="col-md-12 ">
                <div class="page-header">
                    <h2>Add Book</h2>
                </div>
                <p>Please add here the book info.</p>
                <form action="" method="post">
                    <span class="help-block"
                          style="color: yellowgreen; font-style: revert; font-size: 12pt;"><?php echo $info_err; ?></span>
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block" style="color: red"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($writer_err)) ? 'has-error' : ''; ?>">
                        <label>Writer</label>
                        <input type="text" name="writer" class="form-control" value="<?php echo $writer; ?>">
                        <span class="help-block" style="color: red"><?php echo $writer_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($genre_err)) ? 'has-error' : ''; ?>">
                        <label>Genre:</label>
                        <select class="form-control" name="genre">
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM genres");
                            $stmt->execute();
                            $genres = $stmt->fetchAll();
                            foreach ($genres as $rows) {
                                $result = $rows['name'];
                                echo "<option>$result</option>";
                            }
                            ?>
                        </select>
                        <span class="help-block" style="color: red"><?php echo $genre_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($ISBN_err)) ? 'has-error' : ''; ?>">
                        <label>ISBN-Number</label>
                        <input type="text" name="ISBN" class="form-control" value="<?php echo $ISBN; ?>">
                        <span class="help-block" style="color: red"><?php echo $ISBN_err; ?></span>

                        <div class="form-group <?php echo (!empty($lang_err)) ? 'has-error' : ''; ?>">
                            <label>Language</label>
                            <select class="form-control" name="lang">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM languages");
                                $stmt->execute();
                                $lang = $stmt->fetchAll();
                                foreach ($lang as $rows) {
                                    $result = $rows['name'];
                                    echo "<option>$result</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block" style="color: red"><?php echo $lang_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pages_err)) ? 'has-error' : ''; ?>">
                            <label>Pages:</label>
                            <input type="text" name="pages" class="form-control" value="<?php echo $pages; ?>">
                            <span class="help-block" style="color: red"><?php echo $pages_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($copy_err)) ? 'has-error' : ''; ?>">
                            <label>Copies:</label>
                            <input type="text" name="copy" class="form-control" value="<?php echo $copy; ?>">
                            <span class="help-block" style="color: red"><?php echo $copy_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Price:</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block" style="color: red"><?php echo $price_err; ?></span>
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



