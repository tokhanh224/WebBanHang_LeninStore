<?php require_once 'view/globle/headadmin.php'; ?>

<div class="container mt-5">
    <h2>Thông Tin Tất Cả Đơn Hàng</h2>
    <?php if (!empty($orders)): ?>
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
                        <td id="orderStatus_<?php echo $order['id']; ?>">
                            <?php if (isset($order['confirmed']) && $order['confirmed']): ?>
                                Đã xác nhận
                            <?php else: ?>
                                <a href="#" onclick="confirmOrder(<?php echo $order['id']; ?>)">Xác nhận</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" onclick="deleteOrder(<?php echo $order['id']; ?>)">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có đơn hàng nào!</p>
    <?php endif; ?>
</div>

<script>
    function confirmOrder(orderId) {
        var confirmation = confirm("Xác nhận đơn hàng #" + orderId + " đã giao?");
        if (confirmation) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('orderStatus_' + orderId).innerHTML = 'Đã xác nhận';
                }
            };
            xhr.open('GET', 'thongtindonhang.php?confirm_order=' + orderId, true);
            xhr.send();
        }
    }

    function deleteOrder(orderId) {
        var confirmation = confirm("Bạn có chắc muốn xóa đơn hàng #" + orderId + "?");
        if (confirmation) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Remove the entire row from the table upon successful deletion
                    var row = document.getElementById('orderStatus_' + orderId).parentNode;
                    row.parentNode.removeChild(row);
                }
            };
            xhr.open('GET', 'thongtindonhang.php?delete_order=' + orderId, true);
            xhr.send();
        }
    }
</script>

<?php require_once 'view/globle/footer.php'; ?>
