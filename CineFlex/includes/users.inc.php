<?php
isAdmin();

$err_msg = $err_pass = "";
if ( isset($_POST['addUser'])) {
       if (!empty($_POST['email']) && !empty($_POST['password']) &&
        !empty($_POST['password_conf']) && !empty($_POST['first']) && !empty($_POST['role'])
         && !empty($_POST['last']) && !empty($_POST['house']) && !empty($_POST['street']) ) {
           $password = $_POST['password'];
            if( strlen($password) < 7 ) {
                $err_pass .= "Wachtwoord te kort!";
            }
            if( strlen($password) > 20 ) {
                $err_pass .= "Wachtwoord te lang!";
            }

            $input_house = $_POST['house'];
            if( !ctype_digit($input_house)) {
                $err_pass = "huisnummer moet cijfers zijn";
            }
            else{
                $house = $input_house;
            }

//        if( !preg_match("#[0-9]+#", $password) ) {
//            $err_pass .= "moet ten minste één nummer bevatten!";
//        }
//        if( !preg_match("#[a-z]+#", $password) ) {
//            $err_pass .= "moet ten minste één letter bevatten!";
//        }
//        if( !preg_match("#[A-Z]+#", $password) ) {
//            $err_pass .= "moet ten minste één hoofdletter bevatten!";
//        }
//        if( !preg_match("#\W+#", $password) ) {
//            $err_pass .= "moet ten minste één symbool bevatten!";
//        }
           if(!$err_pass){
               if ($_POST['password'] === $_POST['password_conf']) {
                   // check eerst als email is gebruikt
                $email = trim($_POST["email"]);
                $check_email = "SELECT * FROM users where email=:email";
                $stmt = $conn->prepare($check_email);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() == 0) {
                    // wachwoord hash maken
                    $password = trim($_POST["password"]);
                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    $role = trim($_POST["role"]);
                     $login_info = $conn->prepare('INSERT INTO users (fkrole, email, password) VALUES (?,?,?);');
                    if ($login_info->execute([$role, $email, $hash])) {
                        $first = trim($_POST["first"]);
                        $middle = trim($_POST["middle"]);
                        $last = trim($_POST["last"]);
                        $street = trim($_POST["street"]);
                        $id = $conn->lastInsertId();
                        $sql_details = $conn->prepare('INSERT INTO user_details (first, middle, last, house, street, fkuser) VALUES (?,?,?,?,?,?);');
                        if ($sql_details->execute([$first, $middle, $last, $house, $street, $id])) {
                          }
                    }
                }
                    else {
                        $err_msg = "Deze email <span style='color: black'> $email </span> is gebuikt, probeer andere email!";
                        echo "<script>
                        $(document).ready(function(){
                        $('#addModal').modal('show');
                        })
                </script>";
                    }
               }
               else {
                $err_msg = 'wachtwoord is niet gelijk!!';
                 echo "<script>
                        $(document).ready(function(){
                        $('#addModal').modal('show');
                        })
                        </script>";
                }
           }
           else {
                echo "<script>
                        $(document).ready(function(){
                        $('#addModal').modal('show');
                        })
                </script>";
           }
       }
       else {
           $err_msg = 'Please fill all informations!';
           echo "<script>
                        $(document).ready(function(){
                        $('#addModal').modal('show');
                        })
                </script>";
           }
}
?>

<div class="layout-margin-8 mt-5">
    <div class="d-flex flex-row">
        <div class="p-2"><h2 class="text-white"> > Gebruikers</h2></div>
    </div>
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <button class="btn bg-success text-white" data-toggle="modal" data-target="#addModal">Toevoegen +</button>
        </div>
    </div>

    <ul class="list-group text-center">
        <div class="row table-responsive">
             <?php
                // check if there are users or not
                $check = $conn->prepare("SELECT * FROM users");
                $check->execute();
                if ($check->rowCount() > 0) {
                    ?>
                <table class="table table-image border table-hover table-bordered bg-light">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Volledig Naam</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Verwijderen</th>
                        <th scope="col">Bewerken</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT 
                    users.id, users.fkrole, users.email, user_details.fkuser, user_details.first, 
                    user_details.middle, user_details.last, user_role.name FROM users 
                    inner JOIN user_details ON users.id = user_details.fkuser
                    inner JOIN user_role ON users.fkrole = user_role.id 
                    ");
                    $stmt->execute();
                    $users = $stmt->fetchAll();
                    foreach($users as $row)
                    {
                        $fullname = $row['first'] . " ".  $row['middle'] . " ". $row['last'];
                        ?>
                        <tr>
                            <td class="w-25 h-auto"><?php echo $fullname?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo '<a href="php/confirm.php?userid='. $row['fkuser'] .'"> <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-trash"></i> </button> </a>'?></td>
                            <td><?php echo '<a href="php/editUser.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-edit"></i></button> </a>'?></td>
                        </tr>
                    <?php  } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
                    <?php
                     }
                     else {
                         echo '<br> <p class="font-italic text-center text-danger"> Geen Gebruikers gevonden!.</p>';
                     }?>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w-100 text-center" id="modalLabel">Gerbuiker toevoegen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body w-75 mx-auto">
        <form action="" method="post">
               <br>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email *" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Wachtwoord *" name="password">
                </div>
                <div class="form-group">
                    <input type="password" id="psw_input2" class="form-control"  placeholder="Herhaal Wachtwoord *" name="password_conf">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="text" class="form-control" placeholder="Voornaam *" name="first">
                    <input type="text" class="form-control" placeholder="tussennaam *" name="middle">
                    <input type="text" class="form-control" placeholder="achternaam *" name="last">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="text"  class="form-control"  placeholder="Straatnaam *" name="street">
                    <input type="text" class="form-control"  placeholder="Huisnummer *" name="house">
                </div>
<!--                <input type="submit" class="btnRegister btn-danger text-decoration-underline" name="submit"  value="Register"/>-->
<!--                <br><br>-->
                 <label for="role">Gerbuiker role:</label>
                    <select class="form-control" name="role">';
                        <option value="" selected disabled> Selecteer een role</option>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM user_role");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $rows) {
                            $roleName = $rows['name'];
                            $roleId = $rows['id'];
                            echo '<option value="' . $roleId . '">'.$roleName .'</option>';
                        }
                        ?>
                    </select>
                    <br>
                  <span style="color: red; font-size: 14pt;"><?php echo $err_msg; ?></span>
                   <span style="color: red; font-size: 14pt;"><?php echo $err_pass; ?></span>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                    <button type="submit" class="btn btn-danger" name="addUser">Toevoegen</button>
                  </div>
         </form>
       </div>
    </div>
  </div>
</div>