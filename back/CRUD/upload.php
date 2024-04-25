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
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    move_uploaded_file($file['tmp_name'], $imagepath);
   
    $query = 'INSERT INTO Items (Item_ID, Img_Path, Name, Price, Description) VALUES (?, ?, ?, ?, ?)';
    $prepare = $pdo -> prepare($query);
    if($prepare) {
        $prepare->bindValue(1, $item_id);
        $prepare->bindValue(2, $imagepath);
        $prepare->bindValue(3, $name);
        $prepare->bindValue(4, $price);
        $prepare->bindValue(5, $description);
        $prepare->execute();
    }
    else {
        echo "Ошибка при подготовке запроса: " . $pdo -> errorInfo();
    }
   
    $pdo = null;
    header("Location: side.php");
}
else {
    echo "Ошибка загрузки файла";
}
?>