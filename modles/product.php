<?php
class Product
{
    public $id_pro; // Đổi tên thuộc tính
    public $name;
    public $image;
    public $price;
    public $luotxem;

    public function __construct($id_pro, $name, $image, $price, $luotxem)
    {
        $this->id_pro = $id_pro; // Đổi tên ở đây
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
        $this->luotxem = $luotxem;
    }
}

class ProductShow
{
    public $id_pro; // Đổi tên thuộc tính
    public $name;
    public $image;
    public $price;
    public $chitiet;
    public $luotxem;
    public $danhmuc;

    public function __construct($id_pro, $name, $price, $image, $chitiet, $luotxem, $danhmuc)
    {
        $this->id_pro = $id_pro; // Đổi tên ở đây
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
        $this->chitiet = $chitiet;
        $this->luotxem = $luotxem;
        $this->danhmuc = $danhmuc;
    }

    // Getter cho các thuộc tính
    public function getIdPro()
    {
        return $this->id_pro; // Sửa ở đây
    }

}


