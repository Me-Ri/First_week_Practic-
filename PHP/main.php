<? 
    $host='92.63.64.241';
    $db = 'group-5';
    $username = 'group-5';
    $password = 'group-5';
    
    
    # Создаем соединение с базой PostgreSQL с указанными выше параметрами
    $dsn = "pgsql:host=$host;port=21533;dbname=$db;user=$username;password=$password";
    try{
        echo "Connected to the <strong>$db</strong> database successfully! <br><br>";
        $conn = new PDO($dsn);
        if($conn){

            $res = $conn->query("select table_name, column_name from information_schema.columns where table_schema='public'");

            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                echo($row["table_name"].'-'.$row["column_name"] . '<br>');
            }



        }

    }catch (PDOException $e){ echo $e->getMessage();}

?>