<br>
<div class="container-fluid mybooks w-75">
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
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                            $userId = $_SESSION['loginID'];
                            // welke klant is dat?
                            $stmt = $conn->prepare("SELECT
                                    *
                                    FROM
                                      lenen
                                      JOIN customers ON lenen.FKuser = customers.id
                                      JOIN books ON lenen.Fkbook = books.id
                                    WHERE
                                    customers.id =:id and start is null");
                            $stmt->bindParam(":id", $param_id);
                            $param_id = $userId;
                            $stmt->execute();
                            $reserve = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach($reserve as $rows) {
                                    $bookIDD = $rows['Fkbook'];
                                    $noBook = $rows['Copies'];
                                    echo '                                
                                     <form method="post">
                                      <tr>
                                        <td class="w-25">
                                            <img src="#" class="img-fluid img-thumbnail" alt="Book">
                                        </td>
                                        <td>' . $rows['Name'] . '</td>
                                        <td>' . $rows['Writer'] . '</td>
                                        <td>' . $rows['Genre'] . ' </td>
                                        <td>' . $rows['ISBN'] . '</td>
                                        <td>' . $rows['Language'] . '</td>
                                        <input type="hidden" name="BookId" value="' . $bookIDD . '"/>
                                        <input type="hidden" name="copies" value="' . $noBook . '"/>
                                        ';
                                    $_SESSION['thisBook'] = $bookIDD;
                                    $_SESSION['thisCopy'] = $noBook;

                                   // $check = $conn->prepare("SELECT resTime FROM lenen WHERE resTime >= CURDATE() and Fkbook=:bookid ");
                                    $check = $conn->prepare("SELECT resTime FROM lenen WHERE Fkbook=:bookid ORDER BY resTime ASC LIMIT 1");
                                    $check->bindParam(":bookid", $bookIDD);
                                    $check->execute();
                                    $result = $check->fetch();
                                    $first =  $result['resTime'];

                                    if ($noBook == 0 ) {
                                        echo'
                                    <td><input type="submit" name="reserve" class="btn btn-info" value="Reserved" disabled></td>
                                    </tr>
                                   </form>';
                                    }
                                    else {
                                        // check if he/she the first one
                                        $check2 = $conn->prepare("SELECT resTime FROM lenen WHERE FKuser=:userid and FKbook =:bookid");
                                        $check2->bindParam(":userid", $userId);
                                        $check2->bindParam(":bookid", $bookIDD);
                                        $check2->execute();
                                        $results = $check2->fetch();
                                        $ifFirst =  $results['resTime'];
                                        if ( $first == $ifFirst) {
                                        echo '
                                          <td><button type="button" name="available" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Available</button></td>
                                          </tr>
                                   </form>';
                                        }
                                        else {
                                            echo'
                                    <td><input type="submit" name="reserve" class="btn btn-info" value="Reserved" disabled></td>
                                    </tr>
                                   </form>';

                                        }
                                    }
                                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                We send your book to your address as soon as possible!
            </div>
            <div class="modal-footer">
                <form action="php/addTolenen.php" method="post">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="yes" class="btn btn-primary">Receive it</button>
                </form>
            </div>
        </div>
    </div>
</div>