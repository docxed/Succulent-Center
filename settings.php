<?php session_start(); ?>
<?php include_once("./middlewares/isLoggedin.php") ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div>
    <br><br>
    <div class="container">
        <?php
        if (isset($_GET['q'])) {
            if ($_GET['q'] == 'profile') {
                include_once("./components/profile.php");
            } else if ($_GET['q'] == 'changepassword') {
                include_once("./components/changepassword.php");
            } else if ($_GET['q'] == 'form') {
                include_once("./components/form.php");
            } else if ($_GET['q'] == 'shop') {
                include_once("./components/shop.php");
            }
        }
        ?>
    </div>
</div>
<?php include_once("./components/footer.php"); ?>