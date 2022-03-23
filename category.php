<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>

  <div class="container my-5">
    <h2>สารบัญพันธุ์ไม้</h2>
    <hr>
    <br>
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link" href="./category.php?q=plantsfamily">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Active</a>
      </li>
    </ul>
  </div>

<?php include_once("./components/footer.php"); ?>