<?php session_start(); ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<script>
    function deg2rad(deg) {
        return deg * (Math.PI / 180)
    }

    function getDistanceFromLatLonInKm(lat1, lng1, lat2, lng2) {
        let R = 6371 // รัศมีของโลกกม.
        let dLat = this.deg2rad(lat2 - lat1) // ดีกรี -> เรเดียน
        let dLng = this.deg2rad(lng2 - lng1)
        let a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(this.deg2rad(lat1)) *
            Math.cos(this.deg2rad(lat2)) *
            Math.sin(dLng / 2) *
            Math.sin(dLng / 2)
        let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))
        let d = R * c // ระยะทางกม.
        return d
    }

    function getKM(lat, lng, id) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                let currPosLat = position.coords.latitude
                let currPosLng = position.coords.longitude
                document.getElementById(id).innerHTML = getDistanceFromLatLonInKm(currPosLat, currPosLng, lat, lng).toFixed(1).toLocaleString() + "กม."
            })
        } else {
            Swal.fire({
                title: "Your browser does not support Geolocation",
                icon: "error",
                timer: 5000,
                showConfirmButton: false,
            })
        }
    }
</script>
<div>
    <br><br>
    <div class="container">
        <h2>ร้านค้า</h2>
        <hr>
        <?php
        $stmt = $conn->query("SELECT * FROM shop ORDER BY shop_id DESC");
        $stmt->execute();
        $shops = $stmt->fetchAll();
        if (!$shops) {
            echo '<p class="h4 text-center mt-5">ยังไม่มีรายการฝากร้าน</p>';
        } else {
        ?>
            <div class="row">
                <?php foreach ($shops as $shop) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                        <div class="border m-auto pb-3 h-100" style="border-radius: 10px;">
                            <img src="<?= "uploads/shop/" . $shop['shop_img']; ?>" alt="" style="width: 100%; height: 230px; border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover;">
                            <div class="text-end text-secondary h6 mt-3 mx-2" id="km<?= $shop['shop_id'] ?>">
                                <script>
                                    getKM(<?= $shop['shop_lat'] ?>, <?= $shop['shop_lng'] ?>, 'km<?= $shop['shop_id'] ?>')
                                </script>
                            </div>
                            <div class="h5 mb-3 mx-3 text-center">
                                <a href="./shopview.php?id=<?= $shop['shop_id'] ?>" style="text-decoration: none;"><?= $shop['shop_name'] ?></a>
                            </div>
                            
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