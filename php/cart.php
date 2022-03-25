<?php
session_start();
// session_destroy();
include "dbConnect.php";
include "modules.php";
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array("id" => array(), "quantity" => array());
  } else {
    $array = Add_to_cart($id, 1, $_SESSION["cart"]);
    $_SESSION["cart"] = $array;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/style.css">
  <title>Your cart | MyLiShop</title>
</head>

<body>

  <div class="bag-container">
    <form method="post" action="">
      <input style="display: none;" type="submit" id="submitEdit" name="submitEdit"> <!-- The input submit :v -->
      <h1 style="text-align: center;">Giỏ hàng của bạn</h1>
      <div class="bag__grid">

        <div>
          <ul class="bag-list">
            <?php
            $totalPayment = 0;
            if (isset($_SESSION["cart"])) {
              $arrayCart = $_SESSION["cart"];

              if (empty($arrayCart["id"])) {
                echo "Giỏ hàng của bạn rỗng!";
              }

              for ($i = count($arrayCart["id"]) - 1; $i >= 0; $i--) {
                $product = FindProduct($arrayCart["id"][$i]);
                $total = $arrayCart["quantity"][$i] * $product["price"];
                $totalPayment += $total;
                
                echo '
                <label class="bag-item" for="submitEdit" > <!-- label for the input submit :v -->
                  <div class="bag-content">
                  <input type="number" value="'.$arrayCart["id"][$i].'" name="quantity' . $i . '" style="display: none;" > <!-- get name and id of the cart item :v -->
                    <div class="bag__content--left">
                      <img src="../' . $product["images"] . '" alt="Ảnh sản phẩm" class="bag__content-image">
                    </div>
                    <div class="bag__content--right">
                      <p class="bag__content-price product__price">' . number_format($product["price"]) . 'vn&#8363;</p>
                      <p class="bag__content-name">' . $product["names"] . '</p><br>
                      <div class="bag__content-qty" id="qty">Số lượng: <input name="quantityEdit" id="quantity' . $i . '" type="number" min="1" max="' . $product["quantity"] . '" value="' . $arrayCart["quantity"][$i] . '" disabled></div>
                      <p class="bag__content-total  ">Tổng tiền:  <i class="product__price">' . number_format($total) . 'vn&#8363;</i></p>
                    </div>
                    <div class="bag__delete">
                    <a href="modules.php?idDelete=' . $arrayCart["id"][$i] . '">&#10006;</a>
                    <a href="cart.php?idEdit=quantity' . $i . '">&#9998;</a>
                    </div>
                  </div>
                </label>';
              }
            } else {
              echo "Giỏ hàng của bạn rỗng!";
            }
            if (isset($_GET["idEdit"])) {
              $id = $_GET["idEdit"];
              echo '
              <script>
                var edit = document.getElementById("' . $id . '");
                edit.removeAttribute("disabled")
                edit.style.border = "1px solid #000";
                edit.style.backgroundColor = " #89fffd";
              </script>';
              if (isset($_POST["submitEdit"])) {
                $quantity = $_POST["quantityEdit"];
                $IdEdit = $_POST["$id"];
                  if(!empty($quantity)){
                    for ($x = count($arrayCart["id"]) - 1; $x >= 0; $x--) {
                      if($arrayCart["id"][$x] == $IdEdit){
                        $arrayCart["quantity"][$x] = $quantity;
                        $_SESSION["cart"] = $arrayCart;
                        break;
                      }
                    }
                  }
                  echo '
                <script>
                  var edit = document.getElementById("' . $id . '");
                  edit.setAttribute("disabled","")
                  edit.style.border = "none";
                  edit.style.backgroundColor = "transparent";
                  window.location = "cart.php";
                </script>';
              }
            }
            


            ?>

          </ul>

        </div>
        <div class="bag__btn--control">
          <a class="btn" href="../index.php">Quay lại mua hàng</a> <br>
          <a class="btn" href="#">Xác nhận mua hàng</a> <br>
          <div class="bag__general-info">
            <p class="bag__total-payment">
              Tổng tiền thanh toán: <i class="product__price"><?php echo number_format($totalPayment); ?>vn&#8363;</i>
            </p>
          </div>

        </div>
    </form>
  </div>


</body>

</html>