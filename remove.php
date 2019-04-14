<?php
require_once('template/header.php');
$id = $_POST['del_id'];
$success = '';
?>
<?php
$conn = connect();
$sql = "DELETE FROM info WHERE id=".$id;
$result = mysqli_query($conn, $sql);
$sql = "DELETE FROM tag WHERE post=".$id;
$result = mysqli_query($conn, $sql);
if($result){
$success .= 'Животное успешно удалено';
$success .= '<br>';
$success .= 'вернуться в админ панель';
}else{
$success .= 'Произошла ошибка!!!!!!!!!!';
$success .= '<br>';
$success .= 'вернуться в админ панель';
}
echo $success;
echo '<br>';
echo "<a href='/admin.php'><button>админка</button></a>";
close($conn);
?>
<?php
require_once('template/footer.php');
?>