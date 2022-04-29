<?php include_once("./components/head.php"); ?>
<?php
session_start();
require_once("./config/db.php");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $type = $_POST['type'];
    $plantsfamily_name = $_POST['plantsfamily_name'];

    try {
        $check_dupped = $conn->prepare("SELECT plantsgroup_name FROM plantsgroup WHERE plantsgroup_name = :name");
        $check_dupped->bindParam(":name", $name);
        $check_dupped->execute();
        $row_dupped = $check_dupped->fetch(PDO::FETCH_ASSOC);

        if (isset($row_dupped['plantsgroup_name']) && $row_dupped['plantsgroup_name'] == $name) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ไม่สำเร็จ',
                            text: 'สกุลซ้ำกับในระบบ',
                            icon: 'warning',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    });
                </script>";
            header("refresh:2; url=admin.php?q=manageplantsfamily");
        } else {
            $add = $conn->prepare("INSERT INTO plantsgroup(plantsgroup_name, plantsgroup_detail, plantsgroup_type, plantsfamily_name)
                                VALUES(:name, :detail, :type, :plantsfamily_name)");
            $add->bindParam(":name", $name);
            $add->bindParam(":detail", $detail);
            $add->bindParam(":type", $type);
            $add->bindParam(":plantsfamily_name", $plantsfamily_name);
            $add->execute();

            if ($add) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'เพิ่มสกุลสำเร็จ',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
            </script>";
                header("refresh:1; url=admin.php?q=manageplantsgroup");
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
                header("refresh:2; url=admin.php?q=manageplantsgroup");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $type = $_POST['type'];
    $plantsfamily_name = $_POST['plantsfamily_name'];
    $id = $_POST['id'];

    try {

        $edit = $conn->prepare("UPDATE plantsgroup SET plantsgroup_name=:name, plantsgroup_detail=:detail, plantsgroup_type=:type, plantsfamily_name=:plantsfamily_name WHERE plantsgroup_id = :id");
        $edit->bindParam(":name", $name);
        $edit->bindParam(":detail", $detail);
        $edit->bindParam(":type", $type);
        $edit->bindParam(":plantsfamily_name", $plantsfamily_name);
        $edit->bindParam(":id", $id);
        $edit->execute();

        if ($edit) {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'อัปเดตสกุลสำเร็จ',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                });
            </script>";
            header("refresh:1; url=admin.php?q=manageplantsgroup&id=$id");
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
            header("refresh:1; url=admin.php?q=manageplantsgroup&id=$id");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    try {
        $edit = $conn->prepare("DELETE FROM plantsgroup WHERE plantsgroup_id = :id");
        $edit->bindParam(":id", $id);
        $edit->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<?php include_once("./components/footer.php"); ?>