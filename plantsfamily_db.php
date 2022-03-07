<?php include_once("./components/head.php"); ?>
<?php
session_start();
require_once("./config/db.php");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];

    try {
        $check_dupped = $conn->prepare("SELECT plantsfamily_name FROM plantsfamily WHERE plantsfamily_name = :name");
        $check_dupped->bindParam(":name", $name);
        $check_dupped->execute();
        $row_dupped = $check_dupped->fetch(PDO::FETCH_ASSOC);

        if (isset($row_dupped['plantsfamily_name']) && $row_dupped['plantsfamily_name'] == $name) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'วงศ์ซ้ำกับในระบบ',
                            icon: 'warning',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
            header("refresh:2; url=admin.php?q=manageplantsfamily");
        } else {
            $add = $conn->prepare("INSERT INTO plantsfamily(plantsfamily_name, plantsfamily_detail)
                                VALUES(:name, :detail)");
            $add->bindParam(":name", $name);
            $add->bindParam(":detail", $detail);
            $add->execute();

            if ($add) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'เพิ่มวงศ์สำเร็จ',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
            </script>";
                header("refresh:1; url=admin.php?q=manageplantsfamily");
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
                header("refresh:2; url=admin.php?q=manageplantsfamily");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $id = $_POST['id'];

    try {

        $edit = $conn->prepare("UPDATE plantsfamily SET plantsfamily_name=:name, plantsfamily_detail=:detail WHERE plantsfamily_id = :id");
        $edit->bindParam(":name", $name);
        $edit->bindParam(":detail", $detail);
        $edit->bindParam(":id", $id);
        $edit->execute();

        if ($edit) {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'อัปเดตวงศ์สำเร็จ',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
            </script>";
            header("refresh:2; url=admin.php?q=manageplantsfamily&id=$id");
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
            header("refresh:2; url=admin.php?q=manageplantsfamily&id=$id");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        $edit = $conn->prepare("DELETE FROM plantsfamily WHERE plantsfamily_id = :id");
        $edit->bindParam(":id", $id);
        $edit->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<?php include_once("./components/footer.php"); ?>