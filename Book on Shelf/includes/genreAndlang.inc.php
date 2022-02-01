<br>
<div class="col-8 mx-auto">
    <div class="row">
    <div class="col-sm-8 shadow-lg p-3 mb-5 bg-white rounded"><!--left col-->
        <table id="genres" class="table table-hover table-responsive-lg">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Genre Name:</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $stmt = $conn->prepare("SELECT * FROM genres");
            $stmt->execute();
            $genres = $stmt->fetchAll();
            foreach($genres as $rows) {
                ?>
                <tr>
                    <input type="hidden" value="<?php echo $rows['id']?>">
                    <td scope="row"><?php echo $rows['name']?></td>
                    <td><?php echo '<a href="php/genDelete.php?id='. $rows['id'] .'"> <input type="submit" name="submit" value="Delete" class="btn btn-danger" href> </a>'?></td>
                    <td><?php echo '<a href="php/genEdit.php?id='. $rows['id'] .'"> <input type="submit" name="submit" value="Edit" class="btn btn-info" href> </a>'?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <hr>
        <div class="input-group col-2">
            <a href="php/addGL.php"><input type="submit" class="form-control btn-success" value="+ Add a new Genre"></a>
        </div>
    </div>

        <div class="col-sm-8 shadow-lg p-3 mb-5 bg-white rounded" ><!--right col-->
            <table id="langs" class="table table-hover table-responsive-lg">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Language Name:</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM languages");
                $stmt->execute();
                $langs = $stmt->fetchAll();
                foreach($langs as $row)
                {
                    ?>
                    <tr>
                        <input type="hidden" value="<?php echo $row['id']?>">
                        <td scope="row"><?php echo $row['name']?></td>
                        <td><?php echo '<a href="php/langDelete.php?id='. $row['id'] .'"> <input type="submit" name="submit" value="Delete" class="btn btn-danger" href> </a>'?></td>
                        <td><?php echo '<a href="php/LangEdit.php?id='. $row['id'] .'"> <input type="submit" name="submit" value="Edit" class="btn btn-info" href> </a>'?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <hr>
            <div class="input-group">
                <a href="php/addGL.php"><input type="submit" class="form-control btn-success" value="+ Add a new language"></a>
            </div>
        </div>
    </div>
</div>