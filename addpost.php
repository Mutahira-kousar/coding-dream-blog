<?php
include_once "connect.php";
include_once "header.php";
if (!isset($_SESSION['id'])) {
    header("Location: logout.php");
}

if ($logrole == 'admin') {
    include_once "admin.php";
} else {
    header("Location: logout.php");
}


$query      = "SELECT * FROM categories";
$result     = $db->query($query);
$categories = $result->fetch_all(MYSQLI_ASSOC);

?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
             
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Add Blog Post</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <?php
                        foreach ($categories as $category) {
                            echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" class="form-control" id="tags" name="tags">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="0">Pending</option>
                        <option value="1">Published</option>
                    </select>
                </div>
				<input type="submit" class="btn btn-info" value="Create Post" name="submit">
            </form>

<?php


if (isset($_POST['submit'])) {
    
    $title       = $_POST["title"];
    $category    = $_POST["category"];
    $tags        = $_POST["tags"];
    $description = $db->real_escape_string($_POST["description"]);
    $status      = $_POST["status"];

    
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $temp_file = $_FILES["image"]["tmp_name"];
        $image_name = $_FILES["image"]["name"];
        $upload_dir = "images/"; 
        $image_path = $upload_dir . $image_name;

        
        if (move_uploaded_file($temp_file, $image_path)) {
            

            
            $check_duplicate_query = "SELECT COUNT(*) AS count FROM posts 
                                      WHERE title = '$title' AND category_id = $category AND posted_by = $logid";
            $result = $db->query($check_duplicate_query);
            $row = $result->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                
                echo "<h4 class='alert alert-warning'>You already add this Post.</h4>";

            } else {
                
                $createPost = "INSERT INTO posts (category_id, title, image, tags, description, posted_by, date, status)
                                 VALUES ($category, '$title', '$image_path', '$tags', '$description', '$logid', NOW(), '$status')";
                if ($db->query($createPost) === true) {
                    
                    echo "<h4 class='alert alert-success'>Post added successfully.</h4>";

                } else {
                    
                    echo "Error: " . $db->error;
                }
            }
        } else {
            
            echo "<h4 class='text-danger'>Error while uploading image.</h4>";
        }
    } else {
        
        echo "<h4 class='text-danger'>Error while uploading image.</h4>";
    }
}
?>




            
        </div>
    </div>
</main>


