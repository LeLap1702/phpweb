<?php
include "dbConnect.php";
if (isset($_GET["id"])) {
  $id_product = $_GET["id"];
  include_once "modules.php";
  $rows =  FindProduct($id_product);
} else {
  header('location:../index.php');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/style.css">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <title><?php echo $rows["names"] ?></title>
  <style>
    .container {
      width: 90vw;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .product {
      width: 80%;
      display: grid;
      grid-template-columns: 50% 50%;
      box-shadow: 0 0 25px #000;
      border-radius: 10px;
      overflow: hidden;
    }

    .product__image {
      width: 90%;
      height: 100%;
    }

    .product__content {
      font-family: SF Mono;
    }

    .product__name {
      font-size: 28px;
      padding: 20px 10px;
    }

    .product__price {
      font-weight: 600;
      color: red;
    }

    .product__price::after {
      content: "vnđ";
      color: red;
    }

    .product__desc {
      text-align: justify;
      padding-right: 20px;
      height: 39%;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    .btn {
      display: inline-block;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="product">
      <img src="../<?php echo $rows["images"] ?>" alt="" class="product__image">
      <div class="product__content">
        <div class="product__name"><?php echo $rows["names"] ?></div>
        <p class="product__price"><?php echo $rows["price"] ?></p>
        <p class="product__desc"><?php echo $rows["descriptions"] ?></p>
        <p class="product__quantity">Còn <b><?php echo $rows["quantity"] ?></b> sản phẩm</p>
        <form action="" method="post">
          <label for="quantity">Chọn số lượng sản phẩm: </label> 
          <input type="number" min="1" max="<?php echo $rows["quantity"] ?>" name="quantity"  id="quantity"> <br>
          <button class="btn" type="submit">
            <ion-icon name="cart-outline"></ion-icon>
          </button>
          <a href="../index.php" class="btn">Quay lại</a>
        </form>
        <?php  if (isset($_POST["quantity"]) && !empty($_POST["quantity"])) {
          $quantity = $_POST["quantity"];
          session_start();
          if (!isset($_SESSION["cart"])) {
            $_SESSION['cart'] = array("id"=> array(), "quantity"=> array());
          }
          $array = $_SESSION["cart"];

          $arrayCart = Add_to_cart($id_product, $quantity,$array );
          $_SESSION["cart"] = $arrayCart;
          header("location: cart.php");
        }
        ?>

      </div>
    </div>
  </div>
</body>

</html>