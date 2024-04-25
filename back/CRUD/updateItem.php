<?php 
require_once('../dbConnection.php');

$item_id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
// $comment = mysqli_query($connect, "SELECT * FROM `Feedback` WHERE `id` = '$id'");
// $comment = mysqli_fetch_assoc($comment);
if(empty($_FILES['image']['name'])) {
try {
    $query = "UPDATE Items SET Name = '$name', Price = '$price', Description = '$description' WHERE Item_ID = '$item_id'";
    $pdo->exec($query);
}
catch (PDOException $e) {
    die($e->getMessage());
}
}
else {
    $file = $_FILES['image'];
    $filename = $file['name'];
    $path_info = pathinfo($filename);
    $imagepath = 'img/' . $filename; 
    $imagepath = str_replace(" " , "_" ,$imagepath);
    $extention = $path_info['extension'];
    if ($extention !== "png" and $extention !== "bmp" and $extention !== "jpg" and $extention !== "jpeg") {
        header("Location: ../../front/edit.php");
        exit;
    }
    $description = $_POST['description'];
    $price = $_POST['price'];

    move_uploaded_file($file['tmp_name'], $imagepath);

    try {
        $query = "UPDATE Items SET Name = '$name', Img_Path = '$imagepath', Price = '$price', Description = '$desc' WHERE Item_ID = $item_id";
        $pdo->exec($query);
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
}

header("Location: ../../front/main.php");
?>