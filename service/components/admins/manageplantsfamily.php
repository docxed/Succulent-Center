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
                    $stmt = $conn->query("SELECT * FROM plantsfamily WHERE plantsfamily_id = $edit_id");
                    $stmt->execute();
                    $edit_plantsfamily = $stmt->fetch();
                    ?>
                    <form action="plantsfamily_db.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อ</label>
                            <input type="text" name="name" class="form-control" placeholder="ชื่อ" value="<?= $edit_plantsfamily['plantsfamily_name']; ?>" aria-describedby="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">รายละเอียด</label>
                            <textarea name="detail" class="form-control" cols="30" rows="5" placeholder="รายละเอียด" aria-describedby="detail" required><?= $edit_plantsfamily['plantsfamily_detail']; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?= $edit_plantsfamily['plantsfamily_id']; ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มวงศ์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="plantsfamily_db.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ</label>
                        <input type="text" name="name" class="form-control" placeholder="ชื่อ" aria-describedby="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">รายละเอียด</label>
                        <textarea name="detail" class="form-control" cols="30" rows="5" placeholder="รายละเอียด" aria-describedby="detail" required></textarea>
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
<br><br>
<p class="text-end">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">เพิ่มวงศ์</button>
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
            $stmt = $conn->query("SELECT * FROM plantsfamily ORDER BY plantsfamily_name ASC");
            $stmt->execute();
            $plantsfamilys = $stmt->fetchAll();
            if (!$plantsfamilys) {
                echo "<td colspan='2'>ไม่มีข้อมูล</td>";
            } else {
                foreach ($plantsfamilys as $plantsfamily) {
            ?>
                    <tr>
                        <td><?= $plantsfamily['plantsfamily_name']; ?></td>
                        <td><a href="./admin.php?q=manageplantsfamily&id=<?= $plantsfamily['plantsfamily_id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a></td>
                        <td><a data-id="<?= $plantsfamily['plantsfamily_id']; ?>" href="./plantsfamily_db.php?delete=<?= $plantsfamily['plantsfamily_id']; ?>" class="btn btn-sm btn-danger delete-btn">ลบ</a></td>
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
                            url: 'plantsfamily_db.php',
                            type: 'GET',
                            data: 'delete=' + id,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ลบข้อมูลแล้ว',
                                icon: 'success',
                            }).then(() => {
                                document.location.href = 'admin.php?q=manageplantsfamily';
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