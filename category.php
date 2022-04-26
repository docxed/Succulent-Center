<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>

<div class="container my-5">
  <h2>สารบัญพันธุ์ไม้</h2>
  <hr>
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['q']) && $_GET['q'] == 'plantsfamily') {
                            echo 'active';
                          } ?>" href="./category.php?q=plantsfamily">วงศ์</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['q']) && $_GET['q'] == 'plantsgroup') {
                            echo 'active';
                          } ?>" href="./category.php?q=plantsgroup">สกุล</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if (isset($_GET['q']) && $_GET['q'] == 'plants') {
                            echo 'active';
                          } ?>" href="./category.php?q=plants">พันธุ์ไม้</a>
    </li>
  </ul>
  <hr>
  <br>
  <?php
  if (isset($_GET['q']) && $_GET['q'] == 'plantsfamily') {
    $stmt = $conn->query("SELECT * FROM plantsfamily ORDER BY plantsfamily_name ASC");
    $stmt->execute();
    $plantsfamilys = $stmt->fetchAll();
    if (!$plantsfamilys) {
      echo 'ไม่มีข้อมูล';
    } else {
      foreach ($plantsfamilys as $plantsfamily) {
  ?>
        <div class="border mb-2 m-auto p-3 col-lg-7 col-md-7 col-sm-12" style="border-radius: 10px;">
          <a href="./plantsfamilyview.php?id=<?= $plantsfamily['plantsfamily_id'] ?>" style="text-decoration: none;">วงศ์ <?= $plantsfamily['plantsfamily_name'] ?></a>
        </div>
  <?php }
    }
  }
  ?>

  <?php
  if (isset($_GET['q']) && $_GET['q'] == 'plantsgroup') {
    $stmt = $conn->query("SELECT * FROM plantsgroup ORDER BY plantsgroup_name ASC");
    $stmt->execute();
    $plantsgroups = $stmt->fetchAll();
    if (!$plantsgroups) {
      echo 'ไม่มีข้อมูล';
    } else {
      foreach ($plantsgroups as $plantsgroup) {
  ?>
        <div class="border mb-2 m-auto p-3 col-lg-7 col-md-7 col-sm-12" style="border-radius: 10px;">
          <a href="./plantsgroupview.php?id=<?= $plantsgroup['plantsgroup_id'] ?>" style="text-decoration: none;">สกุล <?= $plantsgroup['plantsgroup_name'] ?></a>
        </div>
  <?php }
    }
  }
  ?>

  <?php
  if (isset($_GET['q']) && $_GET['q'] == 'plants') {
    $stmt = $conn->query("SELECT * FROM plants ORDER BY plants_name ASC");
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
  }
  ?>

</div>



<?php include_once("./components/footer.php"); ?>