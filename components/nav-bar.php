<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1FAB89;">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <img src="./assets/images/logo.png" alt="" width="30" height="25" class="mb-1">
            Succulent Center
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./signup.php">
                                <span class="badge bg-success">ลงทะเบียนใช้งาน</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'signin') {
                                                    echo 'active';
                                                } ?>" href="./signin.php">
                                เข้าสู่ระบบ
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'index') {
                                                echo 'active';
                                            } ?>" aria-current="page" href="./index.php"><i class="fa-solid fa-house"></i> หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'category') {
                                                echo 'active';
                                            } ?>" href="./category.php?q=plantsfamily"><i class="fa-solid fa-tags"></i> สารบัญพันธุ์ไม้</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'shop') {
                                                echo 'active';
                                            } ?>" href="./shop.php"><i class="fa-solid fa-store"></i> ร้านค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'form') {
                                                echo 'active';
                                            } ?>" href="./form.php"><i class="fa-solid fa-pen-to-square"></i> จดทะเบียนพันธุ์ไม้</a>
                    </li>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <?php
                        $id = $_SESSION['user'];
                        $stmt = $conn->query("SELECT * FROM users WHERE user_id = $id");
                        $stmt->execute();
                        $user = $stmt->fetch();
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'settings') {
                                                    echo 'active';
                                                } ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-user"></i> <?= $user['user_fname']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./settings.php?q=form">พันธุ์ไม้จดทะเบียน</a></li>
                                <li><a class="dropdown-item" href="./settings.php?q=shop">ฝากร้าน</a></li>
                                <li><a class="dropdown-item" href="./settings.php?q=profile">โปรไฟล์</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php if ($_SESSION['login_level'] == 'admin') { ?>
                                    <li><a class="dropdown-item text-primary" href="./admin.php?q=manageplants"><i class="fa-solid fa-user-shield"></i> admin</a></li>
                                <?php } ?>
                                <li><a class="dropdown-item text-danger" href="./logout.php">ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <form class="d-flex" method="get" action="search.php">
                <input class="form-control me-2" name="keyword" type="search" placeholder="ค้นหา" aria-label="Search" required>
                <button class="btn btn-light" name="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</nav>