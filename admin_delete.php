<?php require_once 'template/include.php'; ?>
<?php
    if(isset($_COOKIE['user']) AND $_COOKIE['user'] != '' AND intval(json_decode($_COOKIE['user'])->{'id'}) === 1 ){
    }else {
        header("Location: /logout");
    };
if(isset($_GET['id'])){
	$data = deleteArticle($conn,$_GET['id']);
}
else{
	header('Location: /');
}
require_once('template/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
                if ($data === true) {
                    echo 'Article was deleted';
                }
                else {
                    echo 'Error!'.$data;
                }
            ?>
        </div>
    </div>
</div>
<?php close($conn); ?>
<?php require_once('template/footer.php'); ?>