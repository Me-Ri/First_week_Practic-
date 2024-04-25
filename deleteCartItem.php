<?php  
require_once 'connect.php';
session_start();
$item_id = $_POST['item_id'];
$user_id = $_POST['user_id'];
mysqli_query($connect, "DELETE FROM `Cart` WHERE `id_user` = '$user_id' AND `id_item` = '$item_id'");


header("Location: basket.php");

?>

