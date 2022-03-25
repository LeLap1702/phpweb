<?php
include "dbConnect.php";

?>

<form action="" method="POST" enctype="multipart/form-data">
    <p>Chọn folder lưu ảnh: </p>
      <input type="radio" id="fs_boy" name="folder_name" value="fashion_boy">
      <label for="fs_boy">fashion_boy</label><br>
      <input type="radio" id="fs_girl" name="folder_name" value="fashion_girl">
      <label for="fs_girl">fashion_girl</label><br>
      <input type="radio" id="new_prds" name="folder_name" value="hangmoive">
      <label for="new_prds">hangmoive</label><br>
      <input type="radio" id="shoes" name="folder_name" value="shoes">
      <label for="shoes">shoes</label>

    <p>Chọn ảnh sản phẩm: </p>
    <input type="file" name="file_image">

    <p>Tên sản phẩm: </p>
    <input type="text" name="name">

    <p>Giá sản phẩm: </p>
    <input type="text" name="price">

    <p>Chọn loại hàng: </p>
      <input type="radio" id="tt_nam" name="choose_categories" value="1">
      <label for="tt_nam">Thời trang nam</label><br>
      <input type="radio" id="tt_nu" name="choose_categories" value="2">
      <label for="tt_nu">Thời trang nữ</label><br>
      <input type="radio" id="hang_moi_ve" name="choose_categories" value="3">
      <label for="hang_moi_ve">Hàng mới về</label><br>
    <textarea name="desc" cols="30" rows="10" placeholder="Mô tả sản phẩm: "></textarea>
    <p>Số lượng sản phẩm: </p>
    <input type="number" name="quantity">
    <p>Từ khóa: </p>
    <input type="text" name="keyword">
    <p>Trạng thái: </p>
    <input type="number" name="status">
    <p>Giảm giá: </p>
    <input type="text" name="sale_price"><br>
    
    <input type="submit" name="submitADD" value="ADD">
</form>

<?php

if (isset($_POST["submitADD"])) {

    $name = $_POST["name"];
    $folder_name = $_POST["folder_name"];
    $price = $_POST["price"];
    $categories = $_POST["choose_categories"];
    $desc = $_POST["desc"];
    $quantity = $_POST["quantity"];
    $keyword = $_POST["keyword"];
    $status = $_POST["status"];
    $sale_price = $_POST["sale_price"];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date("Y-m-d");

    if ($name == "") {
        echo "add name";
    } else {
        include_once "uploadImage.php";
        $column = "names, category_id, images, descriptions, price,saleprice, created, quantity, keyword, statuses";
        $values = "'$name',$categories,'$target_file','$desc',$price,$sale_price, '$date',$quantity,'$keyword',$status";
        include_once "modules.php";
        Insert("products",$column, $values);
        header("location: admin.php");
    }
}
?>