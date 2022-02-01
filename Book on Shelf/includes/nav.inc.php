<?php
$navItem = array(
        array('books' , 'Books'),
);
$dropItem = array(
    array('profile' , 'Profile'),
    array('myBooks' , 'My Books'),
    array('reserveBooks' , 'Reserved Books'),
);
$AdminItem = array(
    array('accounts' , 'Users'),
    array('product' , 'Products'),
    array('Dashboard' , 'Dashboard'),
    array('genreAndlang' , 'Genre and Lang'),
);
if (isset($_GET['outloggin'])) {
    outlogin();

}
function outlogin() {
    unset($_SESSION['klant']);
    unset($_SESSION['admin']);
    echo '<script> 
             setTimeout(() => { alert("Sign out Done!") }, 800)
            setTimeout(function(){  location.href = "index.php?page=home";},1200);
                             </script> ';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark cos">
    <a class="navbar-brand" href="index.php?page=home"><img class="custom_image" src="http://localhost/website/images/logo.png" height="50" alt="logo"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php?page=home">Home <span class="sr-only">(current)</span></a>
            <?php foreach ($navItem as $navItem) {
                echo ' 
                 <li class="nav-item">
                          <a class="nav-link" href="index.php?page=' . $navItem[0] . '">' . $navItem[1] . '</a> 
                          </li>';
            }
            ?>
            </li>

            <?php

            if  (isset($_SESSION['klant'])) {

                echo '  <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Account
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                foreach ($dropItem as $dropItem) {
                    echo '
              <a class="dropdown-item" href="index.php?page=' . $dropItem[0] . '">' . $dropItem[1] . '</a>
              <div class="dropdown-divider"></div>
              ';
                }
            }
            ?>

            <?php
            if  (isset($_SESSION['admin'])) {
                echo '  <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Edit admin
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                foreach ($AdminItem as $AdminItem) {
                    echo '
              <a class="dropdown-item" href="index.php?page=' . $AdminItem[0] . '">' . $AdminItem[1] . '</a>
              <div class="dropdown-divider"></div>
              ';
                }
            }
            ?>
                </div>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav">
            <li  class="nav-item">
                <?php
                if  (isset($_SESSION['klant']) || isset($_SESSION['admin'])) {
                    echo '
                    <a  class="fa fa-sign-in nav-link trigger-btn" href="index.php?outloggin=true"> Sign out  </a>
                    ';
                }
                    else {
                        echo '
               
                <a  class="fa fa-sign-in nav-link trigger-btn" href="#myModal" data-toggle="modal"> Sign in  </a>
                ';
                }
                ?>
            </li>
        </ul>
    </div>


</nav>



