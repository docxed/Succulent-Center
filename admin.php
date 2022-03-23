<?php session_start(); ?>
<?php include_once("./middlewares/isLoggedin.php") ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div>
    <br><br>
    <div class="container">
        <h2><i class="fa-solid fa-user-shield"></i> Admin Panel</h2>
        <hr>
        <br>
        <div class="col-12">
            <?php include_once("./components/admin-panel.php"); ?>
            <?php
            if (isset($_GET['q'])) {
                if ($_GET['q'] == 'manageusers') {
                    include_once("./components/admins/manageusers.php");
                } else if ($_GET['q'] == 'manageplantsfamily') {
                    include_once("./components/admins/manageplantsfamily.php");
                } else if ($_GET['q'] == 'manageplantsgroup') {
                    include_once("./components/admins/manageplantsgroup.php");
                } else if ($_GET['q'] == 'manageplants') {
                    include_once("./components/admins/manageplants.php");
                } else if ($_GET['q'] == 'manageplantsform') {
                    include_once("./components/admins/manageplantsform.php");
                }
            }
            ?>
        </div>

    </div>
</div>
<?php include_once("./components/footer.php"); ?>