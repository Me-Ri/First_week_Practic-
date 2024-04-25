<?php 
require_once('connect.php');
$id = $_POST['id'];
$desc = $_POST['description'];
$price = $_POST['price'];
// $comment = mysqli_query($connect, "SELECT * FROM `Feedback` WHERE `id` = '$id'");
// $comment = mysqli_fetch_assoc($comment);

mysqli_query($connect, "UPDATE `Items` SET `Price` = '$price', `Description` = '$desc' WHERE `Items`.`id` = $id");


header("Location: side.php");
?>