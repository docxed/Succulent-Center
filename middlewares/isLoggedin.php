<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['alert_login'] = TRUE;
    header("location: signin.php");
}
?>