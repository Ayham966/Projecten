<br>
<div class="row c2">
<?php
include('private/connection.php');
$stmt = $conn->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll();
foreach($books as $book) {
    $bookId = $book['id'];
    $bookCopy = $book['Copies'];
    if ($bookCopy > 0) {
        echo '
         <div class="col-md-4">
              <figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"><img src="images/book.png " alt="bookLogo"></a>
                <figcaption class="info-wrap">
                    <div class="row">
                        <div class="col-md-12 text-center"> <a href="#" class="title" data-abc="true">' . $book['Name'] . '</a> </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="writer text-sm-left">Writer: ' . $book['Writer'] . '</div>
                            <div class="writer text-lg-left">Genre: ' . $book['Genre'] . '</div>
                            <div class="writer text-lg-left">Language: ' . $book['Language'] . '</div>
                            <div class="writer text-lg-left">Pages: ' . $book['Pages'] . '</div>
                        </div>
                    </div>
                </figcaption>
                    <div class="bottom-wrap">
                        <form method="post">
                            <input type="submit" name="submit" class="btn btn-primary float-right" value="Borrow">
                             <input type="hidden" name="id" value="' . $bookId . '"/>
                             <input type="hidden" name="copy" value="' . $bookCopy . '"/>
                             <div class="price-wrap"> <span class="price h5">$' . $book['Price'] . '</span> <br> </div>
                        </form>
                 </div>
              </figure>
        </div>';
    }
}
foreach($books as $empty) {
    $bookId2 = $empty['id'];
    $bookCopy2 = $empty['Copies'];
    if ($bookCopy2 == 0) {
        echo '
    <div class="col-md-4">
        <figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"><img src="images/book.png " alt="bookLogo"></a>
            <figcaption class="info-wrap">
                <div class="row">
                    <div class="col-md-12 text-center"> <a href="#" class="title" data-abc="true">' . $empty['Name'] . '</a> </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="writer text-sm-left">Writer: ' . $empty['Writer'] . '</div>
                        <div class="writer text-lg-left">Genre: ' . $empty['Genre'] . '</div>
                        <div class="writer text-lg-left">Language: ' . $empty['Language'] . '</div>
                        <div class="writer text-lg-left">Pages: ' . $empty['Pages'] . '</div>           
                    </div>
                </div>
            </figcaption>
            <div class="bottom-wrap">
            <form method="post">
            <input type="submit" name="submit_reserve" class="btn btn-primary float-right" value="Reserve">
             <input type="hidden" name="id" value="' . $empty['id'] . '"/>
             <input type="hidden" name="copy" value="0"/>
                <div class="price-wrap"> <span class="price h5">$' . $empty['Price'] . '</span> <br>
                </div>
                </form>
                <div class="writer text-lg-left" style="color: red;">This book is not currently available. You can reserve it</div>
            </div>
        </figure>
    </div> ';
    }
}

    if (isset($_POST['submit'])) {
        if (isset($_SESSION['admin'])  || isset($_SESSION['klant'])) {
            if (!isset($_SESSION['admin']) && isset($_SESSION['klant'])) {
                $id = $_POST['id'];
                $copy = $_POST['copy'];
                $userId = $_SESSION['loginID'];
                // check if amount more than 3
                $stmt = $conn->prepare("SELECT
                      *
                    FROM
                      lenen
                      INNER JOIN customers ON lenen.FKuser = customers.id
                      INNER JOIN books ON lenen.Fkbook = books.id
                    WHERE
                      customers.id =:id and start is not null");
                $stmt->bindParam(":id", $param_id);
                $param_id = $userId;
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 2);
                if ($stmt->rowCount() < 3) {
                    $check = $conn->prepare("SELECT Fkbook FROM lenen where FKuser=:fkuser and Fkbook=:fkbook and start is not null");
                    $check->bindParam(":fkuser", $userId);
                    $check->bindParam(":fkbook", $id);
                    $check->execute();
                    $found = $check->fetch();
                    if( !$found ) {
                            //add the book to lenen books.
                            $sql = "INSERT INTO lenen (FKuser , FKbook, start) VALUES (:userId, :bookId, :today)";
                            $st = $conn->prepare($sql);
                            $st->bindParam(":userId", $param_user);
                            $st->bindParam(":bookId", $param_book);
                            $st->bindParam(":today", $param_date);
                            $param_user = $userId;
                            $param_book = $id;
                            $param_date = date('Y-m-d H:i:s');
                            $st->execute();
                            // delete a copy from books
                            $newCopy = (int)$copy - 1;
                            $stmt = $conn->prepare("update books set copies=:Copies where id=:id");
                            $stmt->bindParam(":Copies", $newCopy, PDO::PARAM_INT);
                            $stmt->bindParam(":id", $param_id);
                            $param_id = $id;
                            if ($stmt->execute()) {
                                echo '
                                    <div class="fixed-bottom w-100">
                                    <button class="btn btn-primary text-success-50" style="min-width: 100%;" type="button" disabled>
                                 <span class="spinner-border spinner-border" role="status" aria-hidden="true">
                                 </span>
                                 Buy Loading...
                                     </button>   
                                    </div>
                                    <script> 
                                setTimeout(() => { alert("Success! We will send your book as soon as possible!") }, 2000)
                                setTimeout(function(){  location.href = "index.php?page=mybooks";},2000);
                              </script> ';
                            } else {
                                echo "Something went wrong. Please try again later.";
                            }
                            unset($stmt);
                            unset($conn);
                        } else {
                            echo ' <script>
                                        setTimeout(() => { alert("This book is already borrowed") }, 200);
                                        setTimeout(function(){  location.href = "index.php?page=mybooks";},500);
                                   </script> ';
                            unset($stmt);
                            unset($conn);
                        }
                } else {
                    echo ' <script>
                                setTimeout(() => { alert("Sorry, you can not borrow more than 3 books at the same time!") }, 200)
                           </script>';
                    unset($stmt);
                    unset($conn);
                }
            } else {
                echo '
                    <script>
                        setTimeout(() => { alert("An admin can not borrow books") }, 200)
                    </script> ';
            }
        }
        else {
            echo '
            <script>
            setTimeout(function(){  location.href = "php/login.php";},100);
          </script> ';
        }
    }

