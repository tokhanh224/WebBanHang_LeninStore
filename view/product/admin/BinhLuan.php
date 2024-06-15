<?php
require_once 'view/globle/headadmin.php';
?>
<div class="row2">
    <div class="row2" id="table">
        <div class="row2 font_title">
            <h1>DANH SÁCH <?php  ?></h1>
        </div>
        <div class="row2 form_content ">
            <form action="#" method="POST">
                <div class="row2 mb10 formds_loai">
                    <table style="padding-left: 50px;">
                        <tr>
                            <th>loai hàng</th>
                            <th>số lượng bình luận</th>

                        </tr>
                        <?php foreach ($count as $c) {
                        ?>
                            <tr>
                                <th><?php echo $c['name'] ?></th>
                                <th><?php echo $c['so_luong'] ?></th>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
</div>