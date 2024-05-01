<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php include_once "navbar.php"; ?>




<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Reset Your Password</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>



<div class="card border-0 shadow rounded-5">
  <div class="card-body">
    
<form method="post" class="mt-3">
  

<div class="form-group">  
    <input type="text" name="username" placeholder="Your Username" class="form-control p-4 rounded-5"  required>
  </div>


  <div class="form-group">  
    <input type="email" name="email" id="email" placeholder="Your Email" class="form-control p-4 rounded-5"  required>
  </div>
  
  

  


 
  <div class="mb-0">
    <input type="submit" name="submit" value="Retrieve" class="btn btn-info p-3 rounded-5 px-5">
  </div>
  



  </form>
  
  
  
  <?php 
  
  
  if(isset($_POST['submit'])){
  
  
  
  $email      = $_POST['email'];
  $username   = $_POST['username'];
  
  
  
  $query = "SELECT * FROM users WHERE email = '{$email}' AND name = '{$username}' ";
  
  $result       = $db->query($query);
  $rows  	    = $result->num_rows;
  
  
  
  if($rows == 0){ ?>
  
  
  <p class="alert alert-warning rounded-5 mb-0 mt-3">Username or Email is not correct.</p>
  
  
  <?php
  
  
  }else{ 
  
  
  $row  = $result->fetch_assoc();
  
  $password  = $row['password'];

  echo "<p class='alert alert-success mt-2'>Your Password is : <b><u>{$password}</u></b></p>";
  


 

  
  
  
  
  } 
  
  } 
  
  ?>
  
  </div>
</div>




</div> 

</div>




</main>



<div class="bottom">

</div>


