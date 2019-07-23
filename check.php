<?php require_once 'template/include.php';?>
<?php
if (isset($_COOKIE['user']) and isset($_COOKIE['hash'])){
    $user_login = json_decode($_COOKIE['user']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '".intval($user_login->{'id'})."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $user_login->{'id'}) or ($userdata['login'] !== $user_login->{'login'}) or ($userdata['email'] !== $user_login->{'email'})){
        setcookie("user", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        header('Location: /');
    } else {
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        if(intval($userdata['id']) === 1 AND $userdata['id'] === $user_login->{'id'}){
            header("Location: /admin");
        }else{
            header("Location: /");
        }
    }
} 
else {
    print "Включите куки";
}
close($conn);
?>
<?php require_once 'template/header.php';?>
<?php require_once 'template/footer.php';?>
