<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php if(!isset($_SESSION['id'])){ header("Location: logout.php"); } ?>



<?php if($logrole == 'admin'){ ?>

<?php include_once "admin.php"; ?>

<?php }else{ ?>

<?php include_once "user.php"; ?>

<?php } ?>







<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Welcome To Your Account</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>


<table class="table table-bordered table-striped">
  
<?php 

$query       = "SELECT * from users WHERE id = '{$logid}' LIMIT 1 ";
$result      = $db->query($query);
$count       = $result->num_rows;

if($count == 0){

  echo '<p>No Record.</p>';


}else{

$row          = $result->fetch_assoc();
$id           = $row['id'];
$name         = $row['name'];
$email        = $row['email'];
$phone        = $row['phone'];
$city         = $row['city'];

?>
  

<tr>
  <th>Name</th>
  <td><?php echo $name ?></td>
</tr>


<tr>
  <th>Email</th>
  <td><?php echo $email ?></td>
</tr>




<tr>
  <th>Phone</th>
  <td><?php echo $phone ?></td>
</tr>


<tr>
  <th>City</th>
  <td><?php echo $city ?></td>
</tr>


<?php } ?>

</table>







</div> 

</div>




</main>





<div class="bottom">

</div>



