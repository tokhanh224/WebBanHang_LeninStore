<?php require_once 'view/globle/head.php'; ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buy_all"])) {
        // Get the selected product IDs and their quantities
        $selectedProducts = isset($_POST['selected_products']) ? $_POST['selected_products'] : [];
        $selectedQuantities = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : [];

        if (!empty($selectedProducts)) {
            // Fetch selected products from the database
            $placeholders = implode(",", array_fill(0, count($selectedProducts), "?"));
            $query = $conn->prepare("SELECT * FROM giohang WHERE product_id IN ($placeholders)");
            $query->execute($selectedProducts);
            $selectedItems = $query->fetchAll(PDO::FETCH_ASSOC);

            // Get the total price from the form submission
            $totalPrice = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0;
        } else {
            echo "Không có sản phẩm nào được chọn!";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<div class="container mt-5">
    <?php if (!empty($selectedItems)): ?>
        <h2>Thông tin đơn hàng</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Tên Sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selectedItems as $item): ?>
                    <tr>
                        <td>
                            <?php echo $item['product_name']; ?>
                        </td>
                        <td><img src="assets/imgs/item/<?php echo $item['product_img']; ?>" alt="lỗi khi tải ảnh" style="width: 50px;"></td>
                        <td>
                            <?php echo $selectedQuantities[$item['product_id']]; ?>
                        </td>
                        <td>
                            <?php echo number_format($item['product_price'] * $selectedQuantities[$item['product_id']], 0, ',', '.'); ?>.000 VND
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Thông tin khách hàng</h2>
        <form method="post" action="success.php">
            <div class="form-group">
                <label for="name">Tên Khách Hàng</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Địa Chỉ:</label>
                <input type="text" class="form-control" id="address" name="address"  value="<?php echo isset($_COOKIE['address']) ? $_COOKIE['address'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">SĐT:</label>
                <input type="tel" class="form-control" id="phone" name="phone"  value="<?php echo isset($_COOKIE['tel']) ? $_COOKIE['tel'] : ''; ?>" required>
            </div>

            <input type="hidden" name="selected_products" value="<?php echo implode(',', $selectedProducts); ?>">
            <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">

            <button type="submit" class="btn btn-primary" name="submit">Đặt hàng</button>
        </form>
    <?php endif; ?>
</div>

<?php require_once 'view/globle/footer.php'; ?>
