<?php
include "dbConnect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "SELECT * FROM products WHERE id  = $id";
$qr = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($qr);

?>

<form action="" method="POST">
    <p>name</p>
    <input type="text" name="name" value=" <?php echo $row['names']; ?>">
    <p>img</p>
    <input type="text" name="img" value="">
    <p>price</p>
    <input type="text" name="price" value=" <?php echo $row['price']; ?>">

    <input type="submit" name="submitUpdate" value="update">
</form>

<?php

if (isset($_POST["submitUpdate"])) {

    $name = $_POST["name"];
    $img = $_POST["img"];
    $price = $_POST["price"];


    if ($name == "") {
        echo "add name";
    } elseif ($img == "") {
        echo "add img";
    } elseif ($price == "") {
        echo "add price";
    } else {
        $sql = "UPDATE products set names = '$name', images = '$img', price = $price where id = $id;";
        mysqli_query($conn, $sql);
        header("location: admin.php");
    }
}

?>