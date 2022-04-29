<?php include_once("./components/head.php"); ?>
<?php

session_start();
require_once("./config/db.php");

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $idcard = $_POST['idcard'];
    $pass = $_POST['password'];
    $c_pass = $_POST['c_password'];

    if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: signup.php");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: signup.php");
    } elseif (empty($fname)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: signup.php");
    } elseif (empty($lname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
        header("location: signup.php");
    } elseif (empty($idcard)) {
        $_SESSION['error'] = 'กรุณากรอกเลขบัตรประชาชน';
        header("location: signup.php");
    } elseif (empty($pass)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signup.php");
    } elseif (strlen($pass) > 20 || strlen($pass) < 5) {
        $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: signup.php");
    } elseif (empty($c_pass)) {
        $_SESSION['error'] = 'กรุณากรอกยืนยันรหัสผ่าน';
        header("location: signup.php");
    } elseif ($pass != $c_pass) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: signup.php");
    } else {
        try {
            $check_email = $conn->prepare("SELECT user_email FROM users WHERE user_email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row_email = $check_email->fetch(PDO::FETCH_ASSOC);

            $check_idcard = $conn->prepare("SELECT user_idcard FROM users WHERE user_idcard = :idcard");
            $check_idcard->bindParam(":idcard", $idcard);
            $check_idcard->execute();
            $row_idcard = $check_idcard->fetch(PDO::FETCH_ASSOC);

            if (isset($row_email['user_email']) && $row_email['user_email'] == $email) {
                $_SESSION['warning'] = 'อีเมลนี้เคยถูกใช้งานแล้ว';
                header("location: signup.php");
            } elseif (isset($row_idcard['user_idcard']) && $row_idcard['user_idcard'] == $idcard) {
                $_SESSION['warning'] = 'เลขบัตรประชาชนนี้เคยถูกใช้งานแล้ว';
                header("location: signup.php");
            } elseif (!isset($_SESSION['error'])) {
                $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users(user_fname, user_lname, user_idcard, user_email, user_pass) 
                                        VALUES(:fname, :lname, :idcard, :email, :pass)");
                $stmt->bindParam(":fname", $fname);
                $stmt->bindParam(":lname", $lname);
                $stmt->bindParam(":idcard", $idcard);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pass", $passwordHash);
                $stmt->execute();
                // $_SESSION['success'] = "สมัครสมาชิกสำเร็จ";
                // header("location: signup.php");
                if ($stmt) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'สมัครสมาชิกสำเร็จ',
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
                    header("refresh:2; url=signin.php");
                }
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด โปรดลองอีกครั้งในภายหลัง";
                header("location: signup.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
<?php include_once("./components/footer.php"); ?>