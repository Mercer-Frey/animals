<?php require_once 'template/include.php'; ?>
<?php require_once 'template/header_admin_create.php'; ?>
<?php require_once('template/header.php');?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <h4 class='text-danger text-center'><?php echo $danger;?></h4>
        <h2>Create post</h2>
            <form action="" method="POST"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div>
                <div class="form-group">
                    <label for="descr-min">Min description</label>
                    <input type="text" name="descr-min" class="form-control" id="descr-min">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                </div>
                <div class="form-group">
                    <label for="tag">Tags</label>
                    <input type="text" name="tag" class="form-control" id="tag" placeholder="one,two">
                </div>
                    
                <div class="form-group text-right">
                    <input type="submit" value="Add new article" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once('template/footer.php');?>