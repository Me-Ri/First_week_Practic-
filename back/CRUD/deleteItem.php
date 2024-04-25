<?php 
require_once('../dbConnection.php');
$item_id = $_POST['id'];

try {
    $query = "DELETE FROM Items WHERE Item_ID ='$item_id'";
    $pdo->exec($query);
}
catch (PDOException $e) {
    die($e->getMessage());
}

header("Location: ../../front/main.php");
?>