if (isset($_POST['submit_reserve'])) {
    if (isset($_SESSION['admin']) || isset($_SESSION['klant'])) {
        if (!isset($_SESSION['admin']) && isset($_SESSION['klant'])) {
            $id = $_POST['id'];
            $userId = $_SESSION['loginID'];
            $sql = "INSERT INTO lenen (FKuser , FKbook, resTime) VALUES (:userId, :bookId, :today)";
            $st = $conn->prepare($sql);
            $st->bindParam(":userId", $param_user);
            $st->bindParam(":bookId", $param_book);
            $st->bindParam(":today", $param_date);
            $param_user = $userId;
            $param_book = $id;
            $param_date = date('Y-m-d H:i:s');

            // check if the book is existed in mybooks
            $check = $conn->prepare("SELECT Fkbook FROM lenen where FKuser=:fkuser and Fkbook=:fkbook and start is not null");
            $check->bindParam(":fkuser", $userId);
            $check->bindParam(":fkbook", $id);
            $check->execute();
            $found = $check->fetch();
            if (!$found) {
                if ($st->execute()) {
                    echo '
                      
                                    <div class="fixed-bottom w-100">
                                    <button class="btn btn-secondary text-success-50" style="min-width: 100%;" type="button" disabled>
                                 <span class="spinner-border spinner-border" role="status" aria-hidden="true">
                                 </span>
                                 Reserving...
                                     </button>   
                                    </div>
                                    <script> 
                                setTimeout(() => { alert("Success! Book is reserved.") }, 2000)
                                setTimeout(function(){  location.href = "index.php?page=reservebooks";},2000);
                                
                              </script> ';
                }
            } else {
                echo '
            <script>
            
            setTimeout(() => { alert("This book is already borrowed") }, 200);
            setTimeout(function(){  location.href = "index.php?page=mybooks";},500);
                                     </script> 
       
        ';
            }
        }
        else {
            echo '
            <script>
            setTimeout(() => { alert("An admin can not reserve books") }, 200)
                                     </script> 
        ';

        }
        }
        else {
            echo '
            <script>
            setTimeout(function(){  location.href = "php/login.php";},100);
          </script> ';
        }
    }



?>

</div>
<br>
<br>
