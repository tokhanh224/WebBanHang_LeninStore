
<?php require_once 'view/globle/headadmin.php'; ?>

<?php
// Kết nối đến cơ sở dữ liệu và kiểm tra quyền truy cập

$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM binhluan";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table border='1'>
                <tr>
                  <th>ID</th>
                  <th>Nội dung</th>
                  <th>Ngày đăng</th>
                  <th>Sản phẩm</th>
                  <th>Người đăng</th>
                  <th>Thao tác</th>
                </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id_bl']}</td>
                    <td>{$row['noidung']}</td>
                    <td>{$row['ngaybinhluan']}</td>
                    <td>{$row['idpro']}</td>
                    <td>{$row['iduser']}</td>
                    <td><a href='deletebinhluan.php?id={$row['id_bl']}'>Xóa</a></td>
                 </tr>";
        }

        echo "</table>";
    } else {
        echo "Không có bình luận nào.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
