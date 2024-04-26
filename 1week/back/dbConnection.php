<?php     
    $dsn = "pgsql:host=92.63.64.241;port=21533;dbname=group-5;user=group-5;password=group-5";
    try{
    $pdo = new PDO($dsn);
    if ($pdo) {
		// echo "Connected to the database successfully!";
	}
    }catch (PDOException $e){
        die($e->getMessage());
    }
?> 
