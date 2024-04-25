<?php
require_once 'connect.php';
if (!empty($_FILES['image']['name'])) {
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
   
    mysqli_query($connect,"INSERT INTO Items (id, img_pass, Name, Price, Description) VALUES ('44','$imagepath', '200', '$price', '$desc' )");
   
    mysqli_close($connect);
}
else {
    echo "Ошибка загрузки файла";
}
header("Location: side.php");





 //$query = "INSERT INTO images (path) VALUES ('$imagepath')";
    //$connect->query($query);






?>