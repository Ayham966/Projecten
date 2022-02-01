<?php
if (isset($_GET['outloggin'])) {
    outloggin();
}
function outloggin() {
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    header("location: index.php?page=home");
    session_unset();
    session_destroy();
}
?>

<nav>
    <div class="d-flex justify-content-around flex-row">
        <div class="p-3">Logo</div>
        <div class="p-3"></div>
        <div class="p-3"></div>
        <div class="p-3"></div>
        <div class="p-3">
            <ul class="nav justify-content-reserve">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=home">Startpagina</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=tournament">Toernooi</a>
                </li>
                <?php
                if  (isset($_SESSION['admin'])) {
                    echo '
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?page=scheidsrechters">Scheidsrechters</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="index.php?page=teams">Teams</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="index.php?page=stadions">Stadions</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="index.php?page=spelers">Spelers</a>
                    </li>
                    ';
                }

                if  (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
                    echo '
                    <a href="index.php?outloggin=true"> <button class="btn btn-warning btn-md" type="button">Uitloggen</button> </a>
                    ';
                }
                else {
                    echo '
                 <a href="php/login.php"> <button class="btn btn-primary btn-md" type="button">Inloggen</button> </a>
                ';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>