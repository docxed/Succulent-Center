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
        <h2>ลงชื่อเข้าใช้งาน</h2>
        <hr>
        <br>
        <div class="col-lg-6 col-12 m-auto">
            <form action="signin_db.php" method="post">
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" name="email" class="form-control" placeholder="อีเมล" aria-describedby="email" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" name="signin" class="btn btn-primary mx-auto">เข้าสู่ระบบ</button>
                </div>
                <div class="text-center">
                    <p>ไม่ได้เป็นสมาชิกใช่ไหม คลิกที่นี่เพื่อ <a href="./signup.php">ลงทะเบียน</a></p>
                </div>
            </form>
        </div>
    </div>
    <br><br>
    <?php
    if (isset($_SESSION['alert_login'])) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'โปรดลงชื่อเข้าสู่ระบบ',
                icon: 'warning',
                showConfirmButton: true
            });
        });
        </script>";
        unset($_SESSION['alert_login']);
    }
    ?>
</div>
<?php include_once("./components/footer.php"); ?>