<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div class="container my-5">
    <?php
    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM plants WHERE plants_id = $id");
    $stmt->execute();
    $plant = $stmt->fetch();
    ?>
    <h2><?= $plant['plants_name'] ?></h2>
    <hr>
    <br>
    <div class="col-lg-7 col-md-7 col-sm-12 m-auto">
        <div class="text-center">
            <a href="<?= "uploads/plants/" . $plant['plants_img']; ?>" target="_blank"><img src="<?= "uploads/plants/" . $plant['plants_img']; ?>" class="w-55 mb-3 img-thumbnail" alt=""></a>
        </div>
        <p>ชื่อทางการตลาด <?= $plant['plants_namemarket'] ?></p>
        <p>วงศ์ <?= $plant['plantsfamily_name'] ?></p>
        <p>สกุล <?= $plant['plantsgroup_name'] ?></p>
        <p class="h5">รายละเอียด</p>
        <p><?= $plant['plants_detail'] ?></p>
    </div>
</div>
<?php include_once("./components/footer.php"); ?>