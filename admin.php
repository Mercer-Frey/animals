<?php
require_once('template/header.php');
$data = select($conn);
close($conn);
$flash='';
if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success']!=''){
if ($_COOKIE['bd_create_success'] == 1) {
setcookie('bd_create_success', 1, time()-10);
$flash =  "New record created successfully";
} 
}?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <?php
            echo   $flash;
            echo '<h2>Admin-panel</h2>';
            echo '<div class="mt-2 mb-2 text-right">';
            echo '<a href="/index.php"><button class="btn btn-primary mr-2">Main Page</button></a>';
			echo '<a href="/admin_create.php"><button class="btn btn-success">Add new</button></a></div>';

            $out = '<table  class="table table-striped">';
            $out .='<tr><th>ID</th><th>Title</th><th>Description min</th><th>Image</th></tr>';
            for ($i=0; $i < count($data); $i++){
            $out .="<tr><td>{$data[$i]['id']}</td><td>{$data[$i]['title']}</td><td>{$data[$i]['descr_min']}</td><td><img src='/images/{$data[$i]['image']}' width='40'></td><td><form action='/remove.php' method='post'><input type='hidden' name='del_id' value='{$data[$i]['id']}'><button type='submit' class='btn btn-danger' >удолить скотинку</button></form></td></tr>";
            }
            $out .='</table>';
            echo $out;
            ?>
        </div>
    </div>
</div>
<?php
require_once('template/footer.php');
?>

