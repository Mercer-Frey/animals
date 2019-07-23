<?php require_once 'template/include.php'; ?>
<?php
    if(isset($_COOKIE['user']) AND $_COOKIE['user'] != '' AND intval(json_decode($_COOKIE['user'])->{'id'}) === 1 ){
    }else {
        header("Location: /logout.php");
    };
    $data = select($conn);
    close($conn);
    $flash='';
    if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success']!=''){
        if ($_COOKIE['bd_create_success'] == 1) {
            setcookie('bd_create_success', 1, time()-10);
            $flash =  "<h3 class='text-center text-success'>New record created successfully</h3>";
        } 
    }
    require_once('template/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <?php
            echo   $flash;
            echo '<h2>Admin-panel</h2>';
            echo '<div class="mt-2 mb-2 text-right">';
            echo '<a href="/"><button class="btn btn-primary mr-2">Main Page</button></a>';
			echo '<a href="/admin-create"><button class="btn btn-success">Add new</button></a></div>';

            $out = '<table  class="table table-striped">';
            $out .='<tr><th>ID</th><th>Title</th><th>Description min</th><th>Image</th><th>Article</th><th>Update</th><th>Action</th></tr>';
            for ($i=0; $i < count($data); $i++){
            $out .="<tr class='admin-tr'>
                        <td>{$data[$i]['id']}</td>
                        <td>{$data[$i]['title']}</td>
                        <td>{$data[$i]['descr_min']}</td>
                        <td><img src='/images/{$data[$i]['image']}' width='40'></td>
                        <td><a href='/article/{$data[$i]['id']}' class='btn btn-primary p-2'>read</a></td>
                        <td><a href='/admin-update/{$data[$i]['id']}' class='btn btn-success p-2'>update</a></td>
                        <td><a data='{$data[$i]['id']}' class='check-delete btn btn-danger text-white p-2'>удолить скотинку</a></td>
                    </tr>";
            }
            $out .='</table>';
            echo $out;
            ?>
        </div>
    </div>
</div>
<script>
    window.onload= function(){
        let checkDelete = document.querySelectorAll('.check-delete');
        checkDelete.forEach(function(element){
            element.onclick = checkDeleteFunction;
        })
        function checkDeleteFunction(event){
            event.preventDefault();
            let a = confirm('Не жалко? :(');
            if (a == true) {
                location.href = '/admin_delete.php?id='+this.getAttribute('data');
            }
            return false;
        }
    }
</script>
<?php
require_once('template/footer.php');
?>
