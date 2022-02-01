<?php
if ( $_SESSION['admin'] != true ){
    header("location: index.php");
    exit();
}
$err_msg = $err_pass = "";
if (isset($_POST['submit'])) {
    if (!empty($_POST['first'])  && !empty($_POST['last']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_conf'])) {
        $password = $_POST['password'];

        if( strlen($password) < 8 ) {
            $err_pass .= "Password too short!";
        }
        if( strlen($password) > 20 ) {
            $err_pass .= "Wachtwoord te kort!";
        }
        if( !preg_match("#[0-9]+#", $password) ) {
            $err_pass .= "moet ten minste één nummer bevatten!";
        }
        if( !preg_match("#[a-z]+#", $password) ) {
            $err_pass .= "moet ten minste één letter bevatten!";
        }
        if( !preg_match("#[A-Z]+#", $password) ) {
            $err_pass .= "moet ten minste één hoofdletter bevatten!";
        }
        if( !preg_match("#\W+#", $password) ) {
            $err_pass .= "moet ten minste één symbool bevatten!";
        }
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

                    $login_info = $conn->prepare('INSERT INTO users (role, email, password) VALUES (?,?,?);');
                    if ($login_info->execute(["user", $email, $hash])) {
                        $first = trim($_POST["first"]);
                        $middle = trim($_POST["middle"]);
                        $last = trim($_POST["last"]);

                        // get id van nieuwe user
                        $sql = "SELECT * FROM users where email=:email";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(":email", $email);
                        $stmt->execute();
                        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
                        $userid = $row2['id'];

                    $sql_details = $conn->prepare('INSERT INTO user_details (first, middle, last, fkuser) VALUES (?,?,?,?);');
                    if ($sql_details->execute([$first, $middle, $last, $userid])) {
                        echo '
                              <div class="alert alert-warning" role="alert">
                              Nieuw scheidsrechter is toegevoegd
                            </div>
                              '
                        ;

                        }
                    }
                }
                else {
                    $err_msg = "Deze email <span style='color: black' class='h5'> $email </span> is gebuikt, probeer andere email!";
                }
            }
            else {
                $err_msg = "wachtwoord komt niet overeen!";
            }
        }

    }
    else {
        $err_msg = "Gelieve alle informatie in te vullen!";
    }
}



?>
<div class="container-fluid register-form">
    <div class="row">
        <div class="col-sm photo"></div>
        <div class="d-flex col-sm register-fields">
            <form action="" method="post" class="all-form">
                <h5>Naam:</h5>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" pattern="[A-Za-z]*" title="Voornaam" placeholder="Voornaam *" name="first" value="" />
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" pattern="[A-Za-z]*" title="Tussennaam" placeholder="Tussennaam (optional)" name="middle" value="" />
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" pattern="[A-Za-z]*" title="Achternaam" placeholder="Achternaam *" name="last" value="" />
                    </div>
                </div>
                <br><br>

                <h5>Login informatie:</h5>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email *" name="email" value="" />
                </div>
                <div class="form-group">

                    <input type="password" id="psw_input" class="form-control" placeholder="Wachtwoord *" name="password" value="" />
                    <span style="color: red; font-size: 10pt;"><?php echo $err_pass; ?></span>
                </div>
                <div class="form-group">
                    <input type="password" id="psw_input2" class="form-control"  placeholder="Herhaal Wachtwoord *" name="password_conf" value="" />
                    <div class="d-flex flex-row-reverse p-2">
                        <i onclick="myFunction()" class="far fa-eye fa-lg" id="togglePassword"> Show</i>
                    </div>
                </div>
                <input type="submit" class="btnRegister btn-danger text-decoration-underline" name="submit"  value="Register"/>
                <br><br>
                <span style="color: red; font-size: 14pt;"><?php echo $err_msg; ?></span>
            </form>
        </div>
    </div>
</div>
</br> </br> </br> </br>
<div class="container">
    <div class="row">
        <div class="col-12 p-1 shadow-lg p-3 mb-5 bg-white rounded">
            <div data-spy="scroll" data-target="#list-item-1" data-offset="0" class="scrollspy-teams">
                <h4 id="list-item-1" class="text-center">Scheidsrechter: </h4>
            </div>
                <?php
                // check if there are users or not
                $check = $conn->prepare("SELECT * FROM users where role='user'");
                $check->execute();
                if ($check->rowCount() > 0) {
                    ?>
                <table class="table table-image border table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Volledig Naam</th>
                        <th scope="col">Email</th>
                        <th scope="col">Verwijderen</th>
                        <th scope="col">Bewerken</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM users inner JOIN user_details ON users.id = user_details.fkuser where role='user';");
                    $stmt->execute();
                    $teams = $stmt->fetchAll();
                    foreach($teams as $row)
                    {
                        $fullname = $row['first'] . " ".  $row['middle'] . " ". $row['last'];
                        ?>
                        <tr>
                            <td class="w-25 h-auto"><?php echo $fullname?></td>
                            <td scope="row"><?php echo $row['email']?></td>
                            <td><?php echo '<a href="php/deleteUser.php?id='. $row['fkuser'] .'"> <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-trash"></i> </button> </a>'?></td>
                            <td><?php echo '<a href="php/editUser.php?id='. $row['id'] .'"> <button type="submit" name="submit" class="btn btn-info"><i class="fas fa-edit"></i></button> </a>'?></td>
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
                         echo '<br> <p class="font-italic text-center text-danger"> Geen Scheidsrechter gevonden!.</p>';
                     }