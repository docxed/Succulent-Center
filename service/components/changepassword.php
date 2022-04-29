<h2>เปลี่ยนรหัสผ่าน</h2>
<hr>
<br>
<div class="col-lg-6 col-12 m-auto">
    <form action="user_db.php" method="post">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="o_password" class="form-label">รหัสผ่านเดิม</label>
            <input type="password" name="o_password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่านใหม่</label>
            <input type="password" name="password" class="form-control" placeholder="รหัสผ่านใหม่" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="c_password" class="form-label">ยืนยันรหัสผ่านใหม่</label>
            <input type="password" name="c_password" class="form-control" placeholder="ยืนยันรหัสผ่านใหม่" maxlength="20" required>
        </div>
        <input type="hidden" name="id" value="<?= $_SESSION['user']; ?>">
        <div class="mb-3 text-center">
            <button type="submit" name="changepassword" class="btn btn-warning mx-auto">เปลี่ยนรหัสผ่าน</button>
        </div>
        <div class="text-center">
            <p>ย้อนกลับโปรไฟล์ <a href="./settings.php?q=profile">คลิกที่นี่</a></p>
        </div>
    </form>
</div>