<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div>
    <br><br>
    <div class="container">
        <h2>ไม้อวบน้ำ</h2>
        <hr>
        <p class="fs-5">&nbsp;&nbsp;&nbsp;&nbsp;คำว่า ไม้อวบน้ำ เป็นคำที่นักพืชสวนในบ้านเราแปลมาจากศัพท์ภาษอังกฤษว่า Succulent ซึ่งมีรากศัพท์มาจากภาษาละตินว่า Succulentus อันมีความหมายว่า อวบหรืออิ่มน้ำ ไม้อวบน้ำในที่นี้จึงหมายถึงพรรณไม้ที่มีวิวัฒนาการทางสรีระให้สามารถเก็บ กักน้ำไว้ในส่วนต่าง ๆ รองลำต้น ไม่ว่าจะเป้นราก หัวใต้ดิน ลำต้น หรือใบเพื่อดำรงชีวิตอยู่ในสภาวะที่แห้งแล้งยาวนาน</p>
        <br>
        <h2>พันธุ์ไม้ที่เกี่ยวข้อง</h2>
        <hr>
        <br>
        <?php
        $stmt = $conn->query("SELECT * FROM plants ORDER BY RAND()");
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
                            <img src="<?= $plant['plants_img']; ?>" alt="" style="width: 100%; height: 230px; border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover;">
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