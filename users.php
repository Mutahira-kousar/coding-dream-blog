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
  <h1 class="mb-0 text-uppercase display-4">Registered Users</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>


<form method="post">

<div class="form-group">
<input type="text" name="search" placeholder="Search Users" class="form-control p-4 rounded-5" required>
</div>



</form>



<table class="table table-striped table" style="margin-top:1em !important">

<tr>
<th>No</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>City</th>


<th>Update</th>
<th>Delete</th>


</tr>

<?php



if(isset($_POST['search'])){

$search = $_POST['search'];


$query 	= "SELECT * FROM users WHERE (name LIKE '%$search%' OR city = '{$search}' OR email = '{$search}') AND (role = 'user')";

}else{

$query = "SELECT * FROM users WHERE role = 'user' ORDER BY id DESC";

}
$execute 	= $db->query($query);
$numrows 		= $execute->num_rows; 

if($numrows == 0){

	echo '<td>Nothing Found.</td>';

}else{



$no = 0;

while($fetch = $execute->fetch_assoc()){

$id 		= $fetch['id'];
$name 		= $fetch['name'];
$email 		= $fetch['email'];
$phone 		= $fetch['phone'];
$city 		= $fetch['city'];



$no++;

?>


<tr>

<td><?php echo $no ?></td>
<td><?php echo $name ?></td>
<td><?php echo $email ?></td>
<td><?php echo $phone ?></td>
<td><?php echo $city ?></td>



<td><a  class="btn btn-info btn-sm" href="useredit.php?user=<?php echo $id ?>">Update</a></td>
<td><a  class="btn btn-danger btn-sm" href="users.php?del=<?php echo $id ?>">X</a></td>


</tr>


<?php
}

}

?>


</tbody>
</table>






<?php














if(isset($_GET['del'])){

$id 	= $_GET['del'];
$query 	= "DELETE FROM users WHERE id = '{$id}' ";
$execute = $db->query($query);

if($execute){

header("Location: users.php");

}

}


?>











</div> 

</div>




</main>






<div class="<?php if($no < 7){echo 'bottom'; } ?>">

</div>

