<?php
require_once('template/header.php');
$data = selectMain($conn);
$countPage = paginationCount($conn);
$tag = getAllTags($conn);
$cat = getAllCatInfo($conn);
close($conn);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <?php
                $out = '';
                for ($i=0; $i < count($data); $i++){
                $out .='<div class="col-lg-4 col-md-6">';
                    $out .='<div class="card">';
                        $out .="<img src='/images/{$data[$i]['image']}' class='card-img-top'>";
                        $out .='<div class="card-body">';
                            $out .="<h5 class='card-title'>{$data[$i]['title']}</h5>";
                            $out .="<p class='card-text'>{$data[$i]['descr_min']}</p>";
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
            <?php
            $out = '<div class="list-group">';
                for ($i=0; $i < count($cat); $i++){
                $out .='<a class="list-group-item list-group-item-action" href="/category.php?id='.$cat[$i]['id'].'">';
                $out .= $cat[$i]['description'].'</a>';
                }
                echo $out;
            echo '</div>';
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <nav class="mt-4">
                <ul class="pagination">
                    <?php
                    for ($i=0; $i < $countPage; $i++){
                    $j = $i+1;
                    echo "<li class='page-item'><a href='/index.php?page={$i}' style='padding: 5px;' class='page-link'>{$j}</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="col-lg-12 text-center">
            <?php
            for ($i=0; $i < count($tag); $i++){
            echo "<a href='/tag.php?tag={$tag[$i]}' style='padding: 5px;' class='badge badge-info p-2 m-1'>{$tag[$i]}</a>";
            }
            ?>
        </div>
    </div>
</div>
<?php
// echo "<br><br><a href='/admin.php'><button>админка</button></a>";
?>
<?php
require_once('template/footer.php');
?>