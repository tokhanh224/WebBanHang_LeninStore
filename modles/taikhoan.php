<?php

class Taikhoan
{
    public $id_ac; // Đổi tên thuộc tính
    public $anh;
    public $user;
    public $pass;
    public $email;
    public $address;
    public $tel;
    public $role;
    public $id_quyen;
    public $trang_thai;

    public function __construct($id_ac, $anh, $user, $pass, $email, $address, $tel, $role, $id_quyen, $trang_thai)
    {
        $this->id_ac = $id_ac; // Đổi tên ở đây
        $this->anh = $anh;
        $this->user = $user;
        $this->pass = $pass;
        $this->email = $email;
        $this->address = $address;
        $this->tel = $tel;
        $this->role = $role;
        $this->id_quyen = $id_quyen;
        $this->trang_thai = $trang_thai;
    }
}

class TaikhoanShow
{
    public $id_ac; // Đổi tên thuộc tính
    public $anh;
    public $user;
    public $pass; // Lưu ý: Bạn nên tránh hiển thị mật khẩu trong lớp show
    public $email;
    public $address;
    public $tel;
    public $role;
    public $id_quyen;
    public $trang_thai;

    public function __construct($id_ac, $anh, $user, $pass, $email, $address, $tel, $role, $id_quyen, $trang_thai)
    {
        $this->id_ac = $id_ac; // Đổi tên ở đây
        $this->anh = $anh;
        $this->user = $user;
        $this->pass = $pass;
        $this->email = $email;
        $this->address = $address;
        $this->tel = $tel;
        $this->role = $role;
        $this->id_quyen = $id_quyen;
        $this->trang_thai = $trang_thai;
    }

    // Getter cho các thuộc tính
    public function getIdAc()
    {
        return $this->id_ac; // Sửa ở đây
    }
}

?>
