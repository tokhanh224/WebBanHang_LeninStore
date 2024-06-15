<?php
include 'DAO/LoginDAO.php';


class LoginController
{
    public function index()
    {

        // if (isset($_COOKIE["rank"])) {
        //     include('view/home/home.php');
        // } else {
        //     include('view/login/login.php');
        // }
    }
    public function login()
    {
        include('view/login/login.php');
    }
    public function doLogin()
    {
        $username = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

    
        $loginDAO = new LoginDAO();
        $userInfo = $loginDAO->login($username, $password);
        if ($userInfo) {
            $role = $userInfo["role"];
            $username = $userInfo["email"];
            $tel = $userInfo["tel"];
            $address =  $userInfo["address"];
            // Thiết lập cookie cho vai trò (role) và thông tin người dùng
            setcookie("role", $role, time() + 3600, "/");
            setcookie("username", $username, time() + 3600, "/");
            setcookie('is_login', true, time() + 3600, "/");
            setcookie("tel", $tel, time() + 3600, "/");
            setcookie("address", $address, time() + 3600, "/");

            
            // Chuyển hướng sau khi đăng nhập thành công
            header("Location: index.php?controller=home");
            exit();
        } else {
         
            header("Location: index.php?controller=login&act=login");
        }
    }
    public function signup()
    {
        include('view/login/signup.php');
    }
    public function doSignup()
    {
      
       
        if (isset($_SESSION['username'])) {
            
            header("Location: index.php?controller=login&act=login");

        } else {
            if (isset($_SESSION['role'])) {
                header("Location: index.php?controller=login&act=login");
            } else {
                if (isset($_SESSION['address'])) {

                    header("Location: index.php?controller=login&act=login");
                } else {
                    if (isset($_SESSION['tel'])) {

                        header("Location: index.php?controller=login&act=login");
                    } else {
                        if (isset($_POST['email'])) {
                            $LoginDAO = new LoginDAO();
                            $LoginDAO->signup($_POST['email'], $_POST['password'], $_POST['address'], $_POST['tel']);
                            header("Location: index.php?controller=login&act=login");
                        } else {
                            header("Location: index.php?controller=login&act=signup");
                        }
                    }
                }
            }
        }
    }

    public function logout()
    {
        $_SESSION = array();

        // Delete the session cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        // Destroy the session
        session_destroy();

        // Clear any additional cookies you may have set
        // Replace 'cookie_name' with the name of your cookie
        setcookie('role', '', time() - 3600, '/');
        setcookie('username', '', time() - 3600, '/');
        setcookie('is_login', false, time() - 3600, '/');
        setcookie('address', '', time() - 3600, '/');
        setcookie('tel', '', time() - 3600, '/');
        // Redirect to the login page or any other desired page after logout
        header('Location: index.php?controller=login&act=login');
        exit();
    }
}