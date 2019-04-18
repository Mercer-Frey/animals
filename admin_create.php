<?php
require_once('template/header.php');
?>
<?php
if (isset($_POST['title']) AND $_POST['title'] !='') {
    $title = $_POST['title'];
    $descrMin = $_POST['descr-min'];
    $description = $_POST['description'];
    $tags = trim($_POST['tag']);
    $tags = explode(",", $tags);
    $newTags = [];
    for ($i = 0; $i < count($tags); $i++){
        if (trim($tags[$i])!='') { 
            $newTags[] = trim($tags[$i]);
        }
    }
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);
    $conn = connect();
    $sql = "INSERT INTO info (title, descr_min, description, image) VALUES ('".$title."', '".$descrMin."', '".$description."', '".$_FILES['image']['name']."')";
    if (mysqli_query($conn, $sql)) {
        $lastId = mysqli_insert_id ($conn);
        for ($i = 0; $i < count($newTags); $i++){
            $sql = "INSERT INTO tag (tag, post) VALUES ('".$newTags[$i]."', ".$lastId.")";
            mysqli_query($conn, $sql);
        }
        // var_dump($lastId); 
        // setcookie('bd_create_success', 1, time()+10);
        // header('Location: /admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close($conn);
}
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
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
<?php
require_once('template/footer.php');
?>