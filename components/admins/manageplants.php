<?php
if (isset($_GET['id'])) { ?>
    <script>
        $(window).on('load', function() {
            $('#edit').modal('show');
        });
    </script>
    <div class="modal show" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="f">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไข</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $edit_id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM plants WHERE plants_id = $edit_id");
                    $stmt->execute();
                    $edit_plants = $stmt->fetch();
                    ?>
                    <form action="plants_db.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                            <label for="plantsfamily_name" class="form-label">วงศ์</label>
                            <select name="plantsfamily_name" class="form-select" required>
                                <?php
                                $stmt = $conn->query("SELECT * FROM plantsfamily");
                                $stmt->execute();
                                $plantsfamilys = $stmt->fetchAll();
                                if (!$plantsfamilys) {
                                    echo '<option disabled>ไม่มีวงศ์</option>';
                                } else {
                                    foreach ($plantsfamilys as $plantsfamily) { ?>
                                        <option value="<?= $plantsfamily['plantsfamily_name']; ?>" <?php if ($plantsfamily['plantsfamily_name'] == $edit_plants['plantsfamily_name']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>>วงศ์ <?= $plantsfamily['plantsfamily_name']; ?></option>
                                <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="plantsgroup_name" class="form-label">สกุล</label>
                            <select name="plantsgroup_name" class="form-select" required>
                            <?php
                                $stmt = $conn->query("SELECT * FROM plantsgroup");
                                $stmt->execute();
                                $plantsgroups = $stmt->fetchAll();
                                if (!$plantsgroups) {
                                    echo '<option disabled>ไม่มีสกุล</option>';
                                } else {
                                    foreach ($plantsgroups as $plantsgroup) { ?>
                                        <option value="<?= $plantsgroup['plantsgroup_name']; ?>" <?php if ($plantsgroup['plantsgroup_name'] == $edit_plants['plantsgroup_name']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>>สกุล <?= $plantsgroup['plantsgroup_name']; ?></option>
                                <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อ</label>
                            <input type="text" name="name" class="form-control" value="<?= $edit_plants['plants_name']; ?>"  placeholder="ชื่อ" aria-describedby="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="namemarket" class="form-label">ชื่อทางการตลาด (ไม่มีใส่ -)</label>
                            <input type="text" name="namemarket" class="form-control" value="<?= $edit_plants['plants_namemarket']; ?>" placeholder="ชื่อทางการตลาด" aria-describedby="namemarket" required>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">รายละเอียด</label>
                            <textarea name="detail" class="form-control" cols="30" rows="5" placeholder="รายละเอียด" aria-describedby="detail" required><?= $edit_plants['plants_detail']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <img src="<?= "uploads/plants/".$edit_plants['plants_img']; ?>" class=" my-3 w-100" alt="">
                            <label for="img" class="form-label">รูปภาพประกอบ (Optional)</label>
                            <input class="form-control" type="file" id="imgInput2" name="img" accept=".jpg, .jpeg, .png">
                            <img id="previewImg2" class=" mt-3 w-100" alt="">
                        </div>
                        <input type="hidden" name="img2" value="<?= $edit_plants['plants_img']; ?>">
                        <input type="hidden" name="id" value="<?= $edit_plants['plants_id']; ?>">
                        <div class="mb-3 text-center">
                            <button type="submit" name="edit" class="btn btn-info">อัปเดต</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มพันธุ์ไม้</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="plants_db.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="plantsfamily_name" class="form-label">วงศ์</label>
                        <select name="plantsfamily_name" class="form-select" required>
                            <?php
                            $stmt = $conn->query("SELECT * FROM plantsfamily");
                            $stmt->execute();
                            $plantsfamilys = $stmt->fetchAll();
                            if (!$plantsfamilys) {
                                echo '<option disabled>ไม่มีวงศ์</option>';
                            } else {
                                foreach ($plantsfamilys as $plantsfamily) { ?>
                                    <option value="<?= $plantsfamily['plantsfamily_name']; ?>">วงศ์ <?= $plantsfamily['plantsfamily_name']; ?></option>
                            <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="plantsgroup_name" class="form-label">สกุล</label>
                        <select name="plantsgroup_name" class="form-select" required>
                            <?php
                            $stmt = $conn->query("SELECT * FROM plantsgroup");
                            $stmt->execute();
                            $plantsgroups = $stmt->fetchAll();
                            if (!$plantsgroups) {
                                echo '<option disabled>ไม่มีสกุล</option>';
                            } else {
                                foreach ($plantsgroups as $plantsgroup) { ?>
                                    <option value="<?= $plantsgroup['plantsgroup_name']; ?>">สกุล <?= $plantsgroup['plantsgroup_name']; ?></option>
                            <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ</label>
                        <input type="text" name="name" class="form-control" placeholder="ชื่อ" aria-describedby="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="namemarket" class="form-label">ชื่อทางการตลาด (ไม่มีใส่ -)</label>
                        <input type="text" name="namemarket" class="form-control" placeholder="ชื่อทางการตลาด" aria-describedby="namemarket" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">รายละเอียด</label>
                        <textarea name="detail" class="form-control" cols="30" rows="5" placeholder="รายละเอียด" aria-describedby="detail" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">รูปภาพประกอบ</label>
                        <input class="form-control" type="file" id="imgInput" name="img" required accept=".jpg, .jpeg, .png">
                        <img id="previewImg" class=" mt-3 w-100" alt="">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" name="add" class="btn btn-success">เพิ่ม</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>
    let imgInput = document.getElementById("imgInput")
    let previewImg = document.getElementById("previewImg")

    imgInput.onchange = evt => {
        const [file] = imgInput.files
        if (file) {
            previewImg.src = URL.createObjectURL(file)
        }
    }

    let imgInput2 = document.getElementById("imgInput2")
    let previewImg2 = document.getElementById("previewImg2")

    imgInput2.onchange = evt => {
        const [file] = imgInput2.files
        if (file) {
            previewImg2.src = URL.createObjectURL(file)
        }
    }
</script>
<br><br>
<p class="text-end">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">เพิ่มพันธุ์ไม้</button>
</p>
<div class="content">
    <table class="table table-striped table-hover table-responsive text-center">
        <thead>
            <tr>

                <td>ชื่อ</td>
                <td colspan="2">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM plants ORDER BY plants_name ASC");
            $stmt->execute();
            $plants = $stmt->fetchAll();
            if (!$plants) {
                echo "<td colspan='2'>ไม่มีข้อมูล</td>";
            } else {
                foreach ($plants as $plant) {
            ?>
                    <tr>
                        <td><?= $plant['plants_name']; ?></td>
                        <td><a href="./admin.php?q=manageplants&id=<?= $plant['plants_id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a></td>
                        <td><a data-id="<?= $plant['plants_id']; ?>" href="./plants_db.php?delete=<?= $plant['plants_id']; ?>" class="btn btn-sm btn-danger delete-btn">ลบ</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $(".delete-btn").click(function(e) {
        var id = $(this).data('id');
        e.preventDefault();
        deleteConfirm(id);
    })

    function deleteConfirm(id) {
        Swal.fire({
            title: "คุณแน่ใจใช่ไหม",
            text: "ข้อมูลนี้จะถูกลบโดยถาวร",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'plants_db.php',
                            type: 'GET',
                            data: 'delete=' + id,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ลบข้อมูลแล้ว',
                                icon: 'success',
                            }).then(() => {
                                document.location.href = 'admin.php?q=manageplants';
                            })
                        })
                        .fail(function() {
                            Swal.fire('อุ๊ปส์', 'เกิดข้อผิดพลาดบางสิ่งกับ ajax', 'error')
                            window.location.reload();
                        });
                });
            },
        });
    }
</script>