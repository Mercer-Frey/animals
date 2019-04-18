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
?>
<div class="container">
  <div class="row">
    <div class="col-lg-6 offset-lg-3 text-center">
      <?php
        if($result){
          $success .= '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Животное успешно удалено!</h4>';
        }else{
          $success .= '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Произошла ошибка!</h4>';
        }
        $success .= 'Вернуться в админ панель';
        echo $success;
        echo '<br><hr>';
        echo "<a href='/admin.php'><button class='btn btn-danger mr-2'>Admin Panel</button></a></div>";
        close($conn);
      ?>
    </div>
  </div>
</div>
<?php
require_once('template/footer.php'); 
?>