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
            <a href="<?= $plant['plants_img']; ?>" target="_blank"><img src="<?= $plant['plants_img']; ?>" class="w-55 mb-3 img-thumbnail" alt=""></a>
        </div>
        <p>ชื่อทางการตลาด <?= $plant['plants_namemarket'] ?></p>
        <?php
        $plantsfamily_name = $plant['plantsfamily_name'];
        $stmt = $conn->query("SELECT * FROM plantsfamily WHERE plantsfamily_name = '$plantsfamily_name'");
        $stmt->execute();
        $plantsfamily = $stmt->fetch();

        $plantsgroup_name = $plant['plantsgroup_name'];
        $stmt = $conn->query("SELECT * FROM plantsgroup WHERE plantsgroup_name = '$plantsgroup_name'");
        $stmt->execute();
        $plantsgroup = $stmt->fetch();
        ?>
        <p>วงศ์ <a href="./plantsfamilyview.php?id=<?= $plantsfamily['plantsfamily_id'] ?>"><?= $plant['plantsfamily_name'] ?></a></p>
        <p>สกุล <a href="./plantsgroupview.php?id=<?= $plantsgroup['plantsgroup_id'] ?>"><?= $plant['plantsgroup_name'] ?></a></p>
        <p class="h5">รายละเอียด</p>
        <p><?= $plant['plants_detail'] ?></p>
    </div>
</div>
<?php include_once("./components/footer.php"); ?>