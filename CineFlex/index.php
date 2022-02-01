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
include("includes/header.inc.php");
include("includes/nav.inc.php");
include("php/function.php");
?>


<!------ Container ------>
<div class="containers">

    <?php
    include 'includes/' . $page . '.inc.php';
    ?>
</div>


<!--- Footer ------>
<?php
include("includes/footer.inc.php")
?>

