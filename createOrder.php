<?php 
require_once 'connect.php';

$user_id = $_POST['user_id'];
$street = $_POST['street'];
$house = $_POST['house'];
$flat = $_POST['flat'];
$time = $_POST['time_dur'];
$comment = $_POST['description'];
$items_list = $_POST['items_list'];
$total_price = $_POST['total_price'];
mysqli_query($connect, 
"INSERT INTO `Orders` (id_user, street, house, flat, time_duration, comment, status, items_list, total_price)
VALUES ('$user_id', '$street', '$house', '$flat', '$time', '$comment', 'Ожидает подтверждения', '$items_list', '$total_price' )");

mysqli_query($connect, "DELETE FROM `Cart` WHERE `id_user` = '$user_id'");

header("Location: basket.php");
?>