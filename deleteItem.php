<?php 
require_once('connect.php');
$id = $_POST['id'];


mysqli_query($connect, "DELETE FROM Items WHERE `id` ='$id'");
header("Location: side.php");
?>