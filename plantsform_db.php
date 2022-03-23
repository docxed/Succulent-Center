<?php include_once("./components/head.php"); ?>
<?php
session_start();
require_once("./config/db.php");

if (isset($_POST['add'])) {
    $plantsfamily_name = $_POST['plantsfamily_name'];
    $plantsgroup_name = $_POST['plantsgroup_name'];
    $name = $_POST['name'];
    $namemarket = $_POST['namemarket'];
    $detail = $_POST['detail'];
    $fulladdress = $_POST['fulladdress'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $img = $_FILES['img'];
    $user_id = $_POST['user_id'];

    if (empty($plantsfamily_name)) {
        $_SESSION['error'] = 'กรุณาเลือกวงศ์';
        header("location: form.php");
    } else if (empty($plantsgroup_name)) {
        $_SESSION['error'] = 'กรุณาเลือกสกุล';
        header("location: form.php");
    } else if (empty($name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อพันธุ์ไม้';
        header("location: form.php");
    } else if (empty($namemarket)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อพันธุ์ไม้ทางการตลาด (ไม่มีใส่ -)';
        header("location: form.php");
    } else if (empty($detail)) {
        $_SESSION['error'] = 'กรุณากรอกรายละเอียด';
        header("location: form.php");
    } else if (empty($fulladdress) || empty($lat) || empty($lng)) {
        $_SESSION['error'] = 'พิกัดหรือที่อยู่ไม่ถูกต้อง';
        header("location: form.php");
    } else {
        $allow = array('jpg', 'jpeg', 'png');
        $extention = explode(".", $img['name']);
        $fileActExt = strtolower(end($extention));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/plantsform/" . $fileNew;

        try {
            if (in_array($fileActExt, $allow)) {
                if ($img['size'] > 0 && $img['error'] == 0) {
                    if (move_uploaded_file($img['tmp_name'], $filePath)) {
                        $add = $conn->prepare("INSERT INTO plantsform(plantsfamily_name, plantsgroup_name, plantsform_name, plantsform_namemarket, plantsform_detail, plantsform_address, plantsform_lat, plantsform_lng, plantsform_img, user_id)
                                            VALUES(:plantsfamily_name, :plantsgroup_name, :plantsform_name, :plantsform_namemarket, :plantsform_detail, :plantsform_address, :plantsform_lat, :plantsform_lng, :plantsform_img, :user_id)");
                        $add->bindParam(":plantsfamily_name", $plantsfamily_name);
                        $add->bindParam(":plantsgroup_name", $plantsgroup_name);
                        $add->bindParam(":plantsform_name", $name);
                        $add->bindParam(":plantsform_namemarket", $namemarket);
                        $add->bindParam(":plantsform_detail", $detail);
                        $add->bindParam(":plantsform_address", $fulladdress);
                        $add->bindParam(":plantsform_lat", $lat);
                        $add->bindParam(":plantsform_lng", $lng);
                        $add->bindParam(":plantsform_img", $fileNew);
                        $add->bindParam(":user_id", $user_id);
                        $add->execute();

                        if ($add) {
                            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'จดทะเบียนพันธุ์ไม้สำเร็จ',
                                    icon: 'success',
                                    timer: 5000,
                                    showConfirmButton: false
                                });
                            });
                        </script>";
                            header("refresh:1; url=plantsformview.php");
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
                            header("refresh:2; url=settings.php?q=form");
                        }
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];

    try {
        $edit = $conn->prepare("UPDATE plantsform SET plantsform_status=:state WHERE plantsform_id = :id");
        $edit->bindParam(":state", $status);
        $edit->bindParam(":id", $id);
        $edit->execute();

        if ($edit) {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'อัปเดตสถานะสำเร็จ',
                    icon: 'success',
                    timer: 5000,
                    showConfirmButton: false
                });
            });
        </script>";
            header("refresh:1; url=admin.php?q=manageplantsform");
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
            header("refresh:2; url=admin.php?q=manageplantsform");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<?php include_once("./components/footer.php"); ?>