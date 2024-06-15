<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333;
        text-align: center;
        padding: 20px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 50px;
        max-height: 50px;
    }

    form {
        display: inline-block;
        margin-right: 5px;
    }

    button {
        background-color: #555;
        color: #fff;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #333;
    }

    p {
        color: #333;
        text-align: center;
    }
</style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
        $productId = $_POST["product_id"];

        // Perform the deletion query
        try {
            $query = $conn->prepare("DELETE FROM giohang WHERE product_id = :productId AND user_id = '1'");
            $query->bindParam(':productId', $productId);
            $result = $query->execute();

            if ($result) {
                echo "Sản phẩm đã được xoá khỏi giỏ hàng!";
            } else {
                echo "Có lỗi xảy ra khi xoá sản phẩm khỏi giỏ hàng!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<form method="post" action="index.php">
    <button type="submit" class="continue-shopping">Tiếp tục mua</button>
</form>