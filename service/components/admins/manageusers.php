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
                    $stmt = $conn->query("SELECT * FROM users WHERE user_id = $edit_id");
                    $stmt->execute();
                    $edit_user = $stmt->fetch();
                    ?>
                    <form action="user_db.php" method="post">
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['warning'])) { ?>
                            <div class="alert alert-warning" role="alert">
                                <?php
                                echo $_SESSION['warning'];
                                unset($_SESSION['warning']);
                                ?>
                            </div>
                        <?php } ?>

                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" name="email" class="form-control" value="<?= $edit_user['user_email']; ?>" placeholder="อีเมล" aria-describedby="email" maxlength="50" readonly>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">ชื่อ</label>
                                <input type="text" name="fname" class="form-control" value="<?= $edit_user['user_fname']; ?>" placeholder="ชื่อ" aria-describedby="fname" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="lname" class="form-label">นามสกุล</label>
                                <input type="text" name="lname" class="form-control" value="<?= $edit_user['user_lname']; ?>" placeholder="นามสกุล" aria-describedby="lname" maxlength="50" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
                            <input type="text" name="idcard" class="form-control" value="<?= $edit_user['user_idcard']; ?>" placeholder="เลขบัตรประชาชน 13 หลัก" aria-describedby="idcard" maxlength="13" pattern="[0-9]+" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">ตำแหน่ง</label>
                            <select name="role" class="form-select" required>
                                <option value="admin" <?php if ($edit_user['user_role'] == 'admin') {
                                                            echo 'selected';
                                                        } ?>>admin</option>
                                <option value="user" <?php if ($edit_user['user_role'] == 'user') {
                                                            echo 'selected';
                                                        } ?>>user</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $edit_user['user_id']; ?>">
                        <input type="hidden" name="self_id" value="<?= $_SESSION['user']; ?>">
                        <div class="mb-3 text-center">
                            <button type="submit" name="edit_user" class="btn btn-info mx-auto">อัปเดตข้อมูล</button>
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
<br><br>
<div class="content">
    <table class="table table-striped table-hover table-responsive text-center">
        <thead>
            <tr>
                <td>อีเมล</td>
                <td>ชื่อ - นามสกุล</td>
                <td>ตำแหน่ง</td>
                <td colspan="2">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll();
            if (!$users) {
                echo "<td colspan='4'>ไม่มีผู้ใช้</td>";
            } else {
                foreach ($users as $user) {
            ?>
                    <tr>
                        <td><?= $user['user_email']; ?></td>
                        <td><?= $user['user_fname'] . ' ' . $user['user_lname']; ?></td>
                        <td><?= $user['user_role'] ?></td>
                        <td><a href="./admin.php?q=manageusers&id=<?= $user['user_id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a></td>
                        <td><a data-id="<?= $user['user_id']; ?>" href="./user_db.php?delete=<?= $user['user_id']; ?>" class="btn btn-sm btn-danger delete-btn">ลบ</a></td>
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
                            url: 'user_db.php',
                            type: 'GET',
                            data: 'delete=' + id,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ลบข้อมูลแล้ว',
                                icon: 'success',
                            }).then(() => {
                                document.location.href = 'admin.php?q=manageusers';
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