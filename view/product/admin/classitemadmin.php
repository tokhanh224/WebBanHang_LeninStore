<?php
require_once 'view/globle/headadmin.php';
?>
<div class="row2">
    <div id="add" style="display: block">
        <div class="row2 font_title">
            <h1>THÊM MỚI LOẠI HÀNG HÓA</h1>
        </div>
        <div class="row2 form_content ">
            <form action="index.php?controller=danhmuc" method="POST">
                <div class="row2 mb10">
                    <label>Tên loại </label> <br>
                    <input type="text" name="tenloai" placeholder="nhập vào tên">
                </div>
                <div class="row mb10 ">
                    <input class="mr20" type="submit" value="THÊM MỚI">
                    <input class="mr20" type="reset" value="NHẬP LẠI">
                </div>
            </form>
            <button onclick="show()">Danh Sách</button>
        </div>
    </div>
    <div id="fix" style="display: none">
        <div class="row2 font_title">
            <h1>Sửa LOẠI HÀNG HÓA</h1>
        </div>
        <div class="row2 form_content ">
            <form action="index.php?controller=danhmuc" method="POST">
                <div class="row2 mb10">
                    <label>Id loại </label> <br>
                    <input type="text" name="id_l" id="id_l">
                </div>
                <div class="row2 mb10">
                    <label>Tên loại </label> <br>
                    <input type="text" name="tenmoi" id="ten_l">
                </div>
                <div class="row mb10 ">
                    <input class="mr20" type="submit" value="Sửa">
                    <input class="mr20" type="button" onclick="ext()" value="Huỷ">
                </div>
            </form>
        </div>
    </div>
    <div class="row2" id="table" style="display: none">
        <div class="row2 font_title">
            <h1>DANH SÁCH <?php  ?></h1>
        </div>
        <div class="row2 form_content ">
            <form action="index.php?controller=danhmuc" method="POST">
                <div class="row2 mb10 formds_loai">
                    <table>
                        <tr>
                            <th>checkbox</th>
                            <th>MÃ LOẠI</th>
                            <th>TÊN LOẠI</th>
                            <th>control</th>
                        </tr>

                        <?php
                        if (isset($danhmucs) && is_array($danhmucs)) {
                            foreach ($danhmucs as $danhmuc) {
                        ?>
                        <tr>
                            <th><input type="checkbox" name="xoa[]" id="" value="<?php echo $danhmuc->id_d; ?>"></td>
                            <th><?php echo $danhmuc->id_d; ?></th>
                            <th><?php echo $danhmuc->name; ?></th>
                            <th><input type="button" onclick="fix(event)" id="<?php echo $danhmuc->id_d; ?>"
                                    value="Sửa">
                                <input type="submit" value="Xóa"> <input type="hidden" name="id"
                                    value="<?php echo $danhmuc->id_d; ?>">
                            </th>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "Trống";
                        } ?>

                    </table>
                </div>
                <div class="row mb10 ">
                    <input class="mr20" type="button" value="CHỌN TẤT CẢ" onclick="selectAll()">
                    <input class="mr20" type="button" value="BỎ CHỌN TẤT CẢ" onclick="deselectAll()">
                    <input class="mr20" type="submit" value="XOÁ TẤT CẢ" ">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
<?php
$Date = json_encode($danhmucs);
?>

function ext() {
    document.getElementById('fix').style.display = " none"; document.getElementById('add').style.display="block" ; }
                        function fix(event) { var data=<?php echo $Date; ?>; data.forEach((element)=> {
                    if (element.id_d == event.target.id) {
                    document.getElementById('id_l').value = element.id_d;
                    document.getElementById('ten_l').value = element.name;
                    document.getElementById('add').style.display = "none";
                    document.getElementById('fix').style.display = "block";
                    }
                    });
                    }

                    function show() {
                    document.getElementById("table").style.display = "block";
                    }

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