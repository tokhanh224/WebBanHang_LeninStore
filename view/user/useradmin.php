<?php
require_once 'view/globle/headadmin.php';
include 'config/PDO.php';

// Biến flag để kiểm soát hiển thị form sửa
$show_edit_form = false;

// Check if the edit form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'save_edit') {
            // Process the form submission for editing
            $id_to_edit = $_POST['id'];
            $new_user = $_POST['user'];
            $new_pass = $_POST['pass'];
            $new_email = $_POST['email']; // Thêm trường Email
            $new_address = $_POST['address']; // Thêm trường Address
            $new_tel = $_POST['tel']; // Thêm trường SDT
            $new_role = $_POST['role']; // Thêm trường Role

            // Perform the query to update the account
            $sql_update = "UPDATE taikhoan 
                           SET user = :user, pass = :pass, email = :email, address = :address, tel = :tel, role = :role
                           WHERE id_ac = :id";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->bindParam(':id', $id_to_edit);
            $stmt_update->bindParam(':user', $new_user);
            $stmt_update->bindParam(':pass', $new_pass);
            $stmt_update->bindParam(':email', $new_email);
            $stmt_update->bindParam(':address', $new_address);
            $stmt_update->bindParam(':tel', $new_tel);
            $stmt_update->bindParam(':role', $new_role);

            if ($stmt_update->execute()) {
                // Redirect to user admin page after editing the account
                header("Location: index.php?controller=taiKhoan");
                exit();
            } else {
                // Handle the error when editing the account
                die("Query failed: " . implode(" ", $stmt_update->errorInfo()));
            }
        } elseif ($_POST['action'] === 'edit_clicked') {
            // Set the flag to show the edit form
            $show_edit_form = true;
        }
    }
}

$sql = "SELECT * FROM taikhoan";
$stmt = $pdo->prepare($sql);
$stmt->execute();

if (!$stmt) {
    die("Query failed: " . $pdo->errorInfo()[2]);
}
?>

<div class="row2">
    <div class="row2 font_title">
        <h1>Phân quyền user</h1>
    </div>
    <div class="row2">
        <div style="text-align: center; margin-bottom:20px">
            <h3>Danh Sách Tài Khoản</h3>
        </div>
        <div class="row2 form_content">
            <table>
                <tr>
                    <th></th>
                    <th>MãTK</th>
                    <th>User Name</th>
                    <th>Pass</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>SDT</th>
                    <th>Role (Vai Trò)</th>
                    <th></th>
                </tr>

                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id_ac'];
                    $user = $row['user'];
                    $pass = $row['pass'];
                    $email = $row['email'];
                    $address = $row['address'];
                    $tel = $row['tel'];
                    $role = $row['role'];

                    // Display account information in each row
                    echo "
                        <tr>
                            <td><input type='checkbox' name='' id=''></td>
                            <td>{$id}</td>
                            <td>{$user}</td>
                            <td>{$pass}</td>
                            <td>{$email}</td>
                            <td>{$address}</td>
                            <td>{$tel}</td>
                            <td>{$role}</td>
                            <td>
                                <form action='index.php?controller=taiKhoan' method='POST'>
                                    <input type='hidden' name='action' value='edit_clicked'>
                                    <input type='hidden' name='id' value='{$id}'>
                                    <input type='submit' value='Sửa'>
                                </form>
                            </td>
                            <td>
                                <form action='index.php?controller=taiKhoan_delete' method='POST'>
                                    <input type='hidden' name='id' value='{$id}'>
                                    <input type='submit' value='Xóa'>
                                </form>
                            </td>
                        </tr>
                    ";

                    // Hiển thị form sửa nếu biến flag là true và ID trùng khớp
                    if ($show_edit_form && isset($_POST['id']) && $_POST['id'] == $id) {
                        echo "
                            <tr>
                                <td colspan='8'>
                                    <form action='index.php?controller=taiKhoan' method='POST'>
                                        <input type='hidden' name='action' value='save_edit'>
                                        <input type='hidden' name='id' value='{$id}'>
                                        <input type='text' name='user' value='{$user}'>
                                        <input type='text' name='pass' value='{$pass}'>
                                        <input type='text' name='email' value='{$email}'> <!-- Thêm trường Email -->
                                        <input type='text' name='address' value='{$address}'> <!-- Thêm trường Address -->
                                        <input type='text' name='tel' value='{$tel}'> <!-- Thêm trường SDT -->
                                        <input type='text' name='role' value='{$role}'> <!-- Thêm trường Role -->
                                        <input type='submit' value='Lưu'>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
