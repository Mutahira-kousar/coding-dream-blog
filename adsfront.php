<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php include_once "navbar.php"; ?>




<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Ads</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>






</div> 




<div class="row">


<?php 

$posts 	= "SELECT * FROM advertisements";
$result 		= $db->query($posts);
$num 			= $result->num_rows;

if($num == 0){

echo '<p>No Record.</p>';

}else{

$no = 0;
while($row = $result->fetch_assoc()){


$id 			= $row['id'];
$title 			= $row['title'];
$image 			= $row['image'];
$description 	= $row['description'];
               

$no++;

?>

<div class="col-md-6 col-sm-6 col-lg-6">
    <div class="card flex-md-row mb-4 h-md-250 border-0 shadow rounded-5" style="height: 300px;">
        <div class="card-body d-flex flex-column align-items-start">
            <h3 class="d-inline-block mb-2 text-dark text-uppercase"><?php echo $title ?></h3>
            <p class="card-text mb-auto text-muted mt-3" style="overflow-y: auto;"><small><?php echo $description; ?></small></p>
        </div>
        <img class="card-img-right flex-auto d-none d-lg-block img rounded-right-5" src="<?php echo $image ?>" style="width: 200px; height: auto; object-fit: cover">
    </div>
</div>






<?php }} ?>






</div>











</main>



<div class="bottom">

</div>


