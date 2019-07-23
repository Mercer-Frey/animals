<?php
//соединение
function connect(){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, "utf8");
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
//выборка
function select($conn){
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}
// выбор контента для страницы с выбором по три животных в обратном порядке
function selectMain($conn){
    $offset = 0;
    if (isset($_GET['page']) AND trim($_GET['page'])!=''){
        $offset = trim($_GET['page']);
    }
    $sql = "SELECT * FROM info ORDER BY id DESC LIMIT 3 OFFSET ".$offset*3;
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}

//нумерация страниц главной
function paginationCount($conn){
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    return ceil($result/3);
}
//нумерация страниц тегов
function paginationCountTag($conn){
    $sql = "SELECT post, tag FROM tag WHERE tag='".$_GET['tag']."'";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    return ceil($result/3);
}

function paginationCountCat($conn){
    $sql =  "SELECT * FROM info WHERE category=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    return ceil($result/3);
}

// взять все теги с таблицы tag
function getAllTags($conn){
    $sql = "SELECT DISTINCT(tag) FROM tag";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row['tag'];
        }
    } 
    return $a;
}
// выбор поста по тегу
function getPostFromTag($conn){
    $offset = 0;
    if (isset($_GET['offset']) AND trim($_GET['offset'])!=''){
        $offset = trim($_GET['offset']);
    }
    $sql = "SELECT post FROM tag WHERE tag='".$_GET['tag']."' ORDER BY post DESC LIMIT 3 OFFSET ".$offset*3;
    $result = mysqli_query($conn, $sql);

    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row['post'];
        }
    } 

    $sql = "SELECT * FROM info WHERE id in (".join(",", $a).")";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    }
    return array_reverse($a);
}


function selectArticle($conn){
    $sql = "SELECT * FROM info WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 
    return false;
}

function getArticleTags($conn){
    $sql = "SELECT * FROM tag WHERE post=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}

function getPostFromCategory($conn){
    $offset = 0;
    if (isset($_GET['offset']) AND trim($_GET['offset'])!=''){
        $offset = trim($_GET['offset']);
    }
    $sql = "SELECT * FROM info WHERE category='".$_GET['id']."' ORDER BY category DESC LIMIT 3 OFFSET ".$offset*3;
    $result = mysqli_query($conn, $sql);

    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return array_reverse($a);
}

function getCatInfo($conn){
    $sql = "SELECT * FROM category WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } 
    return $row;
}

function getAllCatInfo($conn){
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}

function deleteArticle($conn,$id){
    $sql = "DELETE FROM info WHERE id=".$id;
    $result = mysqli_query($conn, $sql);
    $sql = "DELETE FROM tag WHERE post=".$id;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return "Error deleting record: " . mysqli_error($conn);
    }
}


//закрытие
function close($conn){
    mysqli_close($conn);
}

class func{

    /*======================================================================*\
    Function:   GenerateCode
    Output:     string
    Input:      Число - длина строки 
    Descriiption: Функция для генерации случайной строки
    \*======================================================================*/
    public function GenerateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
    
     /*======================================================================*\
    Function:   IsLogin
    Output:     True / False
    Input:      Строка логина
    Descriiption: Проверяет правильность ввода логина 
    \*======================================================================*/
    public function IsLogin($login){
        
        return (is_array($login)) ? false : (preg_match( "/[a-zA-Z0-9]{4,10}/i", $login)) ? $login : false;
    
    }
    
    /*======================================================================*\
    Function:   IsPassword
    Output:     True / False
    Input:      Строка пароля
    Descriiption: Проверяет правильность ввода пароля
    \*======================================================================*/
    public function IsPassword($password){
        
        return (is_array($password)) ? false : (preg_match( "/[a-zA-Z0-9]{4,20}/i", $password)) ? $password : false;
    
    }

    /*======================================================================*\
    Function:   IsMail
    Output:     True / False
    Input:      Email 
    Descriiption: Проверяет правильность ввода email адреса
    \*======================================================================*/
    public function IsMail($mail){
        
        if(is_array($mail) && empty($mail) && strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
            return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? false : strtolower($mail);
            
    }
};
    $func = new func;
?>