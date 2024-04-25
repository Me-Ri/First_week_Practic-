<?php  
session_start();
require_once 'connect.php';

$item_id = $_POST['item_id'];
$user_id = $_POST['user_id'];

try {
    $query = "DELETE FROM Cart WHERE User_ID = '$user_id' AND Item_ID = '$item_id'";
    $pdo->exec($query);
}
catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

header("Location: basket.php");

?>

