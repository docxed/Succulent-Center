<br><br>
<div>
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
                        <img src="<?= $shop['shop_img']; ?>" alt="" style="width: 100%; height: 230px; border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover;">
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
                                document.location.href = 'admin.php?q=manageshop';
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