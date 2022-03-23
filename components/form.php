<?php
    $user_id = $_SESSION['user'];
    $nForms = $conn->query("SELECT COUNT(*) FROM plantsform WHERE user_id = $user_id")->fetchColumn();
?>
<h2>พันธุ์ไม้จดทะเบียนทั้งหมด <span class="badge rounded-pill" style="background-color: #1FAB89;"><?= $nForms ?></span></h2>
<hr>
<?php
$stmt = $conn->query("SELECT * FROM plantsform WHERE user_id = $user_id ORDER BY plantsform_id ASC");
$stmt->execute();
$forms = $stmt->fetchAll();
if (!$forms) {
    echo '<p class="h4 text-center mt-5">ยังไม่มีรายการจดทะเบียน</p>';
} else {
?>
    <div class="row">
        <?php foreach ($forms as $form) { ?>
            <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                <div class="border m-auto pb-3 h-100" style="border-radius: 10px;">
                    <img src="<?= "uploads/plantsform/" . $form['plantsform_img']; ?>" alt="" style="width: 100%; height: 230px; border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover;">
                    <div class="h5 my-3 mx-3 text-center">
                        <a href="./plantsformview.php?id=<?= $form['plantsform_id'] ?>" style="text-decoration: none;"><?= $form['plantsform_name'] ?></a>
                    </div>
                    <?php
                    if ($form['plantsform_namemarket'] != '-') {
                    ?>
                        <div class="mb-2 mx-3 text-center"><?= $form['plantsform_namemarket'] ?></div>
                    <?php } ?>
                    <div class="mb-2 mx-3 text-center">วงศ์ <?= $form['plantsfamily_name'] ?></div>
                    <div class="mb-2 mx-3 text-center">สกุล <?= $form['plantsgroup_name'] ?></div>
                    <div class="mb-2 mx-3 text-center">
                        <?php if ($form['plantsform_status'] == 'uncheck') { ?>
                            <span class="badge bg-secondary">รอการอนุมัติ</span>
                        <?php } else { ?>
                            <span class="badge bg-success">อนุมัติแล้ว</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
}
?>