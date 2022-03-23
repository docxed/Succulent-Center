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
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extention = explode(".", $img['name']);
    $fileActExt = strtolower(end($extention));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "uploads/plants/" . $fileNew;

    try {
        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {
                    $add = $conn->prepare("INSERT INTO plants(plants_name, plants_namemarket, plants_detail, plants_img, plantsfamily_name, plantsgroup_name)
                                        VALUES(:name, :namemarket, :detail, :img, :plantsfamily_name, :plantsgroup_name)");
                    $add->bindParam(":name", $name);
                    $add->bindParam(":namemarket", $namemarket);
                    $add->bindParam(":detail", $detail);
                    $add->bindParam(":img", $fileNew);
                    $add->bindParam(":plantsfamily_name", $plantsfamily_name);
                    $add->bindParam(":plantsgroup_name", $plantsgroup_name);
                    $add->execute();

                    if ($add) {
                        echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'เพิ่มพันธุ์ไม้สำเร็จ',
                                icon: 'success',
                                timer: 5000,
                                showConfirmButton: false
                            });
                        });
                    </script>";
                        header("refresh:1; url=admin.php?q=manageplants");
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
                        header("refresh:2; url=admin.php?q=manageplants");
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['edit'])) {
    $plantsfamily_name = $_POST['plantsfamily_name'];
    $plantsgroup_name = $_POST['plantsgroup_name'];
    $name = $_POST['name'];
    $namemarket = $_POST['namemarket'];
    $detail = $_POST['detail'];
    $img = $_FILES['img'];
    $id = $_POST['id'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];

    if ($upload != '') {
        $allow = array('jpg', 'jpeg', 'png');
        $extention = explode(".", $img['name']);
        $fileActExt = strtolower(end($extention));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/plants/" . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);
            }
        }
    } else {
        $fileNew = $img2;
    }
    try {
        $edit = $conn->prepare("UPDATE plants SET plants_name=:name, plants_namemarket=:namemarket, plants_detail=:detail, plants_img=:img, plantsfamily_name=:plantsfamily_name, plantsgroup_name=:plantsgroup_name
                            WHERE plants_id=:id");
        $edit->bindParam(":name", $name);
        $edit->bindParam(":namemarket", $namemarket);
        $edit->bindParam(":detail", $detail);
        $edit->bindParam(":img", $fileNew);
        $edit->bindParam(":plantsfamily_name", $plantsfamily_name);
        $edit->bindParam(":plantsgroup_name", $plantsgroup_name);
        $edit->bindParam(":id", $id);
        $edit->execute();

        if ($edit) {
            echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'อัปเดตพันธุ์ไม้สำเร็จ',
                                icon: 'success',
                                timer: 5000,
                                showConfirmButton: false
                            });
                        });
                    </script>";
            header("refresh:1; url=admin.php?q=manageplants&id=$id");
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
            header("refresh:1; url=admin.php?q=manageplants&id=$id");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        $edit = $conn->prepare("DELETE FROM plants WHERE plants_id = :id");
        $edit->bindParam(":id", $id);
        $edit->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<?php include_once("./components/footer.php"); ?>