<?php session_start(); ?>
<?php include_once("./middlewares/isLoggedin.php") ?>
<?php include_once("./config/db.php"); ?>
<?php include_once("./components/head.php"); ?>
<?php include_once("./components/nav-bar.php"); ?>
<div>
    <br><br>
    <div class="container my-5">
        <h2>ฟอร์มจดทะเบียนพรรณไม้</h2>
        <hr>
        <br>
        <div class="col-lg-6 col-md-12 col-sm-12 m-auto">
            <form action="plantsform_db.php" method="post" enctype="multipart/form-data">
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="plantsfamily_name" class="form-label">เลือกวงศ์</label>
                    <select name="plantsfamily_name" class="form-select" required id="family">
                        <?php
                        $stmt = $conn->query("SELECT * FROM plantsfamily");
                        $stmt->execute();
                        $plantsfamilys = $stmt->fetchAll();
                        if (!$plantsfamilys) {
                            echo '<option disabled>ไม่มีวงศ์</option>';
                        } else {
                            foreach ($plantsfamilys as $plantsfamily) { ?>
                                <option <?php if (!isset($_GET['plantsfamily_name'])) {
                                            echo 'selected';
                                        } ?> disabled hidden> -- เลือกวงศ์ -- </option>
                                <option value="<?= $plantsfamily['plantsfamily_name']; ?>" <?php if (isset($_GET['plantsfamily_name']) && $plantsfamily['plantsfamily_name'] == $_GET['plantsfamily_name']) {
                                                                                                echo 'selected';
                                                                                            } ?>>วงศ์ <?= $plantsfamily['plantsfamily_name']; ?></option>
                        <?php }
                        }
                        ?>
                    </select>
                </div>
                <?php
                if (isset($_GET['plantsfamily_name'])) { ?>
                    <div class="mb-3">
                        <label for="plantsgroup_name" class="form-label">เลือกสกุล</label>
                        <select name="plantsgroup_name" class="form-select" required>
                            <?php
                            $plantsfamilyName = $_GET['plantsfamily_name'];
                            $stmt = $conn->query("SELECT * FROM plantsgroup WHERE plantsfamily_name = '$plantsfamilyName'");
                            $stmt->execute();
                            $plantsgroups = $stmt->fetchAll();
                            if (!$plantsgroups) {
                                echo '<option disabled>ไม่มีสกุล</option>';
                            } else {
                                foreach ($plantsgroups as $plantsgroup) { ?>
                                    <option value="<?= $plantsgroup['plantsgroup_name']; ?>">สกุล <?= $plantsgroup['plantsgroup_name']; ?></option>
                            <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="name" class="form-control" placeholder="ชื่อพันธุ์ไม้จดทะเบียน" aria-describedby="name" maxlength="150" required>
                        <label for="name" class="form-label">ชื่อพันธุ์ไม้จดทะเบียน</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="namemarket" class="form-control" placeholder="ชื่อทางการตลาดพันธุ์ไม้จดทะเบียน" maxlength="150" aria-describedby="namemarket" required>
                        <label for="namemarket" class="form-label">ชื่อทางการตลาดพันธุ์ไม้จดทะเบียน (ไม่มีใส่ -)</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea name="detail" class="form-control" style="height: 100px;" cols="30" rows="5" placeholder="รายละเอียด" aria-describedby="detail" required></textarea>
                        <label for="detail" class="form-label">คำอธิบายเกี่ยวกับพรรณไม้ที่ผลิตได้</label>
                    </div>
                    <label for="fulladdress" class="form-label">ระแวกที่อยู่ในการตรวจสอบพันธุ์ไม้</label>
                    <div class="input-group mb-3">

                        <input type="text" name="fulladdress" class="form-control" placeholder="ป้อนที่อยู่เพื่อค้นหา" aria-describedby="button-addon2" id="autocomplete" required />
                        <button onclick="locatorButtonPressed()" class="btn btn-outline-danger" type="button" id="button-addon2">
                            <i class="fa-solid fa-location-crosshairs"></i>
                        </button>
                    </div>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user'] ?>">
                    <div id="map" class="m-auto my-5 w-100"></div>
                    <div class="mb-3">
                        <label for="img" class="form-label">รูปภาพประกอบ</label>
                        <input class="form-control" type="file" id="imgInput" name="img" required accept=".jpg, .jpeg, .png">
                        <img id="previewImg" class=" mt-3 w-100" alt="">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault">
                            ยืนยันข้อมูลถูกต้อง เมื่อยืนยันทำรายการแล้วจะไม่สามารถยกเลิกได้
                        </label>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" name="add" class="btn btn-success mx-auto">จดทะเบียน</button>
                    </div>
                    <script>
                        let imgInput = document.getElementById("imgInput")
                        let previewImg = document.getElementById("previewImg")

                        imgInput.onchange = evt => {
                            const [file] = imgInput.files
                            if (file) {
                                previewImg.src = URL.createObjectURL(file)
                            }
                        }

                        function getAddressFrom(lat, lng) {
                            fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${'AIzaSyALC4_1XPkHu7nZ82vQ0Uv1F5ZtGpJJe4M'}&region=TH&language=th`)
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById('autocomplete').value = data.results[0].formatted_address
                                    document.getElementById('lat').value = lat
                                    document.getElementById('lng').value = lng
                                });
                        }

                        function locatorButtonPressed() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition((position) => {
                                    this.getAddressFrom(
                                        position.coords.latitude,
                                        position.coords.longitude
                                    )
                                    this.showUserLocationOnTheMap(
                                        position.coords.latitude,
                                        position.coords.longitude
                                    )
                                })
                            } else {
                                console.log("Your browser does not support Geolocation")
                            }
                        }

                        function showUserLocationOnTheMap(lat, lng) {
                            let map = new google.maps.Map(document.getElementById("map"), {
                                zoom: 15,
                                center: new google.maps.LatLng(lat, lng),
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                            })
                            new google.maps.Marker({
                                position: new google.maps.LatLng(lat, lng),
                                map: map,
                            })
                        }
                        let autocomplete = new google.maps.places.Autocomplete(
                            document.getElementById("autocomplete"), {
                                bounds: new google.maps.LatLngBounds(
                                    new google.maps.LatLng(13.736717, 100.523186)
                                ),
                            }
                        )
                        autocomplete.addListener("place_changed", () => {
                            let place = autocomplete.getPlace()
                            document.getElementById('lat').value = place.geometry.location.lat()
                            document.getElementById('lng').value = place.geometry.location.lng()
                            showUserLocationOnTheMap(
                                place.geometry.location.lat(),
                                place.geometry.location.lng()
                            )
                        })
                    </script>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#family").change(function() {
            window.location = './form.php?plantsfamily_name=' + this.value
        });
    });
</script>
<?php include_once("./components/footer.php"); ?>