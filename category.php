<?php
require_once('template/header.php');
$data = getPostFromCategory($conn);
$cat = getCatInfo($conn);
$countPageCat = paginationCountCat($conn);
$currentCat = $cat['id'];
close($conn);
?>
<?php
// var_dump($_GET['id']);
echo "<h1>{$cat['category']}</h1>";
$out = '';
for ($i=0; $i < count($data); $i++){
$out .="<img src='/images/{$data[$i]['image']}' width='100'>";
$out .="<h2>{$data[$i]['title']}</h2>";
$out .="<p>{$data[$i]['descr_min']}</p>";
$out .='<p><a href="/article.php?id='.$data[$i]['id'].'">Read more...</a></p>';
$out.='<hr>';
}
echo $out;
?>
<hr>
<?php
for ($i=0; $i < $countPageCat; $i++){
$j = $i+1;
echo "<a href='/category.php?id={$currentCat}&offset={$i}' style='padding: 5px;'>{$j}</a>";
}
echo '<br>';
echo $cat['description'];
?>
<?php
require_once('template/footer.php');
?>