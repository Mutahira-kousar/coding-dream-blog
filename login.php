<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php include_once "navbar.php"; ?>




<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Login Form</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>



<div class="card border-0 shadow rounded-5">
  <div class="card-body">
    
<form method="post" class="mt-3">
  



  <div class="form-group">  
    <input type="email" name="email" id="email" placeholder="Your Email" class="form-control p-4 rounded-5"  required>
  </div>
  
  
  
  <div class="form-group">  
    <input type="password" name="password" id="password" placeholder="Your Password" class="form-control p-4 rounded-5"  required>
  </div>
  
  <a href="reset.php" class="float-right mt-1"><u>Recover Password ?</u></a>

  
  <div class="mb-0">
    <input type="submit" name="submit" value="Login" class="btn btn-info p-3 rounded-5 px-5">
  </div>
  



  </form>
  
  
  
  <?php 
  
  
  if(isset($_POST['submit'])){
  
  
  
  $email      = $_POST['email'];
  $password   = $_POST['password'];
  
  
  
  $query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' ";
  
  $result   = $db->query($query);
  $rows  	  = $result->num_rows;
  
  
  
  if($rows == 0){ ?>
  
  
  <p class="alert alert-warning rounded-5 mb-0 mt-3">Email or Password is not correct.</p>
  
  
  <?php
  
  
  }else{ 
  
  
  $row  = $result->fetch_assoc();
  
  $id                 = $row['id'];
  $role               = $row['role'];
  
  $_SESSION['id']     = $id;
  $_SESSION['role']   = $role;
  header("Location: backend.php");
  
  
  
  
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


