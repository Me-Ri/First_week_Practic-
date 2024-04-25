<?php 
session_start();
require_once 'connect.php';

$user_id = $_POST['user_id'];
$street = $_POST['street'];
$house = $_POST['house'];
$flat = $_POST['flat'];
$time = $_POST['time_dur'];
$comment = $_POST['description'];
$items_list = $_POST['items_list'];
$total_price = $_POST['total_price'];
$status = "В обработке";

$query = 'INSERT INTO Orders (User_ID, Street, House, Flat, Time_Duration, Comment, Status, Items_List, Total_Price)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
$prepare = $pdo -> prepare($query);
if($prepare) {
    $prepare->bindValue(1, $user_id);
    $prepare->bindValue(2, $street);
    $prepare->bindValue(3, $house);
    $prepare->bindValue(4, $flat);
    $prepare->bindValue(5, $time);
    $prepare->bindValue(6, $comment);
    $prepare->bindValue(7, $status);
    $prepare->bindValue(8, $items_list);
    $prepare->bindValue(9, $total_price);
    $prepare->execute();
}
else {
    echo "Ошибка при подготовке запроса: " . $pdo -> errorInfo();
}

try {
    $query = "DELETE FROM Cart WHERE User_ID = '$user_id'";
    $pdo->exec($query);
}
catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

header("Location: basket.php");
?>