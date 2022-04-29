<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['login_level']);
    header("location: signin.php");
