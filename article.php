<?php
require_once('template/header.php');
$data = selectArticle($conn);
$tag = getArticleTags($conn);
close($conn);
?>
<?php
$out = '';
$out .="<h1>{$data['title']}</h1>";
$out .="<img src='/images/{$data['image']}'>";
$out .="<div>{$data['description']}</div>";
echo $out;
//var_dump($tag);
echo '<hr>';
for ($i=0; $i < count($tag); $i++){
echo "<a href='/tag.php?tag={$tag[$i]['tag']}' style='padding: 5px;'>{$tag[$i]['tag']}</a>";
}
?>
<?php
require_once('template/footer.php');
?>