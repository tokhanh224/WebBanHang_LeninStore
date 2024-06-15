<?php require_once 'view/globle/head.php'; ?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $customerName = $_POST['name'];
        $customerAddress = $_POST['address'];
        $phoneNumber = $_POST['phone'];
        $selectedProducts = isset($_POST['selected_products']) ? explode(',', $_POST['selected_products']) : [];

        if (!empty($selectedProducts)) {
            // Prepare the SQL statement to insert order details
            $orderInsert = $conn->prepare("INSERT INTO orders (product_name, product_img, quantity, product_price, customer_name, customer_address, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");

            foreach ($selectedProducts as $productId) {
                $cartQuery = $conn->prepare("SELECT * FROM giohang WHERE product_id = ?");
                $cartQuery->execute([$productId]);
                $cartItem = $cartQuery->fetch(PDO::FETCH_ASSOC);

                if ($cartItem) {
                    // Execute the order insertion query
                    $orderInsert->execute([
                        $cartItem['product_name'],
                        $cartItem['product_img'],
                        $cartItem['quantity'],
                        $cartItem['product_price'],
                        $customerName,
                        $customerAddress,
                        $phoneNumber
                    ]);

                    // Clear the selected product from the cart
                    $deleteCartQuery = $conn->prepare("DELETE FROM giohang WHERE product_id = ?");
                    $deleteCartQuery->execute([$productId]);
                }
            }

            // Move the HTML code outside of the PHP block
            ?>
            <form method="post" action="thongtindonhang.php">

                <input type="submit" name="submit" value="Xem Thông Tin Đơn Hàng">
            </form>

            <?php
            echo "Đặt hàng thành công!";
        } else {
            echo "Không có sản phẩm nào được chọn!";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

require_once 'view/globle/footer.php';
?>