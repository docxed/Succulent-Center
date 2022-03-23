<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div class="container my-5">
    <?php
    $id = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM plantsgroup WHERE plantsgroup_id = $id");
    $stmt->execute();
    $plantsgroup = $stmt->fetch();
    ?>
    <h2><?= $plantsgroup['plantsgroup_name'] ?></h2>
    <hr>
    <br>
    <div class="fs-5">
        <p>วงศ์ <?= $plantsgroup['plantsfamily_name'] ?></p>
        <p class="h4 mb-3">รายละเอียด</p>
        <p class="mb-3"><?= $plantsgroup['plantsgroup_detail'] ?></p>
        <p class="h4 mb-3">ลักษณะทั่วไป</p>
        <p><?= $plantsgroup['plantsgroup_type'] ?></p>
        <br>
        <h2>พันธุ์ไม้ที่เกี่ยวข้อง</h2>
        <hr>
        <br>
        <?php
        $plantsgroupName = $plantsgroup['plantsgroup_name'];
        $stmt = $conn->query("SELECT * FROM plants WHERE plantsgroup_name = '$plantsgroupName' ORDER BY plants_name ASC");
        $stmt->execute();
        $plants = $stmt->fetchAll();
        if (!$plants) {
            echo 'ไม่มีข้อมูล';
        } else {
        ?>
            <div class="row">
                <?php foreach ($plants as $plant) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                        <div class="border m-auto pb-3 h-100" style="border-radius: 10px;">
                            <img src="<?= "uploads/plants/" . $plant['plants_img']; ?>" alt="" style="width: 100%; height: 230px; border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover;">
                            <div class="h5 my-3 mx-3 text-center">
                                <a href="./plantsview.php?id=<?= $plant['plants_id'] ?>" style="text-decoration: none;"><?= $plant['plants_name'] ?></a>
                            </div>
                            <?php
                            if ($plant['plants_namemarket'] != '-') {
                            ?>
                                <div class="mb-3 mx-3 text-center"><?= $plant['plants_namemarket'] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php
        }
        ?>
    </div>

</div>
<?php include_once("./components/footer.php"); ?>