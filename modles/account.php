<?php
// insert tài khoản
function insert_taikhoan($email, $user, $pass)
{
    // Create a PDO connection (replace 'your_database', 'your_username', and 'your_password' with your actual database credentials)
    $pdo = new PDO('mysql:host=location;dbname=duan12013', 'root', '');

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO taikhoan (email, user, pass) VALUES (:email, :user, :pass)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters to the placeholders
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);

    // Execute the statement
    $stmt->execute();
}

// Example usage:
$email = 'example@email.com';
$user = 'example_user';
$pass = 'example_password';

insert_taikhoan($email, $user, $pass);


?>

