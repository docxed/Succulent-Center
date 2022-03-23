<br><br>
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
            $stmt = $conn->query("SELECT * FROM plantsform ORDER BY plantsform_id DESC");
            $stmt->execute();
            $forms = $stmt->fetchAll();
            if (!$forms) {
                echo "<td colspan='2'>ไม่มีข้อมูล</td>";
            } else {
                foreach ($forms as $form) {
            ?>
                    <tr>
                        <td class="text-center"><?= $form['plantsform_name']; ?></td>
                        <td class="text-center"><a href="./plantsformview.php?id=<?= $form['plantsform_id']; ?>" class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a></td>
                        <td class="text-center col-2">
                            <select class="form-select" name="status" onchange="editCheck(this.value, <?= $form['plantsform_id']; ?>)">
                                <option value="check" <?php if ($form['plantsform_status'] == 'check') {
                                                            echo 'selected';
                                                        } ?>>อนุมัติแล้ว</option>
                                <option value="uncheck" <?php if ($form['plantsform_status'] == 'uncheck') {
                                                            echo 'selected';
                                                        } ?>>รอการอนุมัติ</option>
                            </select>
                            </form>

                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    function editCheck(value, id) {
        $.ajax({
            url: "plantsform_db.php",
            type: "POST",
            data: {
                status: value,
                id: id
            },
            success: function(res) {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'อัปเดตสถานะสำเร็จ',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    document.location.href = 'admin.php?q=manageplantsform';
                });

            }
        });
    }
</script>