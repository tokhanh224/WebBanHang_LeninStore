<?php 
// UserController.php
include 'DAO/TaikhoanDAO.php';

class UserController
{
    private $taikhoanDAO;

    public function __construct()
    {
        $this->taikhoanDAO = new TaikhoanDAO();
    }

    public function index()
    {
        if (isset($_COOKIE["role"])) {
            if ($_COOKIE['role'] == 1) {
                $this->showUserAdminPage();
            } else {
                $this->showUserProfilePage();
            }
        }
    }

    public function showUserAdminPage()
    {
        // Handle add, edit, delete account requests
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["add_account"])) {
                $this->add();
            } elseif (isset($_POST["edit_account"])) {
                $this->edit();
            } elseif (isset($_POST["delete_account"])) {
                $this->delete();
            }
        }

        // Get accounts from the database using TaikhoanDAO
        $accounts = $this->taikhoanDAO->getAccounts();

        // Display the user admin page
        include('view/user/useradmin.php');
    }

    public function showUserProfilePage()
    {
        // Display the user profile page
        include 'view/user/profile.php';
    }

    // Utilize TaikhoanDAO methods for operations
    public function add()
    {
        $this->taikhoanDAO->add();
    }

    public function edit()
    {
        $this->taikhoanDAO->edit();
    }

    public function delete()
    {
        $this->taikhoanDAO->delete();
    }
}
?>
