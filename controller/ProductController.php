<?php
class ProductController
{
 

    public function index()
    {
        
        if (isset($_COOKIE["role"])) {
            if ($_COOKIE['role'] == 1) {

                include('view/home/homeAdmin.php');
            } else {
                $ProductDAO = new ProductDAO();
                $products = $ProductDAO->sharelist($_GET['product'] ?? null, $_POST['search'] ?? null);
                $danhmucs = $ProductDAO->showDanhMuc();
                include 'view/product/cli/listitem.php';
            }
        } else {
            $ProductDAO = new ProductDAO();
            $products = $ProductDAO->sharelist($_GET['product']?? null, $_POST['search'] ?? null);
            $danhmucs = $ProductDAO->showDanhMuc();
            include 'view/product/cli/listitem.php';
        }
        
    }

    public function danhmuc()
    {
        
        $ProductDAO = new ProductDAO();
        if (isset($_POST['tenloai']) && $_POST['tenloai'] != '') {

            $ProductDAO->addDM($_POST['tenloai']);
        }
        if (isset($_POST['id']) && $_POST['id'] != '') {

            $ProductDAO->deleteDM($_POST['id']);
        }
        if (isset($_POST['xoa']) && $_POST['xoa'] != '') {
            $ProductDAO->deleteallDM($_POST['xoa']);
        }
        if (isset($_POST['tenmoi']) && $_POST['tenmoi'] != '') {
            $ProductDAO->updateDM($_POST['id_l'], $_POST['tenmoi']);
        } else {
            $danhmucs = $ProductDAO->showDanhMuc();
        }
        include('view/product/admin/classitemadmin.php');
    }
    public function sanpham()
    {
        
            $ProductDAO = new ProductDAO();
            $products = $ProductDAO->Select();
            $danhmucs = $ProductDAO->showDanhMuc();
        if (isset($_POST['add']) && $_POST['add'] != '') {
            $ProductDAO->addPRO($_POST['tensanpam'], $_POST['gia'], $_FILES['img'], $_POST['mota'], $_POST['iddm']);
        }
        if (isset($_POST['id_x']) && $_POST['id_x'] != '') {
            $ProductDAO->deletePRO($_POST['id_x']);
        }
        if (isset($_POST['fix']) && $_POST['fix'] != '') {
            $ProductDAO->updatePRO($_POST['idsp'], $_POST['tensanpam'], $_POST['gia'], $_FILES['img'], $_POST['mota'], $_POST['iddm']);
        }
        if (isset($_POST['xoa']) && $_POST['xoa'] != '') {
            $ProductDAO->deleteallPRO($_POST['xoa']);
        }
        $danhmucs = $ProductDAO->showDanhMuc();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $counts = $ProductDAO->countProducts();
        $sanphams = $ProductDAO->showPRO($page, 5);
        include('view/product/admin/iteam.php');
        
        
        
    }
   
    public function addComment()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_content"])) {
            // Get the user ID from the session
            $userId = $_SESSION["user_id"];
    
            // Get the product ID from the form
            $productId = $_POST["product_id"];
    
            // Get the comment content from the form
            $content = $_POST["comment_content"];
    
            // Validate and sanitize the input if needed
    
            // Insert the comment into the database
            $this->insertComment($userId, $productId, $content);
        }
    }
    
    private function insertComment($userId, $productId, $content)
    {
        // Provide the database connection details
        $servername = "your_server_name";
        $username = "your_username";
        $password = "your_password";
        $database = "your_database_name";
    
        try {
            // Create a new PDO instance
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Prepare and execute the SQL query
            $query = $conn->prepare("INSERT INTO binhluan (noidung, iduser, idpro, ngaybinhluan) VALUES (:content, :userId, :productId, NOW())");
            $query->bindParam(':content', $content);
            $query->bindParam(':userId', $userId);
            $query->bindParam(':productId', $productId);
            $query->execute();
    
            // Close the database connection
            $conn = null;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    

    public function productDetail()
    {
        // Kiểm tra quyền người dùng
        if (isset($_COOKIE["role"]) && $_COOKIE['role'] == 1) {
            include('view/home/homeAdmin.php');
            exit;
        }
    
        $ProductDAO = new ProductDAO();
    
        // Kiểm tra xem có tham số id trên URL không
        $productId = isset($_GET['id']) ? intval($_GET['id']) : null;
    
        try {
            // Kiểm tra xem id hợp lệ hay không
            if ($productId === null || $productId <= 0) {
                throw new Exception("ID sản phẩm không hợp lệ");
            }
    
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product = $ProductDAO->showOne($productId);
            $danhmucs = $ProductDAO->showDanhMuc();
    
            // Kiểm tra xem sản phẩm có tồn tại không
            if ($product === null) {
                throw new Exception("Sản phẩm không tồn tại");
            }
    
            // Hiển thị trang chi tiết sản phẩm
            include 'view/product/cli/chitietsp.php';
            exit;
        } catch (Exception $e) {
            echo "Có lỗi xảy ra: " . $e->getMessage();
            // Log lỗi hoặc xử lý nó theo cách phù hợp với ứng dụng của bạn.
            exit;
        }
    }
    

    
}
