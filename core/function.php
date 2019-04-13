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

// function getPostFromCategory($conn){
//     $sql = "SELECT * FROM info WHERE category=".$_GET['id'];
//     $result = mysqli_query($conn, $sql);
    
//     $a = array();
//     if (mysqli_num_rows($result) > 0) {
//         while($row = mysqli_fetch_assoc($result)) {
//             $a[] = $row;
//         }
//     } 

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

function paginationCountCat($conn){
    $sql =  "SELECT * FROM info WHERE category=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    return ceil($result/3);
}

//закрытие
function close($conn){
    mysqli_close($conn);
}