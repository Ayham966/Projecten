<br>
<div class="container-fluid mybooks w-100">
    <div class="row">
        <div class="col-12">
            <table class="table table-image">
                <thead>
                <tr>
                    <th scope="col">Image:</th>
                    <th scope="col">Name:</th>
                    <th scope="col">Writer:</th>
                    <th scope="col">Genre:</th>
                    <th scope="col">ISBN-number:</th>
                    <th scope="col">Language:</th>
                    <th scope="col">Start:</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include('private/connection.php');
                    $userId = $_SESSION['loginID'];
                    $stmt = $conn->prepare("SELECT
                    *,  DATE_FORMAT(DATE(start), '%D %M %Y') AS clean_date 
                    FROM
                      lenen
                      JOIN customers ON lenen.FKuser = customers.id
                      JOIN books ON lenen.Fkbook = books.id
                    WHERE
                      customers.id =:id and start is not null");
                    $stmt->bindParam(":id", $param_id);
                    $param_id = $userId;
                    $stmt->execute();
                    $lenen = $stmt->fetchAll();
                    foreach($lenen as $row) {
                        echo '
                                 <form method="post">
                                      <tr>
                                        <td class="w-25">
                                            <img src="#" class="img-fluid img-thumbnail" alt="Book">
                                        </td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Writer'].'</td>
                                        <td>'.$row['Genre'].' </td>
                                        <td>'.$row['ISBN'].'</td>
                                        <td>'.$row['Language'].'</td>
                                        <td>'.$row['clean_date'].'</td>
                                        <td><input type="submit" name="back" class="btn btn-danger" value="Back"></td>
                                        <input type="hidden" name="BookId" value="' . $row['Fkbook'] . '"/>
                                        <input type="hidden" name="copies" value="' . $row['Copies'] . '"/>
                                    </tr>
                                   </form>
                        ';
                    }
                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                        if (isset($_POST['back'])) {
                            // Back a copy from to book
                            $bookID = $_POST['BookId'];
                            $copy = $_POST['copies'];
                            $addCopy = (int)$copy + 1;
                            $backBook = $conn->prepare("update books set copies=:Copies where id=:id");
                            $backBook->bindParam(":Copies", $addCopy, PDO::PARAM_INT);
                            $backBook->bindParam(":id", $param_id);
                            $param_id = $bookID;

                            if ($backBook->execute()) {
                                //Remove the book row from table
                                $bookID = $_POST['BookId'];
                                $sql = $conn->prepare("DELETE FROM lenen WHERE Fkbook=:id and start is not null");
                                $sql->bindParam(":id", $bookID);
                                $sql->execute();
                                echo '
                                              
                                                            <div class="fixed-bottom w-100">
                                                            <button class="btn btn-primary text-success-50" style="min-width: 100%;" type="button" disabled>
                                                         <span class="spinner-border spinner-border" role="status" aria-hidden="true">
                                                         </span>
                                                         Back Loading...
                                                             </button>   
                                                            </div>
                                                            <script> 
                                                        setTimeout(() => { alert("Success! Book is back.") }, 2000)
                                                        setTimeout(function(){  location.href = "index.php?page=mybooks";},2000);
                                                        
                                                      </script> ';

                            }
                        }