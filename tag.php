<?php
require_once('template/header.php');
$data = getPostFromTag($conn);
$tag = getAllTags($conn); //возможные теги
$countPageTag = paginationCountTag($conn); //колличество страниц
$currentTag = $_GET['tag'];
close($conn);
?>
<?php
$out = '';
for ($i=0; $i < count($data); $i++){
$out .="<img src='/images/{$data[$i]['image']}' width='100'>";
$out .="<h2>{$data[$i]['title']}</h2>";
$out .="<p>{$data[$i]['descr_min']}</p>";
$out .='<p><a href="/article.php?id='.$data[$i]['id'].'">Read more...</a></p>';
$out .='<hr>';
}
echo $out;
for ($i=0; $i < $countPageTag; $i++){
$j = $i+1;
echo "<a href='/tag.php?tag={$currentTag}&offset={$i}' style='padding: 5px;'>{$j}</a>";
}
echo '<hr>';
echo "<a href='/index.php'>все животные</a>";
for ($i=0; $i < count($tag); $i++){
echo "<a href='/tag.php?tag={$tag[$i]}' style='padding: 5px;'>{$tag[$i]}</a>";
}
// echo "<br><br><a href='/admin.php'><button>админка</button></a>";
?>
<?php
require_once('template/footer.php');
?>