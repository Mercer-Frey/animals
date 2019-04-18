<?php
require_once('template/header.php');
$data = selectArticle($conn);
$tag = getArticleTags($conn);
close($conn);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                  <?php
                    $out = '';
                    $out .="<h1 class='text-center'>{$data['title']}</h1>";
                    $out .='<div>';
                    $out .="<img src='/images/{$data['image']}' class='img-fluid rounded mx-auto d-block mt-5 mb-5'>";
                    $out .='</div>';
                    $out .="<div>{$data['description']}</div>";
                    echo $out;
                  ?>
                </div>
                <div class="col-lg-12 text-center">
                  <?php
                  for ($i=0; $i < count($tag); $i++){
                  echo "<a href='/tag.php?tag={$tag[$i]['tag']}' style='padding: 5px;' class='badge badge-info p-2 m-1'>{$tag[$i]['tag']}</a>";
                  }
                  ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
          <?php require_once('template/nav.php'); ?>
        </div>
    </div>
</div>
<?php 
  require_once('template/footer.php');
?>