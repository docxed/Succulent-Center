<?php session_start(); ?>
<?php
if (isset($_SESSION['user'])) {
    header("location: index.php");
}
?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div>
    <br><br>
    <div class="container">
        <h2>ลงทะเบียนเข้าใช้งาน</h2>
        <hr>
        <br>
        <div class="col-lg-6 col-12 m-auto">
            <form action="signup_db.php" method="post">
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['warning'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                        ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" name="email" class="form-control" placeholder="อีเมล" aria-describedby="email" maxlength="50" required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col">
                        <label for="fname" class="form-label">ชื่อ</label>
                        <input type="text" name="fname" class="form-control" placeholder="ชื่อ" aria-describedby="fname" maxlength="50" required>
                    </div>
                    <div class="col">
                        <label for="lname" class="form-label">นามสกุล</label>
                        <input type="text" name="lname" class="form-control" placeholder="นามสกุล" aria-describedby="lname" maxlength="50" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
                    <input type="text" name="idcard" class="form-control" placeholder="เลขบัตรประชาชน 13 หลัก" aria-describedby="idcard" maxlength="13" pattern="[0-9]+" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
                </div>
                <div class="mb-3">
                    <label for="c_password" class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="c_password" class="form-control" placeholder="ยืนยันรหัสผ่าน" maxlength="20" required>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" name="signup" class="btn btn-success mx-auto">ลงทะเบียนใช้งาน</button>
                </div>
                <div class="text-center">
                    <p>เป็นสมาชิกแล้วใช่ไหม คลิกที่นี่เพื่อ <a href="./signin.php">เข้าสู่ระบบ</a></p>
                </div>
            </form>
        </div>
    </div>
    <br><br>
</div>
<?php include_once("./components/footer.php"); ?>