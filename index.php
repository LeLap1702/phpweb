<?php 
include "php/dbConnect.php";
include "php/modules.php";
session_start();
if(isset($_SESSION["cart"])){
  $qty = count($_SESSION["cart"]["id"]);
}else {$qty = 0;}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="./styles/style.css">
  <title>MyLiShop</title>
</head>

<body>
  <div class="container">
    <div class="navbar">
    <a class="nav-mobile-item" href="#"> <img src="./images/logohong.png"
              style="width: 120px; height: 120px; object-fit:cover" alt=""></a>
      <nav class="nav-res">
        <ul class="nav-list">
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="php/login.php">Đăng Ký</a></li>
          <li class="nav-mobile-item"><a data-text="<?php echo $qty ?>" class="cart__icon" href="php/cart.php"><ion-icon name="cart-outline" ></ion-icon></a></li>
        </ul>
      </nav>
      
      <label class="nav-btn" for="nav-mobile-input">
        <ion-icon name="list-outline"></ion-icon>
      </label>

      <input type="checkbox" name="" id="nav-mobile-input">
      <label for="nav-mobile-input" class="nav-overlay"></label>
      <nav class="nav_mobile">
        <label for="nav-mobile-input" class="close-btn-nav">
          <ion-icon name="close-outline"></ion-icon>
        </label>
        <ul class="nav-mobile-list">
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a href="#">Menu Item</a></li>
          <li class="nav-mobile-item"><a class="log-in" href="php/login.php">Đăng ký</a></li>
          <li class="nav-mobile-item"><a data-text="<?php echo $qty ?>" class="cart__from-navbar" href="php/cart.php">Giỏ hàng</a></li>
        </ul>
      </nav>
    </div>
    <h2 class="category-title">Hàng mới về</h2>
    <div id="fs_new-products" class="display-product">
      <?php
    echo ProductCard(3);
    ?>
    </div>

    <h2 class="category-title">Thời trang nam</h2>
    <div class="display-product" id="fs__boy">
      <?php
    
    echo ProductCard(1);
    ?>
    </div>

    <h2 class="category-title">Thời trang nữ</h2>
    <div id="fs_girl" class="display-product">
      <?php
    echo ProductCard(2);
    ?>
    </div>


  </div>
</body>

</html>