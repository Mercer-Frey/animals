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
//нумерация страниц
function paginationCount($conn){
    $sql = "SELECT * FROM info";
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
    $sql = "SELECT post FROM tag WHERE tag='".$_GET['tag']."'";
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
    return $a;
}
//закрытие
function close($conn){
    mysqli_close($conn);
}