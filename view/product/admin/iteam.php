<?php
require_once 'view/globle/headadmin.php';
?>
<div class="row2">
    <div id="fom">
        <div class="row2 font_title">
            <h1>THÊM MỚI SẢN PHẨM</h1>
        </div>
        <div class="row2 form_content ">
            <form action="index.php?controller=product&&act=add" method="POST" enctype="multipart/form-data">
                <div class="row2 mb10 form_content_container">
                    <label> Loại </label> <br>
                    <select name="iddm" id="" style="width: 100%; height: 30px; border: 1px solid gray ;">
                        <?php
                        if (isset($danhmucs) && is_array($danhmucs)) {
                            foreach ($danhmucs as $danhmuc) {
                        ?>
                        <option value="<?php echo $danhmuc->id_d; ?>"><?php echo $danhmuc->name; ?></option>
                        <?php
                            }
                        } else { ?>
                        <option value=""><?php echo "Trống";; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row2 mb10">
                    <label>Tên sp </label> <br>
                    <input type="text" name="tensanpam" placeholder="nhập vào tên">
                </div>
                <div class="row2 mb10">
                    <label>ảnh </label> <br>
                    <input type="file" name="img" placeholder="chọn ảnh" style="width: 100%; height: 30px;">
                </div>
                <div class="row2 mb10">
                    <label>giá </label> <br>
                    <input type="number" name="gia" placeholder="nhập giá" min="0"
                        style="width: 100%; height: 30px; border: 1px solid gray ;">
                </div>
                <div class="row2 mb10">
                    <label>mota</label> <br>
                    <textarea name="mota" id="" cols="30" rows="10" placeholder="nhập mô tả"
                        style="width: 100%; height: 100px; border: 1px solid gray ;"></textarea>
                </div>
                <div class=" row mb10 ">
                    <input class=" mr20" type="submit" name="add" value="THÊM MỚI">
                    <input class="mr20" type="reset" value="NHẬP LẠI">
                </div>
            </form>
        </div>
    </div>
    <div id="fomfix" style="display: none;">
        <div class="row2 font_title">
            <h1>SỬA SẢN PHẨM</h1>
        </div>
        <div class="row2 form_content ">
            <form action="index.php?controller=product&&act=fix" method="POST" enctype="multipart/form-data">
                <div class="row2 mb10 form_content_container">
                    <label> Loại </label> <br>
                    <select name="iddm" id="" style="width: 100%; height: 30px; border: 1px solid gray ;">
                        <option value="" id='iddm'></option>
                        <?php
                        if (isset($danhmucs) && is_array($danhmucs)) {
                            foreach ($danhmucs as $danhmuc) {
                        ?>
                        <option value="<?php echo $danhmuc->id_d; ?>"><?php echo $danhmuc->name; ?></option>
                        <?php
                            }
                        } else { ?>
                        <option value=""><?php echo "Trống";; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="row2 mb10">
                    <label>id sp </label> <br>
                    <input type="text" id="idsp" name="idsp" placeholder="nhập id">
                </div>
                <div class="row2 mb10">
                    <label>Tên sp </label> <br>
                    <input type="text" id="tensp" name="tensanpam" placeholder="nhập vào tên">
                </div>
                <div class="row2 mb10">
                    <label>ảnh </label> <br>
                    <input type="file" name="img" id="fileInput" placeholder="chọn ảnh"
                        style="width: 100%; height: 30px;">
                    <img src="" id="img" alt="img" width="20%">
                </div>
                <div class="row2 mb10">
                    <label>giá </label> <br>
                    <input type="number" id="gia" name="gia" placeholder="nhập giá" min="0"
                        style="width: 100%; height: 30px; border: 1px solid gray ;">
                </div>
                <div class="row2 mb10">
                    <label>mota</label> <br>
                    <textarea name="mota" id="mota" cols="30" rows="10" placeholder="nhập mô tả"
                        style="width: 100%; height: 100px; border: 1px solid gray ;"></textarea>
                </div>
                <div class=" row mb10 ">
                    <input class=" mr20" type="submit" name="fix" value="Sửa">
                    <input class="mr20" type="button" onclick="ext()" value=" Huỷ">
                </div>
            </form>
        </div>
    </div>
    <button onclick="show()" id="so">Danh Sách</button>
    <div class="row2" id="table" style="display: none">
        <div class="row2 font_title">
            <h1>DANH SÁCH <?php  ?></h1>
        </div>
        <div class="row2 form_content ">
            <form action="index.php?controller=product&&act=delete" method="POST">
                <div class="row2 mb10 formds_loai">
                    <table>
                        <tr>
                            <th></th>
                            <th>MÃ SP</th>
                            <th>IMG</th>
                            <th>TEN SP</th>
                            <th>GIÁ</th>
                            <th>MO TA</th>
                            <th>LUOT XEM</th>
                            <th>LOAI HANG</th>
                            <TH>CONTROL</TH>
                        </tr>
                        <?php
                        if (isset($sanphams) && is_array($sanphams)) {
                            foreach ($sanphams as $sanpham) {
                        ?>
                        <tr>
                            <th><input type="checkbox" name="xoa[]" id="" value="<?php echo $sanpham->id_pro; ?>"></td>
                            <th><?php echo $sanpham->id_pro; ?></th>
                            <th width="20%"><img src="assets/imgs/item/<?php echo $sanpham->image ?>" alt="img"
                                    width="10%"></th>
                            <td><?php echo $sanpham->name; ?></td>
                            <th><?php echo $sanpham->price; ?></th>
                            <td><?php echo $sanpham->chitiet; ?></td>
                            <th><?php echo $sanpham->luotxem; ?></th>
                            <th><?php echo $sanpham->danhmuc; ?></th>
                            <th><input type="button" onclick="fix(event)" id="<?php echo $sanpham->id_pro; ?>" value="Sửa">
                                <input type="submit" value="Xóa"> <input type="hidden" name="id_x"
                                    value="<?php echo $sanpham->id_pro; ?>">
                            </th>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "Trống";
                        } ?>
                    </table>
                    <?php
                    // Tính toán tổng số trang
                    $totalProducts = $counts['total'];
                    $totalPages = ceil($totalProducts / 5);

                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<button><a href='index.php?controller=sanpham&&page=$i'> $i</a></button>";
                    }
                    ?>
                </div>
                <div class="row mb10 ">
                    <input class="mr20" type="button" value="CHỌN TẤT CẢ" onclick="selectAll()">
                    <input class="mr20" type="button" value="BỎ CHỌN TẤT CẢ" onclick="deselectAll()">
                    <input class="mr20" type="submit" value="XOÁ TẤT CẢ">
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>
    console.log('Data:', <?php echo json_encode($sanphams); ?>);
console.log('Category Data:', <?php echo json_encode($danhmucs); ?>);

a = true
<?php
    $Date = json_encode($sanphams);
    $Date_m = json_encode($danhmucs);
    ?>

function show() {
    if (a) {
        document.getElementById("table").style.display = "block";
        document.getElementById("fom").style.display = "none";
        document.getElementById("so").innerHTML = 'quay lại';
        a = false;
    } else {
        document.getElementById("table").style.display = "none";
        document.getElementById("fom").style.display = "block";
        document.getElementById("so").innerHTML = 'danh sách';
        a = true;
    }
}

function ext() {
    document.getElementById('fomfix').style.display = "none";
    document.getElementById('table').style.display = "block";
    document.getElementById('so').style.display = "block";
}

function fix(event) {
    console.log('Fix function called. Event ID:', event.target.id);

    var data = <?php echo $Date; ?>;
    var data_m = <?php echo $Date_m; ?>;
    var targetId = parseInt(event.target.id);

    data.forEach((element) => {
        console.log(targetId, element);
        if (element.id_pro === targetId) {
            data_m.forEach((e) => {
                if (element.danhmuc === e.name) {
                    document.getElementById('iddm').value = e.id_d;
                    document.getElementById('iddm').innerHTML = e.name;
                }
            });

            document.getElementById('table').style.display = "none";
            document.getElementById('so').style.display = "none";
            document.getElementById('fomfix').style.display = "block";
            document.getElementById('idsp').value = element.id_pro;
            document.getElementById('tensp').value = element.name;
            document.getElementById('img').src = "assets/imgs/item/" + element.image;
            document.getElementById('gia').value = element.price;
            document.getElementById('mota').value = element.chitiet;
        }
    });
}

const fileInput = document.getElementById('fileInput');
fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];

    // Kiểm tra xem có tệp được chọn không
    if (file) {
        // Sử dụng URL.createObjectURL để hiển thị tệp ảnh đã chọn
        document.getElementById('img').src = URL.createObjectURL(file);
    }
});


function selectAll() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = true;
    });
}

// Hàm để bỏ chọn tất cả các ô checkbox
function deselectAll() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
}
</script>