<?php
require_once 'connect.php';

$query = "INSERT INTO Items (id, img_pass, Name, Price, Description) VALUES (1 ,'src/images/07.png','Бургер', 1000, 'Очень сытный бургер')";
if(mysqli_query($connect , $query)) {
  echo "Cоед и загр успех";
}

?>
