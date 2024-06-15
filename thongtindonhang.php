<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 50px;
    }

    h2 {
        color: #007bff;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #007bff;
        color: #ffffff;
    }

    td img {
        max-width: 100%;
        height: auto;
    }

    a {
        color: #dc3545;
        cursor: pointer;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

 <?php require_once 'view/globle/head.php'; ?>
<link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">


<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the confirm_order parameter is present in the URL
    if (isset($_GET['confirm_order'])) {
        $orderId = $_GET['confirm_order'];

        // Update the order confirmation status in the database
        $updateQuery = $conn->prepare("UPDATE orders SET confirmed = 1 WHERE id = :order_id");
        $updateQuery->bindParam(':order_id', $orderId);
        $updateQuery->execute();
        echo 'Confirmed';
        exit();
    }

    // Check if the cancel_order parameter is present in the URL
    if (isset($_GET['cancel_order'])) {
        $orderId = $_GET['cancel_order'];

        // Update the order cancellation status in the database
        $cancelQuery = $conn->prepare("UPDATE orders SET cancelled = 1 WHERE id = :order_id");
        $cancelQuery->bindParam(':order_id', $orderId);
        $cancelQuery->execute();
        echo 'Cancelled';
        exit();
    }

    // Retrieve updated order information from the database
    $orderQuery = $conn->prepare("SELECT * FROM orders");
    $orderQuery->execute();
    $orders = $orderQuery->fetchAll(PDO::FETCH_ASSOC);

    // Display order details
    if (!empty($orders)) {
        ?>
        <div class="container mt-5">
            <h2>Đơn Hàng Của Bạn</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên Sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tên khách hàng</th>
                        <th>Địa Chỉ</th>
                        <th>SĐT</th>
                        <th>Ngày Đặt</th>
                        <th>Xác nhận đơn hàng</th>
                        <th>Huỷ đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['product_name']; ?></td>
                            <td><img src='assets/imgs/item/<?php echo $order['product_img']; ?>' alt='Ảnh sản phẩm' style='width: 50px;'></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo $order['product_price']; ?>.000 VND</td>
                            <td><?php echo $order['customer_name']; ?></td>
                            <td><?php echo $order['customer_address']; ?></td>
                            <td><?php echo $order['phone_number']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td>
                                <?php if (isset($order['confirmed']) && $order['confirmed']): ?>
                                    Đang giao hàng 
                                <?php else: ?>
                                    Chờ xác nhận
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($order['cancelled']) && $order['cancelled']): ?>
                                    Đã huỷ
                                <?php else: ?>
                                    <?php if (isset($order['confirmed']) && !$order['confirmed']): ?>
                                        <a href="#" onclick="cancelOrder(<?php echo $order['id']; ?>)">Huỷ</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
            function cancelOrder(orderId) {
                var confirmation = confirm("Bạn có chắc muốn huỷ đơn hàng #" + orderId + "?");
                if (confirmation) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "thongtindonhang.php?cancel_order=" + orderId, true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            if (xhr.responseText === 'Cancelled') {
                                var statusCell = document.querySelector('#order-' + orderId + '-status');
                                if (statusCell) {
                                    statusCell.innerHTML = 'Đã huỷ';
                                }
                            }
                        }
                    };
                    xhr.send();
                }
            }
        </script>
        <?php
    } else {
        echo "<div class='container mt-5'>Không có đơn hàng nào!</div>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} finally {
    // Close the database connection
    if (isset($conn)) {
        $conn = null;
    }
}

require_once 'view/globle/footer.php';
?>
