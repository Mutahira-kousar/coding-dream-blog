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

if (isset($_POST['submit'])) {
    // Create or Update Advertisement
    $id = $_POST['id'];
    $title = $db->real_escape_string($_POST['title']);
    $description = $db->real_escape_string($_POST['description']);

    // Check if an image was uploaded
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $temp_file = $_FILES["image"]["tmp_name"];
        $image_name = $_FILES["image"]["name"];
        $upload_dir = "img/"; 
        $image_path = $upload_dir . $image_name;

        if (move_uploaded_file($temp_file, $image_path)) {
            // Check if the advertisement is new or an update
            if (!empty($id)) {
                // Update existing advertisement with new image
                $updateQuery = "UPDATE advertisements SET 
                                  title = '$title',
                                  image = '$image_path',
                                  description = '$description'
                                WHERE id = $id";
            } else {
                // Create new advertisement
                $updateQuery = "INSERT INTO advertisements (title, image, description)
                                VALUES ('$title', '$image_path', '$description')";
            }

            if ($db->query($updateQuery) === true) {
                echo "<h4 class='alert alert-success'>Advertisement saved successfully.</h4>";
            } else {
                echo "Error: " . $db->error;
            }
        } else {
            echo "<h4 class='text-danger'>Error while uploading image.</h4>";
        }
    } else {
        // If no new image uploaded, update other fields only
        $updateQuery = "UPDATE advertisements SET 
                          title = '$title',
                          description = '$description'
                        WHERE id = $id";

        if ($db->query($updateQuery) === true) {
            echo "<h4 class='alert alert-success'>Advertisement saved successfully.</h4>";
        } else {
            echo "Error: " . $db->error;
        }
    }
}

if (isset($_GET['delete'])) {
    // Delete Advertisement
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM advertisements WHERE id = $id";

    if ($db->query($deleteQuery) === true) {
        header("Location: ads.php");
    } else {
        echo "Error: " . $db->error;
    }
}

if (isset($_GET['edit'])) {
    // Edit Advertisement
    $id = $_GET['edit'];
    $editQuery = "SELECT * FROM advertisements WHERE id = $id";
    $result = $db->query($editQuery);

    if ($result) {
        $advertisement = $result->fetch_assoc();
    } else {
        echo "Error: " . $db->error;
    }
}



$query = "SELECT * FROM advertisements";
$result = $db->query($query);

// Check if the query was successful before fetching data
if ($result) {
    $advertisements = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: " . $db->error;
}
?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">

             
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Manage Your Advertisements</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>


            <br>

            <!-- Form to add/update advertisement -->
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
                <div class="form-group">
                    <label for="title">Advertisement Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo isset($advertisement['title']) ? $advertisement['title'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="image">Advertisement Image:</label>
                    <input type="file" class="form-control" id="image" name="image" <?php echo isset($advertisement['id']) ? '' : 'required'; ?>>
                </div>
                <div class="form-group">
                    <label for="description">Advertisement Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo isset($advertisement['description']) ? $advertisement['description'] : ''; ?></textarea>
                </div>
                <input type="submit" class="btn btn-info" value="<?php echo isset($_GET['edit']) ? 'Update Advertisement' : 'Save Advertisement'; ?>" name="submit">
            </form>

            <br>
            <h4>Your Advertisements:</h4>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php if (isset($advertisements)) { ?>
                    <?php foreach ($advertisements as $advertisement) { ?>
                        <tr>
                            <td><?php echo $advertisement['id']; ?></td>
                            <td><?php echo $advertisement['title']; ?></td>
                            <td><img src="<?php echo $advertisement['image']; ?>" style="width: 40px; height: 40px;"></td>
                            <td><?php echo $advertisement['description']; ?></td>
                            <td><a class="btn btn-success btn-sm" href="?edit=<?php echo $advertisement['id']; ?>">Edit</a></td>
                            <td><a class="btn btn-danger btn-sm" href="?delete=<?php echo $advertisement['id']; ?>">Delete</a></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
    </div>
</main>


