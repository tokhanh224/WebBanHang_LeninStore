<?php
require_once 'view/globle/head.php'; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
  .button {
    background-color: #04AA6D;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }

  .button4 {
    background-color: rgba(209, 213, 219, 1);

    color: black;
  }

  .button5 {
    background-color: #555555;
  }

  .comment-container {
    margin-top: 20px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
  }

  .comment {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .comment strong {
    color: #333;
  }

  .comment-form {
    margin-top: 20px;
  }

  .comment-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .comment-form button {
    background-color: #04AA6D;
    border: none;
    color: white;
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

</style>
<?php
$productId = $product->getIdPro();
$productName = $product->name;
$productPrice = $product->price;
$productImage = $product->image;
$productDescription = $product->chitiet;
$productLuotXem = $product->luotxem;
$productCategory = $product->danhmuc;
?>
<div>
  <div class="row">
    <div class="col-md-6">
      <img class="img-fluid" src='assets/imgs/item/<?php echo $productImage; ?>' alt='<?php echo $productName; ?>'>
    </div>

    <div class="col-md-6">
      <h1 class="font-semibold text-4xl pb-4 leading-9">
        <?php echo $productName; ?>
      </h1>
      <p class="h4">
        <?php echo $productPrice; ?>.000 VND
      </p>
      <p class="lead">
        <?php echo nl2br($productDescription); ?>
      </p>

      <p>Lượt xem:
        <?php echo $productLuotXem; ?>
      </p>
      <p>Danh mục:
        <?php echo $productCategory; ?>
      </p>
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "duan12023";

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
            $productId = $_POST["product_id"];
            $productName = $_POST["product_name"];
            $productPrice = $_POST["product_price"];
            $productImage = $_POST["product_img"];
            $quantity = 1; // Hoặc có thể lấy từ form nếu có
        
            // Sử dụng prepared statement để tránh SQL injection
            $query = $conn->prepare("INSERT INTO giohang (product_id, user_id, quantity, product_name, product_price, product_img) VALUES (:productId, '1', :quantity, :productName, :productPrice, :productImage)");
            $query->bindParam(':productId', $productId);
            $query->bindParam(':quantity', $quantity);
            $query->bindParam(':productName', $productName);
            $query->bindParam(':productPrice', $productPrice);
            $query->bindParam(':productImage', $productImage);

            $result = $query->execute();

            if ($result) {
              echo "Sản phẩm đã được thêm vào giỏ hàng!";
            } else {
              echo "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!";
            }
          }
        } catch (PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
        ?>
      <form method="post" action="">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
        <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
        <input type="hidden" name="product_img" value="<?php echo $productImage; ?>">
      
        <button type="submit" class="button button4" name="add_to_cart">Thêm vào giỏ hàng</button>

      </form>

      <!-- Nút Mua ngay -->
      <form method="post" action="checkout.php">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
        <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
        <input type="hidden" name="product_img" value="<?php echo $productImage; ?>">
        <button type="submit" class="button button5" name="buy_now">Mua ngay</button>
      </form>
     <!-- Hiển thị Bình luận -->
     <h2>Đánh giá</h2>
      <?php
      // Hiển thị bình luận
      $sql = "SELECT * FROM binhluan WHERE idpro = $productId";
      $result = $conn->query($sql);

      if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          echo "<p><strong>User:</strong> " . (isset($_COOKIE['username']) ? $_COOKIE['username'] : '') . "<br><strong>Nội Dung:</strong> " . $row['noidung'] . "<br><strong>Ngày đánh giá:</strong> " . $row['ngaybinhluan'] . "</p>";
        }
      } else {
        echo "Chưa có bình luận nào.";
      }
      ?>

      <!-- Form Bình luận -->
      <form method="post" action="">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <textarea name="comment" rows="4" cols="50" placeholder="Nhập đánh giá của bạn..."></textarea>
        <br>
        <button type="submit" class="button button4" name="submit_comment">Gửi đánh giá </button>
      </form>

      <?php
      // Xử lý gửi bình luận
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_comment"])) {
        $comment = $_POST["comment"];
        $userId = 1; // Thay thế bằng id của người dùng đã đăng nhập

        $query = $conn->prepare("INSERT INTO binhluan (noidung, iduser, idpro) VALUES (:comment, :userId, :productId)");
        $query->bindParam(':comment', $comment);
        $query->bindParam(':userId', $userId);
        $query->bindParam(':productId', $productId);

        $result = $query->execute();

        if ($result) {
          echo "Bình luận của bạn đã được gửi.";
        } else {
          echo "Có lỗi xảy ra khi gửi bình luận.";
        }
      }
      ?>


    </div>

  </div>
</div>


<?php require_once 'view/globle/footer.php'; ?>