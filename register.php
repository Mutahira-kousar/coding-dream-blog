<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php include_once "navbar.php"; ?>




<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Registration Form</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>

<div class="card border-0 shadow rounded-5">
  <div class="card-body">
    
<form method="post" class="mt-3">
  

  <div class="form-group">  
    <input type="text" name="name" id="name" placeholder="Your Name" class="form-control p-4 rounded-5"  required>
  </div>
  
  
  <div class="form-group">  
    <input type="email" name="email" id="email" placeholder="Your Email" class="form-control p-4 rounded-5"  required>
  </div>
  
  
  
  <div class="form-group">  
    <input type="password" name="password" id="password" placeholder="Your Password" class="form-control p-4 rounded-5"  required>
  </div>
  
  
  
  <div class="form-group">  
    <input type="number" name="phone" id="phone" placeholder="Your Phone" class="form-control p-4 rounded-5"  required>
  </div>
  
  
  <div class="form-group">  
    <input type="text" name="city" id="city" placeholder="Your City" class="form-control p-4 rounded-5"  required>
  </div>
  
  
  <div class="mb-0">
    <input type="submit" name="submit" value="Register" class="btn btn-info p-3 rounded-5 px-5">
  </div>
  
  
  </form>
  
  
  <?php 
  
  
  if(isset($_POST['submit'])){
  
  
  
  
  
  $name         = $_POST['name'];
  $email        = $_POST['email'];
  $password     = $_POST['password'];
  $phone        = $_POST['phone'];
  $city         = $_POST['city'];
  
  
  
  $emailCheck          = "SELECT * FROM users WHERE email = '{$email}' ";
  $emailRes         = $db->query($emailCheck);
  $rows           = $emailRes->num_rows;
  
  if($rows > 0){ ?>
  
  
  <p class="alert alert-warning mb-0 mt-3 rounded-5">This email is not available.</p>
  
  
  <?php
  
  
  }else{
  
  
  $createAccount = "INSERT INTO users (name,email,password,phone,city) VALUES ('{$name}','{$email}','{$password}','{$phone}', '{$city}')";
  
  $result = $db->query($createAccount);
  
  if($result){ ?>
  
  
  <p class="alert alert-success mb-0 mt-3 rounded-5">Registration successfull, now you can login.</p>
  
  
  <?php 
  
      } 
  
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


