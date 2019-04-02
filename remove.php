<?php
require_once 'core/config.php';
require_once 'core/function.php';
$id = $_POST['del_id'];
$success = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$conn = connect();

$sql = "DELETE FROM info WHERE id=".$id;
$result = mysqli_query($conn, $sql);
if($result){
  $success .= 'Животное успешно удалено';
  $success .= '<br>';
  $success .= 'вернуться в админ панель';
  $success .= '<br>';
  $success .= "<a href='/admin.php'><button>админка</button></a>";
  echo $success;
}else{
  $success .= 'Произошла ошибка!!!!!!!!!!';
  $success .= '<br>';
  $success .= 'вернуться в админ панель';
  $success .= '<br>';
  $success .= "<a href='/admin.php'><button>админка</button></a>";
  echo $success;
}
close($conn);
?>