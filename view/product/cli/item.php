<?php
require_once 'view/globle/head.php';
?>
<div class="thongtin">
  <div class="sp">
    <?php
    foreach ($sanpham as $s) {
      ?>
      <div class="img">
        <img src="assets/imgs/item/<?php echo $s->image ?>" alt="loi" />
      </div>
      <div class="tt">
        <h3>Name:
          <?php echo $s->name ?>
        </h3>
        <h4>Giá:
          <?php echo $s->price ?>
        </h4>
        <p>Mô tả:
          <?php echo $s->chitiet ?>
        </p>
        <button class="mua">Mua Hàng</button>
      </div>
    <?php } ?>
  </div>
  <div class="bl">
    <?php
    if (isset($comments) && is_array($comments) && $comments != "") {
      foreach ($comments as $comment) {

        ?>
        <div class="showcomment">
          <div class="inf">
            <img class="imgbl" src="assets/imgs/user.png" alt="" />
            <div class="text">
              <p class="time" style="margin: 0">
                <?php $i = 1;
                foreach ($comment as $c) {

                  if (strtotime($c)) {
                    $i += 1; // Kiểm tra nếu giá trị có thể chuyển đổi thành ngày tháng
                    $day = $c;

                    echo $day;
                    // Kết thúc vòng lặp nếu đã tìm thấy ngày tháng
                  }
                } ?>
              </p>
              <h4 style="margin: 0">
                <?php echo $comment->name_user ?>
              </h4>
            </div>
          </div>
          <div class="context">
            <textarea name="" id="" cols="100" rows="5" readonly>
                            <?php echo $comment->text ?>
                     </textarea>
          </div>
        </div>
        <?php
      }
    } else {
      echo "Trống";
    }
    ?>
    <div class="comment">
      <form action="index.php?controller=product&act=bl" method="post">
        <label for="bl">Bình luận:</label> <br />
        <textarea name="bl" id="bl" cols="30" rows="10"></textarea>
        <input type="hidden" name="time" id="time" value="<?php echo $timestamp ?>" />
        <?php
        foreach ($sanpham as $s) {
          ?>
          <input type="hidden" name="id_pro" id="" value="<?php echo $s->id ?>">
          <input type="hidden" name="iddm" id="" value="<?php echo $s->danhmuc ?>">
        <?php } ?>
        <input type="submit" value="Gửi" />
      </form>
    </div>
  </div>
  <div class="lq">
    <?php
    if (isset($products) && is_array($products)) {
      foreach ($products as $product) {
        ?>
        <div class="itemlq">
          <img src="assets/imgs/item/<?php echo $product->image ?>" alt="loi" />
          <div class="cont" width="100%">
            <h4>
              <?php echo $product->name; ?>
            </h4>
            <h5 style="color: red;">
              <?php echo $product->price; ?>
            </h5>
          </div>
        </div>
        <?php
      }
    } else {
      echo "Trống";
    }
    ?>
  </div>
</div>
<script>

</script>
<?php require_once 'view/globle/footer.php';