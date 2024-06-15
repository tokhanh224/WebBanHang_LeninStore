<?php
include 'modles/Login.php';
class LoginDAO
{
    protected $PDO;

    public function __construct()
    {   
        global $pdo;
        require_once('config/PDO.php');
        $this->PDO = $pdo;
    }

    public function topProducts()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Login($username, $password)
{
    $sql = "SELECT `id_ac`, `user`,`tel`,`address`, `anh`, `role`, `trang_thai`, `email` FROM `taikhoan` WHERE `email` = :username AND `pass` = :password";
    $stmt = $this->PDO->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    $stmt->execute();

    // Fetch dữ liệu từ CSDL
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Xác định quyền (role) của người dùng từ dữ liệu
    return $row ?? null;
}
    public function signup($email, $password, $address, $tel)
    {
        $sql = "INSERT INTO `taikhoan`(`email`, `pass`, `address`, `tel`) VALUES (:email, :password, :address, :tel)";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
        if ($stmt->execute()) {
            var_dump( $_SESSION['address'] = $address);
            $_SESSION['username'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['address'] = $address;
            $_SESSION['tel'] = $tel;
        }
    }
}
