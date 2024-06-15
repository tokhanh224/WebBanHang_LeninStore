<?php
require_once 'view/globle/head.php';
require_once 'view/globle/slideshow.php';
?>
<link rel="stylesheet" href="view/home/style.css">
<div class="product-tabs section-padding">
    <div class="bg-square"></div>
    <!-- template section start -->
    <div class="template_section layout_padding">
        <div class="container">
            <h1 class="solution_text">NHỮNG MÓN QUÀ ĐẦY CẢM XÚC</h1>
            <div class="carousel-inner d-flex" style="gap: 1.5rem;">
                <?php
                if (isset($productTop3) && is_array($productTop3)) {
                    foreach ($productTop3 as $product) {
                        ?>
                        <div class="carousel-item active hover-effect">
                            <div class="row">
                                <div class="col">
                                    <a href="index.php?controller=sanPham_view&id=<?php echo $product["id_pro"]; ?>">
                                        <div class="image_5">
                                            <img src="assets/imgs/item/<?php echo $product["img"]; ?>" class="img-fluid">
                                        </div>
                                    </a>
                                </div>
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
    </div>
    <!-- template section end -->
    <!-- design section start -->
    <div class="design_section layout_padding">
        <div class="container">
            <h1 class="solution_text" style="text-align: left;">Bán chạy nhất</h1>
        </div>
    </div>
    <!-- design section end -->
    <div class="container">
        <div class="row" style="gap: 2.0rem;">
            <?php
            if (isset($products) && is_array($products)) {
                foreach ($products as $product) {
                    ?>
                    <div class="card col p-0 product-card" style="border-style: none;">
                        <a href="index.php?controller=sanPham_view&id=<?php echo $product->id_pro; ?>">
                            <img src="assets/imgs/item/<?php echo $product->image ?>" class="card-img-top product-img"
                                alt="...">
                            <div class="overlay">
                                <div class="overlay-content">
                                    <h5 class="card-title"
                                        style="color: #000000;font-size: 18px;font-weight: 500; text-align: center;">
                                        <?php echo $product->name; ?>
                                    </h5>
                                    <p class="card-text m-0">
                                        <?php echo $product->price; ?>.000 VND
                                    </p>
                                    <!-- <p class="card-text">Lượt xem -->
                                        <!-- <?php echo $product->luotxem; ?> -->
                                    </p>
                                </div>
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
    </div>
</div>
</div>
</div>
<?php require_once 'view/globle/footer.php'; ?>