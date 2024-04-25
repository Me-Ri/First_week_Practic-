<?php
require_once '../dbConnection.php';
if (!empty($_FILES['image']['name'])) {
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
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    move_uploaded_file($file['tmp_name'], $imagepath);
   
    $query = 'INSERT INTO Items (Name, Img_Path, Price, Description) VALUES (?, ?, ?, ?)';
    $prepare = $pdo -> prepare($query);
    if($prepare) {
        $prepare->bindValue(1, $name);
        $prepare->bindValue(2, $imagepath);
        $prepare->bindValue(3, $price);
        $prepare->bindValue(4, $description);
        $prepare->execute();
    }
    else {
        echo "Ошибка при подготовке запроса: " . $pdo -> errorInfo();
    }
   
    $pdo = null;
    header("Location: ../../front/main.php");
}
else {
    echo "Ошибка загрузки файла";
}
?>