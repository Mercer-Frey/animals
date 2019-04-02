<?php
require_once 'core/config.php';
require_once 'core/function.php';

$conn = connect();
$data = select($conn);
close($conn);
$flash='';
if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success']!=''){
    if ($_COOKIE['bd_create_success'] == 1) {
        setcookie('bd_create_success', 1, time()-10);
        $flash =  "New record created successfully";
    }
}?>
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
echo   $flash;
echo '<h2>Admin-panel</h2>';
echo '<div><a href="/admin_create.php"><button>Add new</button></a></div>';
$out = '<table>';
$out .='<tr><th>ID</th><th>Title</th><th>Description min</th><th>Image</th></tr>';
for ($i=0; $i < count($data); $i++){
    $out .="<tr><td>{$data[$i]['id']}</td><td>{$data[$i]['title']}</td><td>{$data[$i]['descr_min']}</td><td><img src='/images/{$data[$i]['image']}' width='70'></td><td><form action='/remove.php' method='post'><input type='hidden' name='del_id' value='{$data[$i]['id']}'><button type='submit'>удолить скотинку</button></form></td></tr>";
}
$out .='</table>';

echo $out;

// var_dump($data);
?>
<input type='hidden' name='del_id' value='{$data[$i]['id']}'>
