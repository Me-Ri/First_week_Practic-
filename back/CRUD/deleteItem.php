<?php 
require_once('connect.php');
$item_id = $_POST['id'];


mysqli_query($connect, "DELETE FROM Items WHERE Item_ID ='$item_id'");
header("Location: side.php");
?>