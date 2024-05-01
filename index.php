<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php include_once "navbar.php"; ?>




<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Our Posts</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>




<div class="row">


<?php 

$posts 	= "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC";
$result 		= $db->query($posts);
$num 			= $result->num_rows;

if($num == 0){

echo '<p>No Record.</p>';

}else{

$no = 0;
while($row = $result->fetch_assoc()){

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


$posted_by = $row['posted_by'];
$postedbyQuery = "SELECT * FROM users WHERE id = '{$posted_by}' LIMIT 1";
$postedbyResult = $db->query($postedbyQuery);
$postedbyRow = $postedbyResult->fetch_assoc();
$postedbyNum = $postedbyResult->num_rows;
if($postedbyNum == 0){
$posted_by = 'Unknown';
}else{
$posted_by = $postedbyRow['name'];
}


$image = $row['image'];
$date = $row['date'];
$date = date("F j, Y", strtotime($date));
$tags = $row['tags'];
$description = $row['description'];


               

$no++;

?>



  <div class="col-md-6 col-sm-6 col-lg-6">
    <div class="card  flex-md-row mb-4 h-md-250 border-0 shadow rounded-5" style="height: 350px;">
       <div class="card-body d-flex flex-column align-items-start">
          <h3 class="d-inline-block mb-2 text-dark text-uppercase"><?php echo $title ?></h3>
          <div class="text-muted"><small>Posted By - <?php echo $posted_by ?> <sup><b>( <?php echo $category ?> )</b></small></sup></div>
          <div class="text-muted"><small>Posted On - <?php echo $date ?></small></div>
          <p class="card-text mb-auto text-muted mt-3"><small><?php echo substr($description, 0, 130); ?> ...</small></p>
          <a class="btn btn-outline-info bg-info btn-sm rounded-5 p-3" role="button" href="detail.php?post=<?php echo $id ?>" style="color:white">Read Detail</a>

       </div>
       <img class="card-img-right flex-auto d-none d-lg-block img rounded-right-5" src="<?php echo $image ?>" style="width: 200px; height: auto; object-fit: cover">
    </div>
 </div>






<?php }} ?>



</div>











</div> 
</div>

</main>







