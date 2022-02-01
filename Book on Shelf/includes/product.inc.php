
<div class="row c3">
    <div class="col-11 c3-left rounded">
        <div class="row">
            <div class="col-12">
                <table class="table table-image">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Writer</th>
                        <th scope="col">Genre</th>
                        <th scope="col">ISBN-Number</th>
                        <th scope="col">Language</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Copies</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM books";
                    if($result = $conn->query($sql)){
                        if($result->rowCount() > 0){
                            while($row = $result->fetch()){
                                $bookID = $row['id'];
                                $name = $row['Name'];
                                $writer = $row['Writer'];
                                $genre = $row['Genre'];
                                $ISBN = $row['ISBN'];
                                $lang = $row['Language'];
                                $pages = $row['Pages'];
                                $copy = $row['Copies'];
                                $price = $row['Price'];
                                echo "<tr>";
                                ?>
                    <td class="w-25">
                    </td>
                    <?php
                                echo "<td>" . $name . "</td>";
                                echo "<td>" . $writer . "</td>";
                                echo "<td>" . $genre . "</td>";
                                echo "<td>" . $ISBN . "</td>";
                                echo "<td>" . $lang . "</td>";
                                echo "<td>" . $pages . "</td>";
                                echo "<td>" . $copy . "</td>";
                                echo "<td>" . $price . "</td>";
                                echo "<td>";
                                echo ' <a href="php/deleteProduct.php?id='. $bookID .'"> <input type="submit" name="submit" value="Delete" class="btn btn-danger" href> </a>';
                                echo ' <a href="php/editProduct.php?id='. $bookID .'"> <input type="submit" name="submit" value="Edit" class="btn btn-info" href> </a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR";
                    }
                    unset($conn);
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <div class="col-1">
            <a href="php/addProduct.php">
                <div class="input-group">
                    <input type="button" href="php/addProduct.php" class="form-control btn-success" value="+ add">
                </div>
            </a>
        </div>
</div>

