<?php

if(isset($_GET["idDelete"])){ // Add to cart from the index page
  session_start();
  $cartArray = $_SESSION["cart"];
  $array = Delete_cart_item($_GET["idDelete"],$cartArray);
  $_SESSION["cart"] = $array;
  header("location: cart.php");
  
}

function ProductCard($id_category)
{
  include "dbConnect.php";
  $sql = "SELECT * FROM products WHERE category_id = $id_category ";
  $qr = mysqli_query($conn, $sql);
  $html = '';
  while ($rows = mysqli_fetch_array($qr)) {
    $html .= '<div class="product">    
      <img class="product__image" src="' . $rows['images'] . '" alt="product image">
    <p class="product__name">' . $rows['names'] . '</p>
    <p class="product__price">' . $rows['price'] . '</p>
    <a href="php/cart.php?id=' . $rows['id'] . '" class="btn btn__buy-now">Mua ngay</a>
    <a href="php/detail.php?id=' . $rows['id'] . '" class="btn btn__product-detail">Chi tiết</a>
    </div>';
  }
  return $html;
}
function FindProduct($id_product)
{
  include "dbConnect.php";
  $sql = "SELECT * FROM products WHERE id = $id_product ";
  $qr = mysqli_query($conn, $sql);
  return mysqli_fetch_array($qr);
}

function Remove($id, $table)
{
  include "dbConnect.php";
  $sql = "DELETE FROM $table WHERE id = $id";
  mysqli_query($conn, $sql);
}


function Edit($column, $table, $value, $condition)
{
  include "dbConnect.php";
  $sql = "UPDATE $table
  SET $column = $value
  WHERE $condition ;";
  mysqli_query($conn, $sql);
}

function Insert($table, $column, $value)
{
  include "dbConnect.php";
  $sql = "INSERT INTO $table($column)VALUES($value);";
  mysqli_query($conn, $sql);
}


function SelectTable($column, $table)
{
  include "dbConnect.php";
  $sql = "SELECT $column FROM $table;";
  $qr = mysqli_query($conn, $sql);
  $html = [];
  while ($rows = mysqli_fetch_array($qr)) {
    $html[] = $rows;
  }
  return $html;
  
}

function Add_to_cart($id, $quantity, $array)
{
  if (!empty($array)) {
    for ($i = 0; $i < count($array["id"]); $i++) {
      if ($array["id"][$i] == $id) {
        $array["quantity"][$i] += $quantity;
        return $array;
      }
    }
    $array["id"][] = $id;
    $array["quantity"][] = $quantity;
  } else {
    $array["id"][] = $id;
    $array["quantity"][] = $quantity;
  }
  return $array;
}

function Delete_cart_item($id, $cartArray){
  for ($i = 0; $i < count($cartArray["id"]); $i++) {
    if ($cartArray["id"][$i] == $id) {
      array_splice($cartArray["id"], $i, 1);
      array_splice($cartArray["quantity"], $i, 1);
      return $cartArray;
    }
  }
}
?>
