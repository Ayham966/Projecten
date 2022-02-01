<?php
session_start();
include("private/connection.php");

 if (isset($_GET['page']) ) {
     $page = $_GET['page'];
 }
 else {
     $page ='home';
 }
?>

<?php
include("includes/header.inc.php");
include("includes/nav.inc.php");
?>


<!------ Container ------>
<div class="container-fluid c1">

    <?php
      include 'includes/' . $page . '.inc.php';
    ?>
</div>

<!-- Modal Sign up Form-->
<?php
if (isset($_GET['SignUp']) ) {
    include("includes/SignUp.inc.php");
    $page = $_GET['SignUp'];
}
else {
    $page ='home';
}
?>
<!-- Modal Sign in Form -->
<?php
include("includes/login.inc.php")
?>
<!--- Footer ------>
<?php
include("includes/footer.inc.php")
?>

