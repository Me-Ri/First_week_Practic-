<?php  
require_once 'connect.php';
$id_item = $_POST['id'];

mysqli_query($connect, "INSERT INTO `Cart` (id_user, id_item) VALUES ('1','$id_item')");

header("Location: side.php");
?>