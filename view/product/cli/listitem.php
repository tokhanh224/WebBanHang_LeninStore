<?php
require_once 'view/globle/head.php';
?>
<!-- <link rel="stylesheet" href="view/product/cli/style2.css"> -->
<link rel="stylesheet" href="view/product/cli/style2.css">
<div class="row justify-content-between" style="gap: 1.5rem; max-width: 200%;">
  <?php
  if (is_array($products)) {
    foreach ($products as $product) {
      ?>
      <div class="card col-2 p-0 product-card" style="border-style: none;">
        <a href="index.php?controller=sanPham_view&id=<?php echo $product->id_pro; ?>"
          style="text-decoration: none; color: inherit;" class="product-link">
          <img src="assets/imgs/item/<?php echo $product->image ?>" class="card-img-top" alt="product">
          <div class="product-details">
            <h5 class="card-title" style="color: #000000;font-size: 18px;font-weight: 500; text-align: center;">
              <?php echo $product->name; ?>
            </h5>
            <p class="card-text m-0">
              <?php echo $product->price; ?>.000 VND
            </p>
            <!-- <p class="card-text">Lượt xem: -->
              <!-- <?php echo $product->luotxem; ?> -->
            </p>
          </div>
        </a>
      </div>
      <?php
    }
  } else {
    echo "Trống";
  }
  ?>
</div>

<?php require_once 'view/globle/footer.php';
