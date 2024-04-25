<?php 
require_once('connect.php');
$id = $_POST['id'];
$name = $_POST['name'];
$desc = $_POST['description'];
$price = $_POST['price'];
// $comment = mysqli_query($connect, "SELECT * FROM `Feedback` WHERE `id` = '$id'");
// $comment = mysqli_fetch_assoc($comment);
if(empty($_FILES['image']['name'])){
mysqli_query($connect, "UPDATE `Items` SET `Name` = '$name', `Price` = '$price', `Description` = '$desc' WHERE `id` = $id");

}else {
    $file = $_FILES['image'];
    $filename = $file['name'];
    $path_info = pathinfo($filename);
    $imagepath = 'img/' . $filename; 
    $imagepath = str_replace(" " , "_" ,$imagepath);
    $extention = $path_info['extension'];
    if ($extention !== "png" and $extention !== "bmp" and $extention !== "jpg" and $extention !== "jpeg") {
        header("Location: index.php");
        exit;
    }
    $desc = $_POST['description'];
    $price = $_POST['price'];

    move_uploaded_file($file['tmp_name'], $imagepath);
   
    mysqli_query($connect, "UPDATE `Items` SET `Name` = '$name', `img_pass` = '$imagepath', `Price` = '$price', `Description` = '$desc' WHERE `id` = $id");

}



header("Location: side.php");
?>