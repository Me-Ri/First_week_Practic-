<?php 
    session_start();
    if(empty($_POST['Name']) || empty($_POST['Surname']) || empty($_POST['Email']) || empty($_POST['Password']) || empty($_POST['CPassword'])) {
        $_SESSION['message'] = "Что-то не заполнено";
        header("Location: ../../front/signupAndLogin.php");
        die();
    }
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $cpass = $_POST['CPassword'];
    $name = preg_replace('/\s+/', ' ', $name);
    $surname = preg_replace('/\s+/', ' ', $surname);
    $email = preg_replace('/\s+/', ' ', $email);
    if($name === ' ' || $surname === ' ' || $email === ' ') {
        header("Location: ../../front/signupAndLogin.php");
        die();
    }
    require_once("../dbConnection.php");
    if($password === $cpass) {
        $password = md5($password);
        $query = 'INSERT INTO customer (Name, Surname, Email, Password, Role) VALUES (?, ?, ?, ?, ?)';
        $prepare = $pdo -> prepare($query);
        if($prepare) {
            $prepare->bindValue(1, $name);
            $prepare->bindValue(2, $surname);
            $prepare->bindValue(3, $email);
            $prepare->bindValue(4, $password);
            $prepare->bindValue(5, "User");
            $prepare->execute();
        }
        else {
            echo "Ошибка при подготовке запроса: " . $pdo -> errorInfo();
        }
        $pdo = null;
        $_SESSION['message'] = 'Регистрация прошла успешно';
    }
    else {
        $_SESSION['message'] = 'Пароли не совпадают';
        $pdo = null;
        header("../../front/signupAndLogin.php");
    }
    header("Location: ../../front/signupAndLogin.php");
?>