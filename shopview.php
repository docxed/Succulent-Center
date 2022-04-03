<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div class="container my-5">
    <?php
    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM shop INNER JOIN users ON users.user_id=shop.user_id WHERE shop_id = $id");
    $stmt->execute();
    $shop = $stmt->fetch();
    ?>
    <h2><?= $shop['shop_name'] ?></h2>
    <hr>
    <br>
    <div class="col-lg-7 col-md-7 col-sm-12 m-auto">
        <div class="text-center">
            <a href="<?= "uploads/shop/" . $shop['shop_img']; ?>" target="_blank"><img src="<?= "uploads/shop/" . $shop['shop_img']; ?>" class="w-55 mb-3 img-thumbnail" alt=""></a>
        </div>
        <div class="content my-3">
            <p class="h5"><i class="fa-solid fa-circle-info me-1"></i>รายละเอียด</p>
            <p class="mb-3"><?= $shop['shop_detail'] ?></p>
            <p class="mb-3"><i class="fa-solid fa-location-dot me-1"></i> <?= $shop['shop_address'] ?></p>
            <p class="mb-5"><i class="fa-solid fa-phone me-1"></i> <?= $shop['shop_phone'] ?></p>
            <div id="map" class="m-auto mb-3 w-100"></div>
        </div>

        <?php if (isset($_SESSION['login_level']) && $_SESSION['login_level'] == 'admin') { ?>
            <div class=" my-5 content">
                <p class="h4 mb-3">ข้อมูลผู้ใช้</p>
                <p>โดย <?= $shop['user_fname'] . ' ' . $shop['user_lname'] ?></p>
                <p>รหัสบัตรประชาชน <?= $shop['user_idcard'] ?></p>
                <p>อีเมล <?= $shop['user_email'] ?></p>
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
    showUserLocationOnTheMap(<?= $shop['shop_lat'] ?>, <?= $shop['shop_lng'] ?>)
</script>
<?php include_once("./components/footer.php"); ?>