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
        setcookie('bd_create_success', 1, time()+10);
        header('Location: /admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close($conn);
}
// echo "<br><br><a href='/admin.php'><button>админка</button></a>";
// echo '<div><a href="/index.php"><button>Main Page</button></a></div>';

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
            <label for="title">Min description</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>
            <p>Min description:</p>
            <textarea name="descr-min"></textarea>
            <p>Description:</p>
            <textarea name="description"></textarea>
            <p>Photo: <input type="file" name="image"></p>

            <p><input type="submit" value="add"></p>
            <p>tags: <input type="text" name="tag"></p>
        </form>
        </div>
    </div>
</div>



<?php
require_once('template/footer.php');
?>