<?php  
session_start();
require_once '../dbConnection.php';
$user_id = $_SESSION['user']['id'];
$item_id = $_POST['id'];
echo var_dump($_SESSION);
$query = 'INSERT INTO User_Item (User_ID, Item_ID) VALUES (?, ?)';
$prepare = $pdo -> prepare($query);
if($prepare) {
    $prepare->bindValue(1, $user_id);
    $prepare->bindValue(2, $item_id);
    $prepare->execute();
}
else {
    echo "Ошибка при подготовке запроса: " . $pdo -> errorInfo();
}

header("Location: ../../front/main.php");
?>