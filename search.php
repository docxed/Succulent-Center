<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div>
    <br><br>
    <div class="container">
        <h4 class="p-3 mb-3" style="background-color: #E9ECEF; border-radius: 8px;">กำลังแสดงผลการค้นหาสำหรับ <span class="text-danger"><?= $_GET['keyword'] ?></span></h4>
        <div class="ms-3 row">
            <div class="col">
                <a href="search.php?keyword=<?= $_GET['keyword'] ?>&type=all&search=" class="me-1" style="text-decoration: none;">
                    <button class="btn btn-sm btn-primary <?php if ($_GET['type'] == 'all') {
                                                                echo 'active';
                                                            } ?>">ทั้งหมด</button>
                </a>
                <a href="search.php?keyword=<?= $_GET['keyword'] ?>&type=plants&search=" class="me-1" style="text-decoration: none;">
                    <button class="btn btn-sm btn-primary <?php if ($_GET['type'] == 'plants') {
                                                                echo 'active';
                                                            } ?>">พันธุ์ไม้</button>
                </a>
                <a href="search.php?keyword=<?= $_GET['keyword'] ?>&type=plantsgroup&search=" class="me-1" style="text-decoration: none;">
                    <button class="btn btn-sm btn-primary <?php if ($_GET['type'] == 'plantsgroup') {
                                                                echo 'active';
                                                            } ?>">สกุล</button>
                </a>
                <a href="search.php?keyword=<?= $_GET['keyword'] ?>&type=plantsfamily&search=" class="me-1" style="text-decoration: none;">
                    <button class="btn btn-sm btn-primary <?php if ($_GET['type'] == 'plantsfamily') {
                                                                echo 'active';
                                                            } ?>">วงศ์</button>
                </a>
            </div>
        </div>
        <hr>
        <?php
        $kw = '%' . $_GET['keyword'] . '%';
        $stmt = $conn->query("SELECT * FROM plants WHERE plants_name LIKE '$kw' OR plants_namemarket LIKE '$kw' OR plantsfamily_name LIKE '$kw' OR plantsgroup_name LIKE '$kw'");
        $stmt->execute();
        $plants = $stmt->fetchAll();

        $stmt = $conn->query("SELECT * FROM plantsgroup WHERE plantsfamily_name LIKE '$kw' OR plantsgroup_name LIKE '$kw'");
        $stmt->execute();
        $plantsgroups = $stmt->fetchAll();

        $stmt = $conn->query("SELECT * FROM plantsfamily WHERE plantsfamily_name LIKE '$kw'");
        $stmt->execute();
        $plantsfamilys = $stmt->fetchAll();

        if ($_GET['type'] == 'all' && (!$plants && !$plantsgroups && !$plantsfamilys)) { ?>
            <div class="mb-3">การค้นหาของคุณไม่ตรงกับข้อมูลใด ๆ</div>
            <div>คำแนะนำ:</div>
            <div>
                <ul>
                    <li>ตรวจดูให้แน่ใจว่าสะกดถูกต้องทุกคำ</li>
                    <li>ลองใช้คำหลักอื่น ๆ</li>
                    <li>ลองใช้คำหลักที่กว้างขึ้น</li>
                    <li>ลองใช้คำหลักน้อยลง</li>
                </ul>
            </div>
        <?php } else {
        ?>
            <?php
            if ($_GET['type'] == 'plants' || $_GET['type'] == 'all') {
            ?>
                <div class="text-secondary mb-3">ผลการค้นหาพันธุ์ไม้ <?= sizeof($plants) ?> รายการ</div>
                <div class="row mb-5">
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
            <?php } ?>

            <?php
            if ($_GET['type'] == 'plantsgroup' || $_GET['type'] == 'all') {
            ?>
                <div class="text-secondary mb-3">ผลการค้นหาสกุล <?= sizeof($plantsgroups) ?> รายการ</div>
                <div class="row mb-5">
                    <?php foreach ($plantsgroups as $plantsgroup) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                            <div class="border m-auto pb-3 h-100" style="border-radius: 10px;">
                                <div class="h5 my-3 mx-3 text-center">
                                    <a href="./plantsgroupview.php?id=<?= $plantsgroup['plantsgroup_id'] ?>" style="text-decoration: none;"><?= $plantsgroup['plantsgroup_name'] ?></a>
                                </div>
                                <div class="mb-3 mx-3 text-center">วงศ์ <?= $plantsgroup['plantsfamily_name'] ?></div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php
                if ($_GET['type'] == 'plantsfamily' || $_GET['type'] == 'all') {
                ?>
                    <div class="text-secondary mb-3">ผลการค้นหาวงศ์ <?= sizeof($plantsfamilys) ?> รายการ</div>
                    <div class="row mb-5">
                        <?php foreach ($plantsfamilys as $plantsfamily) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-12 mb-5">
                                <div class="border m-auto pb-3 h-100" style="border-radius: 10px;">
                                    <div class="h5 my-3 mx-3 text-center">
                                        <a href="./plantsfamilyview.php?id=<?= $plantsfamily['plantsfamily_id'] ?>" style="text-decoration: none;"><?= $plantsfamily['plantsfamily_name'] ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                }
                ?>
            <?php } ?>
                </div>
    </div>
    <?php include_once("./components/footer.php"); ?>