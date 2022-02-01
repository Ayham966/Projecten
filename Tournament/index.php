<?php
session_start();
include("config/connection.php");

if (isset($_GET['page']) ) {
    $page = $_GET['page'];
}
else {
    $page ='home';
}
?>

<?php
include("includes/head.inc.php");
include("includes/nav.inc.php");
?>


<!------ Container ------>
<div class="container-fluid c1">

    <?php
    include 'includes/' . $page . '.inc.php';
    ?>
</div>


<!--- Footer ------>
<?php
include("includes/footer.inc.php")
?>

