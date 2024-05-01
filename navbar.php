<nav class="navbar navbar-expand-md navbar-light fixed-top bg-info">
  <a class="navbar-brand text-light text-uppercase" href="#">Coding Dream Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mx-auto">

    

       <li class="nav-item">
        <a class="nav-link fw-bold text-light text-uppercase" href="index.php">Home</a>
      </li> 









<?php 

  $query = "SELECT * FROM categories";
  $result = $db->query($query);
  $num = $result->num_rows;
  if($num == 0){

  }else{

    while($row = $result->fetch_assoc()){

      $id     = $row['id'];
      $name   = $row['name'];

      ?>


     <li class="nav-item">
        <a class="nav-link fw-bold text-light text-uppercase" href="searchposts.php?cat=<?php echo $id ?>"><?php echo ucfirst($name); ?></a>
      </li>  

      <?php

    }
  }

 ?>




<li class="nav-item">
        <a class="nav-link fw-bold text-light text-uppercase" href="adsfront.php">Ads</a>
      </li> 

<?php if(isset($logid)){ ?>


      <li class="nav-item">
        <a class="nav-link fw-bold text-light text-uppercase" href="backend.php">Account</a>
      </li> 

<?php }else{ ?>


      <li class="nav-item">
        <a class="nav-link fw-bold text-light text-uppercase" href="login.php">Login</a>
      </li> 

       <li class="nav-item">
        <a class="nav-link fw-bold text-light text-uppercase" href="register.php">Register</a>
      </li>


<?php


  }



 ?>







      
    </ul>


    <form class="form-inline my-2 my-lg-0" method="get" action="searchposts.php">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search Posts" aria-label="Search" autocomplete="off">
    </form>

  </div>
</nav>