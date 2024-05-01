<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php if(!isset($_SESSION['id'])){ header("Location: logout.php"); } ?>



<?php if($logrole == 'admin'){ ?>

<?php include_once "admin.php"; ?>

<?php }else{ header("Location: logout.php"); } ?>







<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Manage Post Topics/Categories</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>





<?php 



	if(isset($_GET['edit'])){


		$edit = $_GET['edit'];

		$catEdit 	= "SELECT * FROM categories WHERE id = '{$edit}' ";
		$catRun 	= $db->query($catEdit);
		$catrow 	= $catRun->fetch_assoc();
		$catid 		= $catrow['id'];
		$catName 	= $catrow['name'];



	}



 ?>



<?php 


if(isset($_POST['updatecategory'])){

$id 	= $_POST['id'];
$name 	= $_POST['update'];

$update = "UPDATE categories SET name = '{$name}' WHERE id = '{$id}' ";
$run  	 	 = $db->query($update);

if($run){

header("Location: category.php");

}



}



?>


<form method="post">


<input type="hidden" name="id" value="<?php if(isset($catid)){echo $catid; } ?>">


<input type="text" class="form-control p-4 rounded-5" name="<?php if(isset($catName)){echo 'update';}else{echo 'cat'; } ?>" value="<?php if(isset($catName)){echo $catName; } ?>" placeholder="Add Category" required>


<?php if(isset($catName)){

echo '<input type="submit" value="Update" class="btn btn-warning btn-sm mt-2" name="updatecategory">';

}else{ ?>

<input type="submit" value="Add" class="btn btn-info btn-sm mt-2 rounded-5 p-3 px-5" name="addcategory">

<?php } ?>



</form>




<?php 


if(isset($_POST['addcategory'])){

$cat = $_POST['cat'];

$addcategory = "INSERT INTO categories (name) VALUES ('{$cat}') ";
$run  	 	 = $db->query($addcategory);

if($run){

header("Location: category.php");

}



}



?>


<br>
<table class="table table-striped table-bordered">

<tr>
<th>No</th>
<th>Category</th>
<th>Edit</th>
<th>Delete</th>
</tr> 






<?php 

$categories 	= "SELECT * FROM categories ORDER BY id DESC";
$run 	= $db->query($categories);


if($run->num_rows == 0){

echo "<td>No Category.</td>";


}else{

$no = 0;
while($get = $run->fetch_assoc()){

$id 	= $get['id'];
$name 	= $get['name'];



$no++;


?>
<tr>
<td><?php echo $no ?></td>
<td><?php echo $name ?></td>




<td width="10"><a class="btn btn-info btn-sm" href="category.php?edit=<?php echo $id ?>">Edit</a></td>
<td width="10"><a class="btn btn-danger btn-sm" href="category.php?remove=<?php echo $id ?>">X</a></td>

</tr>

<?php



}



}


?>



   

</table>

<?php 

if(isset($_GET['remove'])){

$id 		= $_GET['remove'];
$remove 	= "DELETE FROM categories WHERE id = '{$id}' ";
$run 		= $db->query($remove);

if($run){

header("Location: category.php");

}





}


?>





</div> 

</div>




</main>






<div class="bottom">

</div>


