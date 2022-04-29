<ul class="nav nav-pills nav-fill">
    <?php if (isset($_GET['q'])) { ?>
        <?php
        $nPlants = $conn->query('SELECT COUNT(*) FROM plants')->fetchColumn();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($_GET['q'] == 'manageplants') {
                                    echo 'active';
                                } ?>" href="admin.php?q=manageplants"><i class="fa-solid fa-3"></i> พันธุ์ไม้ <span class="badge badge-sm rounded-pill text-dark bg-light"><?= $nPlants; ?></span></a>
        </li>
        <?php
        $nPlantsgroup = $conn->query('SELECT COUNT(*) FROM plantsgroup')->fetchColumn();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($_GET['q'] == 'manageplantsgroup') {
                                    echo 'active';
                                } ?>" href="admin.php?q=manageplantsgroup"><i class="fa-solid fa-2"></i> สกุล <span class="badge badge-sm rounded-pill text-dark bg-light"><?= $nPlantsgroup; ?></span></a>
        </li>
        <?php
        $nPlantsfamily = $conn->query('SELECT COUNT(*) FROM plantsfamily')->fetchColumn();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($_GET['q'] == 'manageplantsfamily') {
                                    echo 'active';
                                } ?>" href="admin.php?q=manageplantsfamily"><i class="fa-solid fa-1"></i></i> วงศ์ <span class="badge badge-sm rounded-pill text-dark bg-light"><?= $nPlantsfamily; ?></span></a>
        </li>
        <?php
        $nPlantsform = $conn->query('SELECT COUNT(*) FROM plantsform')->fetchColumn();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($_GET['q'] == 'manageplantsform') {
                                    echo 'active';
                                } ?>" href="admin.php?q=manageplantsform"><i class="fa-solid fa-pen-to-square"></i> พันธุ์ไม้จดทะเบียน <span class="badge badge-sm rounded-pill text-dark bg-light"><?= $nPlantsform; ?></span></a>
        </li>
        <?php
        $nShop = $conn->query('SELECT COUNT(*) FROM shop')->fetchColumn();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($_GET['q'] == 'manageshop') {
                                    echo 'active';
                                } ?>" href="admin.php?q=manageshop"><i class="fa-solid fa-store"></i> ร้านค้า <span class="badge badge-sm rounded-pill text-dark bg-light"><?= $nShop; ?></span></a>
        </li>
        <?php
        $nUsers = $conn->query('SELECT COUNT(*) FROM users')->fetchColumn();
        ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($_GET['q'] == 'manageusers') {
                                    echo 'active';
                                } ?>" href="admin.php?q=manageusers"><i class="fa-solid fa-user"></i> ผู้ใช้ <span class="badge badge-sm rounded-pill text-dark bg-light"><?= $nUsers; ?></span></a>
        </li>
    <?php } ?>
</ul>