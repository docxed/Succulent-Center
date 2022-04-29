<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div class="container my-5">
    <?php
    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM plantsfamily WHERE plantsfamily_id = $id");
    $stmt->execute();
    $plantsfamily = $stmt->fetch();
    ?>
    <h2><?= $plantsfamily['plantsfamily_name'] ?></h2>
    <hr>
    <h4 class="mb-3">รายละเอียด</h4>
    <div class="fs-5">
        <?= $plantsfamily['plantsfamily_detail'] ?>
    </div>
    <br>
    <h2>สกุลที่เกี่ยวข้อง</h2>
    <hr>
    <br>
    <?php
    $plantsfamilyName = $plantsfamily['plantsfamily_name'];
    $stmt = $conn->query("SELECT * FROM plantsgroup WHERE plantsfamily_name = '$plantsfamilyName' ORDER BY plantsgroup_name ASC");
    $stmt->execute();
    $plantsgroups = $stmt->fetchAll();
    if (!$plantsgroups) {
        echo 'ไม่มีข้อมูล';
    } else {
    ?>
        <div class="row">
            <?php foreach ($plantsgroups as $plantsgroup) { ?>
                <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                    <div class="border m-auto pb-3 h-100" style="border-radius: 10px;">
                        <div class="h5 my-3 mx-3 text-center">
                            <a href="./plantsgroupview.php?id=<?= $plantsgroup['plantsgroup_id'] ?>" style="text-decoration: none;"><?= $plantsgroup['plantsgroup_name'] ?></a>
                        </div>
                        <div class="mb-3 mx-3 text-center">วงศ์ <?= $plantsgroup['plantsfamily_name'] ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php
    }
    ?>
    <?php include_once("./components/footer.php"); ?>