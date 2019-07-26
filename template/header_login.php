<?php
require_once 'template/include.php';

if (isset($_POST['password'])) {
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $_POST['email'] . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    // Сравниваем пароли
    if ($data['password'] === md5($_POST['password']) AND $data['email'] === $_POST['email']) {
        // Генерируем случайное число и шифруем его
        $hash = md5($func->GenerateCode(10));
        $time = time();
        $ip = $_SERVER['REMOTE_ADDR'];
        // Записываем в БД новый хеш авторизации
        mysqli_query($conn, "UPDATE users SET user_hash='" . $hash . "', time_last_online='".$time."', ip='".$ip."'  WHERE id='" . $data['id'] . "'");

        // Ставим куки
        $user = ['id' => $data['id'], 'login' => $data['login'], 'email' => $data['email']];
        setcookie("user", json_encode($user), time() + 60 * 60 * 24 * 30);
        setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, null, null, null, true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: /check-login");
        
        exit();
    } else {
        $danger = "Вы ввели неправильный логин/пароль";
    }
}
close($conn);
?>
<?php 
    if($_COOKIE['user_create_success'] == 1){
        setcookie('user_create_success', 1, time()-10);
        $flash =  "<h3 class='text-center text-success'>New record created successfully, please login</h3>";
    }
?>
<?php require_once '/template/header.php';?>
