<?php require_once 'template/include.php'; ?>
<?php
require_once('template/header.php');
$data = selectMain($conn);
$countPage = paginationCount($conn);
$tag = getAllTags($conn);
close($conn);
echo $_SESSION;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <?php
                $out = '';
                for ($i=0; $i < count($data); $i++){
                mb_internal_encoding('UTF-8');
                $data_short = mb_strimwidth($data[$i]['descr_min'], 0, 75, '...');
                $out .='<div class="col-lg-4 col-md-6">';
                    $out .='<div class="card">';
                        $out .="<div style='background-image: url(/images/{$data[$i]['image']});' class='card-img-top'></div>";
                        $out .='<div class="card-body">';
                            $out .="<h5 class='card-title'>{$data[$i]['title']}</h5>";
                            $out .="<p class='card-text'>{$data_short}</p>";
                            $out .='<p class="text-right"><a href="/article/'.$data[$i]['id'].'" class="btn btn-primary">Read more...</a></p>';
                        $out .='</div>';
                    $out .='</div>';
                $out .='</div>';
                }
                echo $out;
                ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?php require_once('template/nav.php') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <nav class="mt-4">
                <ul class="pagination">
                    <?php
                    for ($i=0; $i < $countPage; $i++){
                    $j = $i+1;
                        echo "<li class='page-item'><a href='/index.php?page={$i}' style='padding: 5px;' class='page-link mr-2'>{$j}</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php
            for ($i=0; $i < count($tag); $i++){
                echo "<a href='/tag.php?tag={$tag[$i]}' style='padding: 5px;' class='badge badge-info p-2 m-1'>{$tag[$i]}</a>";
            }
            ?>
        </div>
    </div>
</div>
<?php require_once('template/footer.php');?>