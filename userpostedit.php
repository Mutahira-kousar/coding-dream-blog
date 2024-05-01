<?php
include_once "connect.php";
include_once "header.php";
if (!isset($_SESSION['id'])) {
    header("Location: logout.php");
}

if ($logrole != 'user') {
    header("Location: logout.php");
}else{
	include_once "user.php";
}

// Fetch post details based on post ID
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $post_id = $_GET['edit'];
    $query = "SELECT * FROM posts WHERE id = $post_id AND posted_by = '$logid'";
    $result = $db->query($query);
    $post = $result->fetch_assoc();
} else {
    header("Location: userposts.php");
}

?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Edit Blog Post</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>
            <form method="post" enctype="multipart/form-data">
				<input type="hidden" name="current_image" value="<?php if(isset($post['image'])){echo $post['image']; } ?>">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo $post['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <?php
                        $query = "SELECT * FROM categories";
                        $result = $db->query($query);
                        while ($category = $result->fetch_assoc()) {
                            $selected = ($category['id'] == $post['category_id']) ? 'selected' : '';
                            echo "<option value='" . $category['id'] . "' $selected>" . $category['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="<?php echo $post['tags']; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $post['description']; ?></textarea>
                </div>
      
                <input type="submit" class="btn btn-info" value="Update Post" name="submit">
            </form>


			<?php 
if (isset($_POST['submit'])) {
    $title = $_POST["title"];
    $category = $_POST["category"];
    $tags = $_POST["tags"];
    $description = $_POST["description"];
    
    $currentImage = $_POST["current_image"]; 

    
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $temp_file = $_FILES["image"]["tmp_name"];
        $image_name = $_FILES["image"]["name"];
        $upload_dir = "images/"; 
        $image_path = $upload_dir . $image_name;

        if (move_uploaded_file($temp_file, $image_path)) {
            
			$updateQuery = "UPDATE posts SET 
				title = '$title',
				category_id = $category,
				tags = '$tags',
				description = '$description',
				status = '0',
				image = '$image_path'
			WHERE id = $post_id";
            
            if ($db->query($updateQuery) === true) {
                echo "<h4 class='alert alert-success'>Post updated successfully, wait for approval.</h4>";
            } else {
                echo "Error: " . $db->error;
            }
        } else {
            echo "<h4 class='text-danger'>Error while uploading image.</h4>";
        }
    } else {
        
        $updateQuery = "UPDATE posts SET 
                          title = '$title',
                          category_id = $category,
                          tags = '$tags',
                          description = '$description',
                          status = '0',
                          image = '$currentImage' 
                        WHERE id = $post_id";
        
        if ($db->query($updateQuery) === true) {
            echo "<h4 class='alert alert-success'>Post updated successfully, wait for approval.</h4>";
        } else {
            echo "Error: " . $db->error;
        }
    }
}
?>




        </div>
    </div>
</main>


