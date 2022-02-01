
<div class="loading animated">
    <div class="bg2"></div>
</div>
    <table id="accounts" class="table table-hover table-responsive-lg">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Middle name</th>
            <th scope="col">Last name</th>
            <th scope="col">Birth</th>
            <th scope="col">Email</th>
            <th scope="col">Street</th>
            <th scope="col">House Number</th>
            <th scope="col">City</th>
            <th scope="col">Zip</th>
            <th scope="col">Role</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        include('private/connection.php');
        $stmt = $conn->prepare("SELECT * FROM customers where role='klant'");
        $stmt->execute();
        $users = $stmt->fetchAll();
        foreach($users as $user) {
         ?>
            <tr>
                <th scope="row"><?php echo $user['id']?></th>
                <td><?php echo $user['first']?></td>
                <td><?php echo $user['middel']?></td>
                <td><?php echo $user['last']?></td>
                <td><?php echo $user['birth']?></td>
                <td><?php echo $user['email']?></td>
                <td><?php echo $user['street']?></td>
                <td><?php echo $user['house']?></td>
                <td><?php echo $user['city']?></td>
                <td><?php echo $user['zip']?></td>
                <td><?php echo $user['role']?></td>
                <td><?php echo '<a href="php/klantDelete.php?id='. $user['id'] .'"> <input type="submit" name="submit" value="Delete" class="btn btn-danger" href> </a>'?></td>
                <td><?php echo '<a href="php/klantEdit.php?id='. $user['id'] .'"> <input type="submit" name="submit" value="Edit" class="btn btn-info" href> </a>'?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="input-group col-2">
       <a href="index.php?page=SignUp"><input type="submit" href="index.php?page=SignUp" class="form-control btn-success" value="+ Add a new customer"></a>
    </div>