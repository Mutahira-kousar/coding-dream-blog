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
  <h1 class="mb-0 text-uppercase display-4">Update User Detail</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>




<?php 


if(isset($_GET['user'])){

$user 			= $_GET['user'];
$userUpdate 	= "SELECT * FROM users WHERE id = '{$user}'";

$result 		= $db->query($userUpdate);
$row 			= $result->fetch_assoc();
$id 			= $row['id'];
$name 			= $row['name'];
$email 			= $row['email'];
$password 		= $row['password'];
$phone 			= $row['phone'];
$city 			= $row['city'];


?>



<form method="post">


<input type="hidden" name="id" value="<?php if(isset($id)){echo $id; } ?>">


<div class="form-group">
<input type="text" name="name" placeholder="Name" required class="form-control" value="<?php if(isset($name)){echo $name; } ?>">
</div>


<div class="form-group">
<input type="email" name="email" placeholder="Email" readonly class="form-control" value="<?php if(isset($email)){echo $email; } ?>">
</div>


<div class="form-group">
<input type="password" name="password"  placeholder=" Password" class="form-control" value="<?php if(isset($password)){echo $password; } ?>" required>
</div>

<div class="form-group">
<input type="number" name="phone" placeholder="Phone" class="form-control" value="<?php if(isset($phone)){echo $phone; } ?>" required>
</div>


<div class="form-group">
<input type="text" name="city" placeholder="City"  class="form-control" value="<?php if(isset($city)){echo $city; } ?>" required>
</div>








<input type="submit" name="submit" class="btn btn-info" value="Update">



</form>



<?php



if(isset($_POST['submit'])){

$id 		= $_POST['id'];
$name 		= $_POST['name'];
$email 		= $_POST['email'];
$password 	= $_POST['password'];
$phone 	= $_POST['phone'];
$city 		= $_POST['city'];






$updateSetting = "UPDATE users SET 

name 		= '{$name}', 
email 		= '{$email}', 
password 	= '{$password}', 
phone 		= '{$phone}',
city 		= '{$city}'


WHERE id = '{$id}'  ";

$result = $db->query($updateSetting);

if($result){

echo "<h5 class='alert alert-info'> User Info is Updated.</h5>";


}


}




?>


<?php


	}




 ?>









</div> 

</div>




</main>






<div class="bottom">

</div>


