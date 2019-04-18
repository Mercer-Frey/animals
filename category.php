<?php
require_once('template/header.php');
$data = getPostFromCategory($conn);
$catList = getCatInfo($conn);
$countPageCat = paginationCountCat($conn);
$currentCat = $catList['id'];
close($conn);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                <?php
                    echo "<h1>{$catList['category']}</h1>";
                ?>
                </div>
                <div class="col-lg-12">
                    <?php
                        echo "<div class='mb-5 mt-5'>".$catList['description']."</div>";
                    ?>
                </div>
            </div>
            <div class="row">
            <?php
                $out = '';
                for ($i=0; $i < count($data); $i++){
                    $substrDescr = substr($data[$i]['descr_min'], 0, 111). ' ...';
                    $out .='<div class="col-lg-4 col-md-6">';
                    $out .='<div class="card">';
                    $out .="<img src='/images/{$data[$i]['image']}' class='card-img-top'>";
                    $out .='<div class="card-body">';
                    $out .="<h5 class='card-title'>{$data[$i]['title']}</h5>";
                    $out .="<p class='card-text'>{$substrDescr}</p>";
                    $out .='<p class="text-right"><a href="/article.php?id='.$data[$i]['id'].'" class="btn btn-primary">Read more...</a></p>';
                    $out .='</div>';
                    $out .='</div>';
                    $out .='</div>';
                }
                echo $out;
                ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?php require_once('template/nav.php'); ?>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <nav class="mt-4">
                <ul class="pagination">
                    <?php
                    for ($i=0; $i < $countPageCat; $i++){
                      $j = $i+1;
                      echo "<li class='page-item'><a href='/category.php?id={$currentCat}&offset={$i}' style='padding: 5px;' class='page-link'>{$j}</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
require_once('template/footer.php');
?>