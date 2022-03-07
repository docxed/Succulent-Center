<?php

session_start();
require_once("./config/db.php");

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: signin.php");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: signin.php");
    } elseif (empty($pass)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signin.php");
    } elseif (strlen($pass) > 20 || strlen($pass) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: signin.php");
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
            $check_data->bindParam(":email", $email);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {

                if ($email == $row['user_email']) {
                    if (password_verify($pass, $row['user_pass'])) {
                        if ($row['user_role'] == 'admin') {
                            $_SESSION['user'] = $row['user_id'];
                            $_SESSION['login_level'] = $row['user_role'];
                            header("location: admin.php?q=manageplants");
                        } else {
                            $_SESSION['user'] = $row['user_id'];
                            $_SESSION['login_level'] = $row['user_role'];
                            header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = "รหัสผ่านผิด";
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = "อีเมลผิด";
                    header("location: signin.php");
                }
            } else {
                $_SESSION['error'] = "ไม่มีข้อมูลนี้ในระบบ";
                header("location: signin.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
