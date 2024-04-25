<?php 
session_start();
require_once '../dbConnection.php';

$user_id = $_POST['user_id'];
$street = $_POST['street'];
$house = $_POST['house'];
$flat = $_POST['flat'];
$time = $_POST['time_dur'];
$comment = $_POST['description'];
$items_list = $_POST['items_list'];
$total_price = $_POST['total_price'];
$status = "В обработке";
$address = $street . " " . $house . " " . $flat;

$query = 'INSERT INTO Orders (User_ID, Courer_ID, Time_Duration, Status, Item_List, Total_Price, Address, Comment)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
$prepare = $pdo -> prepare($query);
if($prepare) {
    $prepare->bindValue(1, $user_id);
    $prepare->bindValue(2, null);
    $prepare->bindValue(3, $time);
    $prepare->bindValue(4, $status);
    $prepare->bindValue(5, $items_list);
    $prepare->bindValue(6, $total_price);
    $prepare->bindValue(7, $address);
    $prepare->bindValue(8, $comment);
    $prepare->execute();
}
else {
    echo "Ошибка при подготовке запроса: " . $pdo -> errorInfo();
}

try {
    $query = "DELETE FROM User_Item WHERE User_ID = '$user_id'";
    $pdo->exec($query);
}
catch (PDOException $e) {
    die($e->getMessage());
}

header("Location: ../../front/basket.php");
?>