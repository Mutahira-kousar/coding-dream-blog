<?php
include_once "connect.php";
include_once "header.php";
if (!isset($_SESSION['id'])) {
    header("Location: logout.php");
}

if ($logrole == 'user') {
    include_once "user.php";
} else {
    header("Location: logout.php");
}



$search = (isset($_POST['search'])) ? $_POST['search'] : '';

$sortOrder = (isset($_GET['sort'])) ? $_GET['sort'] : 'id DESC';
$allowedSortColumns = array('id', 'title', 'category_id', 'date');
$sortColumn = 'id';
$sortDirection = 'DESC';


if (isset($_GET['sort']) && in_array($_GET['sort'], $allowedSortColumns)) {
    $sortColumn = $_GET['sort'];
    $sortDirection = (isset($_GET['dir']) && strtoupper($_GET['dir']) === 'ASC') ? 'ASC' : 'DESC';
}

$sortOrder = $sortColumn . ' ' . $sortDirection;

if ($search !== '') {
    
    $query = "SELECT * FROM posts WHERE posted_by = '$logid' AND title LIKE '%$search%' OR tags LIKE '%$search%' ORDER BY $sortOrder";
} else {
    
    $query = "SELECT * FROM posts WHERE posted_by = '$logid' ORDER BY $sortOrder";
}

$result = $db->query($query);
?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <blockquote class="blockquote text-center mb-5">
            <h1 class="mb-0 text-uppercase display-4">Manage Posts</h1>
            <footer class="blockquote-footer">Coding Dream Blog</footer>
            </blockquote>
            <form method="post">
                <input class="form-control" type="text" name="search" id="search" placeholder="Search Posts" autocomplete="off" required value="<?php echo $search; ?>">
            </form><br>
            <table class="table table-striped">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center"><a href="?sort=title&dir=<?php echo ($sortColumn === 'title' && $sortDirection === 'ASC') ? 'DESC' : 'ASC'; ?>">Title</a></th>
                    <th class="text-center"><a href="?sort=category_id&dir=<?php echo ($sortColumn === 'category_id' && $sortDirection === 'ASC') ? 'DESC' : 'ASC'; ?>">Category</a></th>
                    <th class="text-center">Image</th>
                    <th class="text-center"><a href="?sort=date&dir=<?php echo ($sortColumn === 'date' && $sortDirection === 'ASC') ? 'DESC' : 'ASC'; ?>">Date</a></th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Comments/QA</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $catid = $row['category_id'];

					
					$catnameQuery = "SELECT * FROM categories WHERE id = '{$catid}' LIMIT 1";
					$catresult = $db->query($catnameQuery);
					$catrow = $catresult->fetch_assoc();
					$catnum = $catresult->num_rows;
					if($catnum == 0){
						$category = 'Uncategorized';
					}else{
					$category = $catrow['name'];
					}


			


					$image = $row['image'];
					$date = $row['date'];
					$date = date("F j, Y", strtotime($date));
					$tags = $row['tags'];
					$description = $row['description'];


                    $status = $row['status'];
                ?>
                    <tr class="text-center">
                        <td><?php echo $no ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $category ?></td>
                        <td><img src="<?php echo $image ?>" style="width: 40px; height: 40px"></td>
                        
                        <td><?php echo $date ?></td>
                  
                        
                        <?php if ($status === '0') { ?>
                            <td>Pending</td>
                            <td>-</td>
                        <?php } else { ?>
                            <td>Approve</td>
                            <td><a class="btn btn-info btn-sm" href="usercomments.php?post=<?php echo $id ?>">View</a></td>
                        <?php } ?>
                        <td><a class="btn btn-success btn-sm" href="userpostedit.php?edit=<?php echo $id ?>">Edit</a></td>
                        <td><a class="btn btn-danger btn-sm" href="userposts.php?delete=<?php echo $id ?>">X</a></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </table>
        </div>
    </div>
</main>

<?php 
    

    
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE id = $post_id AND posted_by = '$logid'";
        $result = $db->query($query);
        if ($result) {
            header("Location: userposts.php");
        }
    }




?>

<div class="bottom">
    
</div>
