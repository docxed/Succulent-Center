<h2>โปรไฟล์</h2>
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
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" name="email" class="form-control" value="<?= $user['user_email']; ?>" placeholder="อีเมล" aria-describedby="email" maxlength="50" readonly>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label for="fname" class="form-label">ชื่อ</label>
                <input type="text" name="fname" class="form-control" value="<?= $user['user_fname']; ?>" placeholder="ชื่อ" aria-describedby="fname" maxlength="50" required>
            </div>
            <div class="col">
                <label for="lname" class="form-label">นามสกุล</label>
                <input type="text" name="lname" class="form-control" value="<?= $user['user_lname']; ?>" placeholder="นามสกุล" aria-describedby="lname" maxlength="50" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
            <input type="text" name="idcard" class="form-control" value="<?= $user['user_idcard']; ?>" placeholder="เลขบัตรประชาชน 13 หลัก" aria-describedby="idcard" maxlength="13" pattern="[0-9]+" readonly>
        </div>
        <input type="hidden" name="id" value="<?= $_SESSION['user']; ?>">
        <div class="mb-3 text-center">
            <button type="submit" name="edit" class="btn btn-info mx-auto">อัปเดตข้อมูล</button>
        </div>
        <div class="text-center">
            <p>เปลี่ยนรหัสผ่าน <a href="./settings.php?q=changepassword">คลิกที่นี่</a></p>
        </div>
    </form>
</div>