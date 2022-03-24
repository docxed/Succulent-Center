<?php
$user_id = $_SESSION['user'];
$nShops = $conn->query("SELECT COUNT(*) FROM shop WHERE user_id = $user_id")->fetchColumn();
?>
<h2>ฝากร้านค้าพันธุ์ไม้ <span class="badge rounded-pill" style="background-color: #1FAB89;"><?= $nShops ?></span></h2>
<hr>
<br>
<?php
if (isset($_GET['p']) && $_GET['p'] == 'shopadd') {
?>
    <div class="col-lg-6 col-md-12 col-sm-12 m-auto">
        <form action="shop_db.php" method="POST" enctype="multipart/form-data">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <div class="mb-3 form-floating">
                <input type="text" name="name" class="form-control" placeholder="ชื่อร้าน" aria-describedby="name" maxlength="150" required>
                <label for="name" class="form-label">ชื่อร้าน</label>
            </div>
            <div class="mb-3 form-floating">
                <textarea name="detail" class="form-control" style="height: 100px;" cols="30" rows="5" placeholder="รายละเอียด" aria-describedby="detail" required></textarea>
                <label for="detail" class="form-label">รายละเอียด</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="text" name="phone" class="form-control" placeholder="เบอร์ติดต่อ" aria-describedby="phone" maxlength="10" required>
                <label for="name" class="form-label">เบอร์ติดต่อ</label>
            </div>
            <label for="fulladdress" class="form-label">ที่อยู่ร้านค้า</label>
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
                <label for="img" class="form-label">รูปภาพหน้าร้าน</label>
                <input class="form-control" type="file" id="imgInput" name="img" required accept=".jpg, .jpeg, .png">
                <img id="previewImg" class=" mt-3 w-100" alt="">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">
                    ยืนยันข้อมูลถูกต้อง
                </label>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" name="add" class="btn btn-success mx-auto">ฝากร้าน</button>
            </div>
        </form>
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
    </div>
<?php
} else if (isset($_GET['q']) && $_GET['q'] == 'shop') {
?>
    <div>
        <div class="text-end mb-3"><a href="./settings.php?q=shop&p=shopadd"><button class="btn btn-success">เพิ่มร้าน</button></a></div>
        <?php
        $stmt = $conn->query("SELECT * FROM shop WHERE user_id = $user_id ORDER BY shop_id DESC");
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
                            <div class="h5 my-3 mx-3 text-center">
                                <a href="./shopview.php?id=<?= $shop['shop_id'] ?>" style="text-decoration: none;"><?= $shop['shop_name'] ?></a>
                            </div>
                            <div class="text-end mx-2">
                                <a data-id="<?= $shop['shop_id']; ?>" href="./shop_db.php?delete=<?= $shop['shop_id']; ?>" class="btn btn-sm btn-outline-danger delete-btn">ลบ</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php
        }
        ?>
    </div>
    <script>
        $(".delete-btn").click(function(e) {
            var id = $(this).data('id');
            e.preventDefault();
            deleteConfirm(id);
        })

        function deleteConfirm(id) {
            Swal.fire({
                title: "คุณแน่ใจใช่ไหม",
                text: "ข้อมูลนี้จะถูกลบโดยถาวร",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'shop_db.php',
                                type: 'GET',
                                data: 'delete=' + id,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'ลบข้อมูลแล้ว',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'settings.php?q=shop';
                                })
                            })
                            .fail(function() {
                                Swal.fire('อุ๊ปส์', 'เกิดข้อผิดพลาดบางสิ่งกับ ajax', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>
<?php
}
?>