<?php include_once("./components/head.php"); ?>
<?php
session_start();
require_once("./config/db.php");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $phone = $_POST['phone'];
    $fulladdress = $_POST['fulladdress'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $img = $_FILES['img'];
    $user_id = $_POST['user_id'];

    if (empty($name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อร้าน';
        header("location: settings.php?q=shop");
    } else if (empty($detail)) {
        $_SESSION['error'] = 'กรุณากรอกรายละเอียด';
        header("location: settings.php?q=shop");
    } else if (empty($phone)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์ติดต่อ';
        header("location: settings.php?q=shop");
    } else if (empty($fulladdress) || empty($lat) || empty($lng)) {
        $_SESSION['error'] = 'พิกัดหรือที่อยู่ไม่ถูกต้อง';
        header("location: settings.php?q=shop");
    } else {
        $allow = array('jpg', 'jpeg', 'png');
        $extention = explode(".", $img['name']);
        $fileActExt = strtolower(end($extention));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/shop/" . $fileNew;

        try {
            if (in_array($fileActExt, $allow)) {
                if ($img['size'] > 0 && $img['error'] == 0) {
                    if (move_uploaded_file($img['tmp_name'], $filePath)) {
                        $add = $conn->prepare("INSERT INTO shop(shop_name, shop_phone, shop_detail, shop_address, shop_lat, shop_lng, shop_img, user_id)
                                            VALUES(:name, :phone, :detail, :address, :lat, :lng, :img, :user_id)");
                        $add->bindParam(":name", $name);
                        $add->bindParam(":phone", $phone);
                        $add->bindParam(":detail", $detail);
                        $add->bindParam(":address", $fulladdress);
                        $add->bindParam(":lat", $lat);
                        $add->bindParam(":lng", $lng);
                        $add->bindParam(":img", $fileNew);
                        $add->bindParam(":user_id", $user_id);
                        $add->execute();

                        if ($add) {
                            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'ฝากร้านค้าพันธุ์ไม้สำเร็จ',
                                    icon: 'success',
                                    timer: 5000,
                                    showConfirmButton: false
                                });
                            });
                        </script>";
                            header("refresh:1; url=settings.php?q=shop");
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
                            header("refresh:2; url=settings.php?q=shop");
                        }
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        $edit = $conn->prepare("DELETE FROM shop WHERE shop_id = :id");
        $edit->bindParam(":id", $id);
        $edit->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<?php include_once("./components/footer.php"); ?>