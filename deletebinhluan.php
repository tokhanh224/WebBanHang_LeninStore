<!-- Trong trang admin/delete_comment.php -->
<?php
// Kết nối đến cơ sở dữ liệu và kiểm tra quyền truy cập
include '../auth.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "duan12023";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $commentId = $_GET['id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM binhluan WHERE id_bl = :commentId";
        $query = $conn->prepare($sql);
        $query->bindParam(':commentId', $commentId);
        $query->execute();

        header("Location: comments.php"); // Chuyển hướng sau khi xóa bình luận thành công
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
