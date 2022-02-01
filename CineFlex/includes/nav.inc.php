<?php
if (isset($_GET['outloggin'])) {
    outloggin();
}
function outloggin() {
    unset($_SESSION['customer']);
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    header("location: index.php?page=home");
    session_unset();
    session_destroy();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php?page=home">Cine<b>F</b>lex</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mx-auto justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=home">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=movies">Browse</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=agenda">Agenda</a>
            </li>
            <?php
            if (isset($_SESSION['admin'])) {
                echo '
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Beheren
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="index.php?page=moviesAdmin">Films</a>
                          <a class="dropdown-item" href="index.php?page=genres">Genres</a>
                           <a class="dropdown-item" href="index.php?page=rooms">Zalen</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="index.php?page=users">Gebruikers</a>
                        </div>
                      </li>
                    ';
            } ?>
        </ul>
        <span class="navbar-text text-danger">
            <?php
            if  (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
                echo '
                      <a href="index.php?outloggin=true"><button type="button" class="btn btn-mute">Uitloggen</button></a>
                    ';
            }
            else {
                echo '
                 <a href="index.php?page=login"><button type="button" class="btn btn-danger">Inloggen</button></a>
                ';
            }
            ?>

        </span>
    </div>
</nav>


