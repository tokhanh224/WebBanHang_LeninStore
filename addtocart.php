<?php
 require_once 'view\globle\head.php'; 
 ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
        $productId = $_POST["product_id"];
        $productName = $_POST["product_name"];
        $productPrice = $_POST["product_price"];
        $productImage = $_POST["product_img"];
        $quantity = 1; // Hoặc có thể lấy từ form nếu có

        // Sử dụng prepared statement để tránh SQL injection
        $query = $conn->prepare("INSERT INTO giohang (product_id, user_id, quantity, product_name, product_price, product_img) VALUES (:productId, '1', :quantity, :productName, :productPrice, :productImage)");
        $query->bindParam(':productId', $productId);
        $query->bindParam(':quantity', $quantity);
        $query->bindParam(':productName', $productName);
        $query->bindParam(':productPrice', $productPrice);
        $query->bindParam(':productImage', $productImage);

        $result = $query->execute();

        if ($result) {
            echo "Sản phẩm đã được thêm vào giỏ hàng!";
        } else {
            echo "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!";
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
 <form method="post" action="cart.php">
            <button type="submit" class="continue-shopping">Đi Đến Giỏ Hàng</button>
        </form>
<?php require_once 'view/globle/footer.php'; ?>