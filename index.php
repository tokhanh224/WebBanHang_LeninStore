<?php
session_start();

// Include các tệp và khởi tạo các controller
include 'controller/HomeController.php';
include 'controller/ProductController.php';
include 'controller/LoginController.php';
include 'controller/UserController.php';
include 'controller/OrderController.php';

$controller = $_GET['controller'] ?? 'home';

switch ($controller) {


    // case 'dangNhap':
    //     $LoginController = new LoginController();
    //     $LoginController->index();
    //     break;
    // case 'dangKy':
    //     $LoginController = new LoginController();
    //     $LoginController->signup();
    //     break;
    case 'dangXuat':
        $LoginController = new LoginController();
        $LoginController->logout();
        break;
    case 'home':
        $homeController = new HomeController();
        $homeController->index();
        break;
    case 'danhmuc':
        $productController = new ProductController();
        $productController->danhmuc();
        break;
    case 'donhang':
            $OrderController = new OrderController();
            $OrderController->index();
            break;
    case 'sanpham':
        $productController = new ProductController();
        $productController->sanpham();
        break;
    case 'khachang':
        $UserController = new UserController();
        $UserController->index();
        break;
    case 'logout':
        $LoginController = new LoginController();
        $LoginController->logout();
        break;
    case 'add_comment':
            $productController = new ProductController();
            $productController->addComment();
            break;
        
    case 'sanPham_view':
        $SanPhamController = new ProductController();
        $SanPhamController->productDetail();
        break;
    case 'taiKhoan':      
        $UserController = new UserController();
        $UserController->index();
        break;
    case 'taiKhoan_add':
        $UserController = new UserController();
        $UserController->add();
        break;
    case 'taiKhoan_fix':
        $UserController = new UserController();
        $UserController->edit();
        break;
    case 'taiKhoan_delete':
        $UserController = new UserController();
        $UserController->delete();
        break;
    case 'save_edit':
        $UserController = new UserController();
        $UserController->saveEdit();
        break;
    case 'product':
        if (isset($_GET["act"])) {
            if ($_GET['act'] == 'add') {
                $productController = new ProductController();
                $productController->sanpham();
            }
            if ($_GET['act'] == 'delete') {
                $productController = new ProductController();
                $productController->sanpham();
            }
            if ($_GET['act'] == 'fix') {
                $productController = new ProductController();
                $productController->sanpham();
            }
            if ($_GET['act'] == 'item') {
                $productController = new ProductController();
                $productController->item();
            }
            if ($_GET['act'] == 'bl') {
                $productController = new ProductController();
                $productController->binhluan();
            }
        } else {
            $productController = new ProductController();
            $productController->index();
        }
        break;
    case 'login':
        if (isset($_GET['act'])) {
            $act = $_GET['act'];
            $LoginController = new LoginController();

            if ($act == 'signup') {
                $LoginController->signup();
            } elseif ($act == 'login') {
                $LoginController->login();
            } elseif ($act == 'do-signup') {
                $LoginController->doSignup();
            } elseif ($act == 'do-login') {
                $LoginController->doLogin();
            }

            if (isset($_SESSION["role"])) {
                // Truyền đối tượng PDO vào UserController
                $UserController = new UserController();
                $UserController->index();
            } else {
                $LoginController->index();
            }
        }
        break;
}
