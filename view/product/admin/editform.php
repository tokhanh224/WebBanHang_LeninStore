<form action='index.php?controller=taiKhoan&action=save_edit' method='POST'>
    <input type='hidden' name='id' value='<?php echo $account['id']; ?>'>
    <label for='user'>User:</label>
    <input type='text' name='user' value='<?php echo $account['user']; ?>'>
    <br>
    <label for='pass'>Password:</label>
    <input type='text' name='pass' value='<?php echo $account['pass']; ?>'>
    <!-- Các trường khác -->
    <br>
    <input type='submit' value='Lưu'>
</form>