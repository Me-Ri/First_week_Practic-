<?php
    session_start();
    if(empty($_POST['Email']) || empty($_POST['Password'])) {
        $_SESSION['message'] = "Что-то не заполнено";
        header("Location: ../../front/signupAndLogin.php");
        die();
    }

    $email = $_POST['Email'];
    $password = $_POST['Password'];
    require_once("../dbConnection.php");
    $password = md5($password);
    $query = "SELECT * FROM customer WHERE Email = '$email' AND Password = '$password'";
    $check_user = $pdo -> query($query);
    $number_of_rows = $check_user -> rowCount();
    if($number_of_rows > 0) {
        $user = $check_user -> fetch(PDO :: FETCH_ASSOC);
        $_SESSION['user'] = [
            "id" => $user['user_id'],
            "name" => $user['name'],
            "role" => $user['role']
        ];
        header('Location: ../../front/main.php');
    }
    else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        $pdo = null;
        header("Location: ../../front/signupAndLogin.php");
    }
?>