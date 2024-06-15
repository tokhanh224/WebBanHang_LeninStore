<?php

include 'modles/taikhoan.php';
class TaikhoanDAO
{

  private $pdo;

  public function __construct()
  {
    require('config/PDO.php');
    $this->pdo = $pdo;
  }


  public function add()
  {
    // Retrieve data from the form
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $role = $_POST['role'];

    // Perform the query to add the account
    $sql = "INSERT INTO taikhoan (user, pass, email, address, tel, role) 
                VALUES (:user, :pass, :email, :address, :tel, :role)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
      // Redirect to user admin page after adding the account
      header("Location: useradmin.php");
      exit();
    } else {
      // Handle the error when adding the account
      die("Query failed: " . implode(" ", $stmt->errorInfo()));
    }
  }

  public function edit()
  {
    // Retrieve data from the form
    $id = $_POST['id'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Perform the query to edit the account
    $sql = "UPDATE taikhoan 
                SET user = :user, pass = :pass
                WHERE id_ac = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);

    if ($stmt->execute()) {
      // Redirect to user admin page after editing the account
      header("Location: index.php?controller=khachang");
      exit();
    } else {
      // Handle the error when editing the account
      die("Query failed: " . implode(" ", $stmt->errorInfo()));
    }
  }
  
  public function delete()
  {
    // Retrieve data from the form
    $id = $_POST['id'];

    // Perform the query to delete the account
    $sql = "DELETE FROM taikhoan WHERE id_ac = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
      // Redirect to user admin page after deleting the account
      header("Location: index.php?controller=khachang");
      exit();
    } else {
      // Handle the error when deleting the account
      die("Query failed: " . implode(" ", $stmt->errorInfo()));
    }
  }
  public function getAccounts()
  {
    // Perform the query to get the list of accounts
    $sql = "SELECT * FROM taikhoan";
    $stmt = $this->pdo->query($sql);

    if (!$stmt) {
      die("Query failed: " . implode(" ", $this->pdo->errorInfo()));
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  

}

?>