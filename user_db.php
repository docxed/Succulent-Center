<?php include_once("./components/head.php"); ?>
<?php
session_start();
require_once("./config/db.php");

if (isset($_POST['edit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $id = $_POST['id'];

    try {
        $edit = $conn->prepare("UPDATE users SET user_fname=:fname, user_lname=:lname WHERE user_id = :id");
        $edit->bindParam(":fname", $fname);
        $edit->bindParam(":lname", $lname);
        $edit->bindParam(":id", $id);
        $edit->execute();

        if ($edit) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: 'อัปเดตข้อมูลสำเร็จ',
                            icon: 'success',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
            header("refresh:2; url=settings.php?q=profile");
        } else {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'มีบางอย่างผิดพลาด โปรดลองอีกครั้งในภายหลัง',
                            icon: 'error',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
            header("refresh:2; url=settings.php?q=profile");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['changepassword'])) {
    $o_password = $_POST['o_password'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $id = $_POST['id'];

    if (empty($o_password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่านเดิม';
        header("location: settings.php?q=changepassword");
    } elseif (strlen($o_password) > 20 || strlen($o_password) < 5) {
        $_SESSION['error'] = 'รหัสผ่านเดิมต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: settings.php?q=changepassword");
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่านใหม่';
        header("location: settings.php?q=changepassword");
    } elseif (strlen($password) > 20 || strlen($password) < 5) {
        $_SESSION['error'] = 'รหัสผ่านใหม่ต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
        header("location: settings.php?q=changepassword");
    } else if (empty($c_password)) {
        $_SESSION['error'] = 'กรุณากรอกยืนยันรหัสผ่านใหม่';
        header("location: settings.php?q=changepassword");
    } else if ($password != $c_password) {
        $_SESSION['error'] = 'รหัสผ่านใหม่ไม่ตรงกัน';
        header("location: settings.php?q=changepassword");
    } else {
        try {
            $passwordDB = $conn->prepare("SELECT user_pass FROM users WHERE user_id = :id");
            $passwordDB->bindParam(":id", $id);
            $passwordDB->execute();
            $row_passwordDB = $passwordDB->fetch(PDO::FETCH_ASSOC);
            if (password_verify($o_password, $row_passwordDB['user_pass'])) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $edit = $conn->prepare("UPDATE users SET user_pass=:password WHERE user_id = :id");
                $edit->bindParam(":password", $passwordHash);
                $edit->bindParam(":id", $id);
                $edit->execute();
                if ($edit) {
                    echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'เปลี่ยนรหัสผ่านแล้ว',
                                    icon: 'success',
                                    timer: 5000,
                                    showConfirmButton: false
                                });
                            });
                        </script>";
                    header("refresh:2; url=logout.php");
                } else {
                    echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'ไม่สำเร็จ',
                                    text: 'มีบางอย่างผิดพลาด โปรดลองอีกครั้งในภายหลัง',
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: false
                                });
                            });
                        </script>";
                    header("refresh:2; url=settings.php?q=changepassword");
                }
            } else {
                echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'รหัสผ่านเดิมไม่ถูกต้อง',
                            icon: 'error',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
                header("refresh:2; url=settings.php?q=changepassword");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else if (isset($_POST['edit_user'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $idcard = $_POST['idcard'];
    $role = $_POST['role'];
    $self_id = $_POST['self_id'];
    $id = $_POST['id'];

    if ($self_id == $id) {
        $_SESSION['warning'] = 'ไม่สามารถแก้ไขตัวคุณได้';
        header("location: admin.php?q=manageusers&id=$id");
    } else {
        try {
            $edit = $conn->prepare("UPDATE users SET user_fname=:fname, user_lname=:lname, user_idcard=:idcard, user_role=:role
             WHERE user_id = :id");
            $edit->bindParam(":fname", $fname);
            $edit->bindParam(":lname", $lname);
            $edit->bindParam(":idcard", $idcard);
            $edit->bindParam(":role", $role);
            $edit->bindParam(":id", $id);
            $edit->execute();

            if ($edit) {
                echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'อัปเดตข้อมูลสำเร็จ',
                                icon: 'success',
                                timer: 5000,
                                showConfirmButton: false
                            });
                        });
                    </script>";
                header("refresh:2; url=admin.php?q=manageusers");
            } else {
                echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'ไม่สำเร็จ',
                                text: 'มีบางอย่างผิดพลาด โปรดลองอีกครั้งในภายหลัง',
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: false
                            });
                        });
                    </script>";
                header("refresh:2; url=admin.php?q=manageusers");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        $edit = $conn->prepare("DELETE FROM users WHERE user_id = :id");
        $edit->bindParam(":id", $id);
        $edit->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<?php include_once("./components/footer.php"); ?>