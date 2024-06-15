<?php
include 'modles/product.php';
include 'modles/danhmuc.php';
include 'modles/slideshow.php';
        require_once 'config/PDO.php';
class ProductDAO
{
    private $PDO;
    public function __construct()
    {
        global $pdo;
        $this->PDO = $pdo;
    }
    function Select()
    {
        $sql = "SELECT * FROM `sanpham` ORDER BY luotxem desc LIMIT 4";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();

        $products = array(); // hoặc $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Tạo đối tượng sản phẩm từ dữ liệu và thêm vào danh sách
            $product = new Product($row['id_pro'], $row['name_sp'], $row['img'], $row['price'], $row['luotxem']);
            $products[] = $product;
        }

        return $products;
        
    }
    function SelectItem($text)
    {

        $keyword = '%' . $text . '%'; // Thêm '%' ở đầu và cuối chuỗi tìm kiếm
        $sql = "SELECT * FROM `sanpham` WHERE `name_sp` LIKE :keyword";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();

        $products = array(); // hoặc $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Tạo đối tượng sản phẩm từ dữ liệu và thêm vào danh sách
            $product = new Product($row['id_pro'], $row['name_sp'], $row['img'], $row['price'], $row['mota']);
            $products[] = $product;
        }
        return $products;
    }
    public function sharelist($loai, $search)
    {
        if ($search != null && $search !== '') {
            $keyword = '%' . $search . '%';
        }
        $sql = "SELECT sanpham.* FROM `sanpham` 
        LEFT JOIN danhmuc ON danhmuc.id_d=sanpham.iddm 
        WHERE (:loai IS NULL OR danhmuc.name = :loai) AND (:keyword IS NULL OR sanpham.name_sp LIKE :keyword)";
        $stmt = $this->PDO->prepare($sql);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->bindParam(':loai', $loai, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = array(); // hoặc $products = [];
        foreach ($data as $row) {
            // Tạo đối tượng sản phẩm từ dữ liệu và thêm vào danh sách
            $product = new Product($row['id_pro'], $row['name_sp'], $row['img'], $row['price'], $row['luotxem']);
            $products[] = $product;
        }
        return $products;
    }
    public function showDanhMuc()
    {
        $sql = "SELECT * FROM `danhmuc`";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();

        $danhmucs = array(); // hoặc $danhmucs = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Tạo đối tượng danh mục từ dữ liệu và thêm vào danh sách
            $danhmuc = new danhmuc($row['id_d'], $row['name']);
            $danhmucs[] = $danhmuc;
        }

        return $danhmucs;
    }
    public function slideShow()
    {
        $sql = "SELECT * FROM `sanpham` ORDER BY luotxem desc LIMIT 3";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function addDM($name)
    {
        $sql = "INSERT INTO `danhmuc`( `name`) VALUES ('$name')";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }
    public function deleteDM($id)
    {
        $sql = "DELETE FROM `danhmuc` WHERE id_d=$id";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }
    public function deleteallDM($id_a)
    {
        // Chuyển mảng ID thành một chuỗi dạng (id1, id2, id3, ...)
        $id_string = implode(', ', $id_a);
        $sql = "DELETE FROM `danhmuc` WHERE id_d IN ($id_string)";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }
    //  product
    public function countProducts()
    {
        $sql = "SELECT COUNT(*) as total FROM sanpham"; // Thay đổi "sanpham" thành tên bảng của bạn

        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {

            return 0;
        } // Trả về 0 nếu không có sản phẩm
    }
    public function showPRO($page, $perPage)
    {
        $start = ($page - 1) * $perPage;
        $sql = "SELECT sanpham.id_pro, sanpham.name_sp, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, danhmuc.name
            FROM sanpham
            JOIN danhmuc ON danhmuc.id_d = sanpham.iddm
            LIMIT $start, $perPage";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();

        $products = array(); // hoặc $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Tạo đối tượng sản phẩm từ dữ liệu và thêm vào danh sách
            $product = new ProductShow($row['id_pro'], $row['name_sp'], $row['price'], $row['img'], $row['mota'], $row['luotxem'], $row['name']);
            $products[] = $product;
        }

        return $products;
    }
    public function updateDM($id, $name)
    {

        $sql = "UPDATE `danhmuc` SET `name`='$name' WHERE `id_d`=" . $id;
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }
    public function addPRO($name, $price, $img, $mota, $iddm)
    {
        // lưu file
        $fileName = $img['name'];
        $tmp = $img['tmp_name'];
        $mov = 'assets/imgs/item/' . $fileName;
        move_uploaded_file($tmp, $mov);
        //add server
        $sql = "INSERT INTO `sanpham`(`name_sp`, `price`, `img`, `mota`, `luotxem`, `iddm`) VALUES ('$name','$price','$fileName','$mota','0','$iddm')";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }
    public function deletePRO($id)
    {
        $sql = "DELETE FROM `sanpham` WHERE id_pro=$id";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }
    public function deleteallPRO($id_a)
    {
        // Chuyển mảng ID thành một chuỗi dạng (id1, id2, id3, ...)
        $id_string = implode(', ', $id_a);
        $sql = "DELETE FROM `sanpham` WHERE id_pro IN ($id_string)";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
    }

    public function updatePRO($id, $name, $price, $img, $mota, $iddm)
    {
        if ($img['name'] == '') {
            $sql = "UPDATE `sanpham` SET `name_sp`='$name',`price`='$price',`mota`='$mota',`iddm`='$iddm' WHERE  `id_pro`=" . $id;
            $stmt = $this->PDO->prepare($sql);
            $stmt->execute();
        } else {
            $fileName = $img['name'];
            $tmp = $img['tmp_name'];
            $mov = 'assets/imgs/item/' . $fileName;
            move_uploaded_file($tmp, $mov);
            $sql = "UPDATE `sanpham` SET `name_sp`='$name',`price`='$price',`mota`='$mota',`iddm`='$iddm' ,`img`='$fileName' WHERE  `id_pro`=" . $id;
            $stmt = $this->PDO->prepare($sql);
            $stmt->execute();
        }
    }

    public function show()
    {
        $sql = "SELECT * FROM `sanpham` ORDER BY `id_pro` DESC;";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute();
        $lists = array(); // hoặc $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Tạo đối tượng sản phẩm từ dữ liệu và thêm vào danh sách
            $product = new Product(
                $row['id_pro'],
                $row['name_sp'],
                $row['mota'],
                $row['img'],
                $row['price'],

            );
            $lists[] = $product;
        }
        return $lists;
    }



    // Trong ProductDAO.php
    // Trong hàm showOne
    // Trong hàm showOne của class ProductDAO
    public function showOne($id)
    {
        $checkIdQuery = "SELECT COUNT(*) FROM sanpham WHERE id_pro = :id";
        $checkIdStmt = $this->PDO->prepare($checkIdQuery);
        $checkIdStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkIdStmt->execute();

        $idExists = $checkIdStmt->fetchColumn();

        if ($idExists) {
            // Tăng lượt xem
            $updateViewsQuery = "UPDATE sanpham SET luotxem = luotxem + 1 WHERE id_pro = :id";
            $updateViewsStmt = $this->PDO->prepare($updateViewsQuery);
            $updateViewsStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $updateViewsStmt->execute();

            // Lấy thông tin sản phẩm
            $sql = "SELECT sanpham.id_pro, sanpham.name_sp, sanpham.price, sanpham.img, sanpham.mota, sanpham.luotxem, danhmuc.name
             FROM sanpham
             JOIN danhmuc ON danhmuc.id_d = sanpham.iddm
             WHERE sanpham.id_pro = :id";

            $stmt = $this->PDO->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return new ProductShow(
                $result['id_pro'],
                $result['name_sp'],
                $result['price'],
                $result['img'],
                $result['mota'],
                $result['luotxem'],
                $result['name']
            );
        } else {
            echo "Sản phẩm không tồn tại.";
        }
    }


}
