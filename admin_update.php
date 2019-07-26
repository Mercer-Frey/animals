<?php require_once 'template/include.php'; ?>
<?php require_once 'template/header_admin_update.php'; ?>
<?php require_once('template/header.php'); ?>
<div class="container">
    <div class="row">
    <div class="col-lg-12">
    <h4 class='text-danger text-center'><?php echo $danger;?></h4>    
    <h2>Update post id=<?php echo $_GET['id'];?></h2>
    <form action="" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" value="<?php echo $row['title'];?>">
        </div>
        <div class="form-group">
            <label for="descr-min">Min description</label>
            <input type="text" name="descr-min" class="form-control" id="descr-min" value="<?php echo $row['descr_min'];?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description"><?php echo $row['description'];?></textarea>
        </div>
        <div class="form-group">
            <img src="/images/<?php echo $row['image'];?>" alt="">
        </div>
        <div class="form-group">
            <label for="image">Photo</label>
            <input type="file" name="image" class="form-control-file" id="image">
        </div>
        <div class="form-group">
            <label for="tag">Tags</label>
            <input type="text" name="tag" class="form-control" id="tag" placeholder="one,two" value="<?php echo join(',',$t);?>">
        </div>
        <div class="form-group text-right">
            <input type="submit" value="update article" class="btn btn-success">
        </div>
    </form>
        </div>
    </div>
</div>
<?php require_once('template/footer.php'); ?>