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