<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div class="container my-5">
    <?php
    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM plantsform INNER JOIN users ON users.user_id=plantsform.user_id WHERE plantsform_id = $id");
    $stmt->execute();
    $form = $stmt->fetch();
    ?>
    <h2><?= $form['plantsform_name'] ?></h2>
    <hr>
    <br>
    <div class="col-lg-7 col-md-7 col-sm-12 m-auto">
        <div class="h2 text-center mb-5">
            <?php if ($form['plantsform_status'] == 'uncheck') { ?>
                <span class="badge bg-secondary">รอการอนุมัติ</span>
            <?php } else { ?>
                <span class="badge bg-success">อนุมัติแล้ว</span>
            <?php } ?>
        </div>
        <div class="text-center">
            <a href="<?= "uploads/plantsform/" . $form['plantsform_img']; ?>" target="_blank"><img src="<?= "uploads/plantsform/" . $form['plantsform_img']; ?>" class="w-55 mb-3 img-thumbnail" alt=""></a>
        </div>
        <p>ชื่อทางการตลาด <?= $form['plantsform_namemarket'] ?></p>
        <p>วงศ์ <?= $form['plantsfamily_name'] ?></p>
        <p>สกุล <?= $form['plantsgroup_name'] ?></p>
        <p class="h5">คำอธิบายเกี่ยวกับพรรณไม้ที่ผลิตได้ </p>
        <p><?= $form['plantsform_detail'] ?></p>
        <p class="h5 mb-3">ระแวกที่อยู่ในการตรวจสอบพันธุ์ไม้</p>
        <p><?= $form['plantsform_address'] ?></p>
        <div id="map" class="m-auto mb-3 w-100"></div>
        <?php if ($_SESSION['login_level'] == 'admin') { ?>
            <div class=" my-5 content">
                <p class="h4 mb-3">ข้อมูลผู้ใช้</p>
                <p>โดย <?= $form['user_fname'] . ' ' . $form['user_lname'] ?></p>
                <p>รหัสบัตรประชาชน <?= $form['user_idcard'] ?></p>
                <p>อีเมล <?= $form['user_email'] ?></p>
            </div>
        <?php } ?>

    </div>
</div>
<script>
    function showUserLocationOnTheMap(lat, lng) {
        let map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: new google.maps.LatLng(lat, lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        })
        new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map,
        })
    }
    showUserLocationOnTheMap(<?= $form['plantsform_lat'] ?>, <?= $form['plantsform_lng'] ?>)
</script>
<?php include_once("./components/footer.php"); ?>