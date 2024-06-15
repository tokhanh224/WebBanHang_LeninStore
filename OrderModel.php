<?php
class OrderModel {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "duan12023";

        $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllOrders() {
        $orderQuery = $this->conn->prepare("SELECT * FROM orders");
        $orderQuery->execute();
        return $orderQuery->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
