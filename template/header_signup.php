<?PHP require_once 'template/include.php';?>
<?PHP
    if(isset($_POST["login"])){ 

        $login = $func->IsLogin($_POST["login"]);
        $pass = $func->IsPassword($_POST["pass"]);
        $email = $func->IsMail($_POST["email"]);
        $rules = isset($_POST["rules"]) ? true : false;
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time();

        if($rules){

            if($login !== false){
                
                if($email !== false){
                    
                    if($pass !== false){
                    
                        if($pass == $_POST["repass"]){
                            $pass = md5($pass);
                            $conn = connect();                  
                                # Регаем пользователя
                               $sql = ("INSERT INTO users (login, email, password, time_sign_up, ip) 
                                VALUES ('$login','$email','$pass','$time',INET_ATON('$ip'))");
                                 if (mysqli_query($conn, $sql)) {
                                    setcookie('user_create_success', 1, time()+1000);
                                    header('Location: /login');
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            close($conn);
                                
                        }else $danger = 'Пароль и повтор пароля не совпадают';
                    
                    }else $danger = 'Пароль заполнен неверно';
                
                }else $danger = 'Email имеет неверный формат</b></font></center>';
            
            }else $danger = 'Логин заполнен неверно';

        }else $danger = 'Вы не подтвердили правила';
    }else
?>
<?PHP require_once 'template/header.php';?>