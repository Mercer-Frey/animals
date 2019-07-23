<?php require_once 'template/include.php'; ?>
<?php
    if(isset($_COOKIE['user']) AND $_COOKIE['user'] != '' AND intval(json_decode($_COOKIE['user'])->{'id'}) === 1 ){
    }else {
        header("Location: /logout.php");
    };
    if (isset($_POST['title'])) {
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
        if (isset($_POST['title']) AND $_POST['title'] !=false) {
            if(isset($descrMin) AND $descrMin != false){
                if(isset($description) AND $description != false){
                    if(isset($newTags) AND $newTags != false){
                        $conn = connect();
                        if ($_FILES['image']['name']!='') {
                            move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);
                            $sql = "UPDATE info set title = '".$title."', descr_min = '".$descrMin."', description = '".$description."', image = '".$_FILES['image']['name']."' WHERE id=".$_GET['id'];
                        }
                        else {
                            $sql = "UPDATE info set title = '".$title."', descr_min = '".$descrMin."', description = '".$description."' WHERE id=".$_GET['id'];
                        }

                        if (mysqli_query($conn, $sql)) {
                            $sql = "DELETE FROM tag WHERE post=".$_GET['id'];
                            mysqli_query($conn, $sql);

                            for ($i = 0; $i < count($newTags); $i++){
                                $sql = "INSERT INTO tag (tag, post) VALUES ('".$newTags[$i]."', ".$_GET['id'].")";
                                mysqli_query($conn, $sql);
                            }
                            setcookie('bd_create_success', 1, time()+10);
                            header('Location: /admin');
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                        close($conn);
                    } else $danger = "write in at least one tag";
                } else $danger = "write in description";
            } else $danger = "write in min description";
        } else $danger = "write in title";
    }else
?>
<?php
    $sql = 'SELECT * FROM info WHERE id='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql = 'SELECT tag FROM tag WHERE post='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $t = array();
    while($tag = mysqli_fetch_assoc($result)) {
        $t[] = $tag['tag'];
    }
?>
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