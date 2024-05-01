<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php if(!isset($_SESSION['id'])){ header("Location: logout.php"); } ?>



<?php if($logrole == 'user'){ ?>

<?php include_once "user.php"; ?>

<?php }else{ header("Location: logout.php"); } 




$query      = "SELECT * FROM advertisements";
$result     = $db->query($query);
$ads = $result->fetch_all(MYSQLI_ASSOC);




?>







<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Buy From Admin</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>


<form method="post" enctype="multipart/form-data">
     
                <div class="form-group">
                    <label for="ads">Choose Buying Ad</label>
                    <select class="form-control" id="ads" name="ads" required>
                        <?php
                        foreach ($ads as $ad) {
                            echo "<option value='" . $ad['id'] . "'>" . $ad['title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

 
                <div class="form-group">
                    <label for="message">Additional Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
 
				<input type="submit" class="btn btn-info" value="Send Buying Request" name="submit">
            </form>

<?php


if (isset($_POST['submit'])) {
    
    $ads        = $_POST["ads"];
    $message    = $db->real_escape_string($_POST["message"]);


    $sendRequest = "INSERT INTO buying (ad_id, user_id, message, date)
                        VALUES ($ads, '$logid', '$message', NOW())";

    if ($db->query($sendRequest) === true) {
        
        header("Location: buyfromadmin.php");

    }

}

 

?>



<br>
<table class="table table-stipped">


<tr>
    <th>No.</th>
    <th>Buying Ad</th>
    <th>Message</th>
    <th>Response</th>
    <th>Date</th>
</tr>


<?php 


$query = "SELECT * FROM buying WHERE user_id = '$logid' ORDER BY id DESC";
$result = $db->query($query);
$num = $result->num_rows;
if($num == 0){

echo "<tr><td colspan='5' class='text-center'>No Buying Request</td></tr>";

}else{

    $no = 1;
    while($row = $result->fetch_assoc()){
    
    $buying_id = $row['id'];
    $ad_id     = $row['ad_id'];
    $message   = $row['message'];
    if(empty($row['response'])){

        $response = "-";

    }else{

        $response = $row['response'];

    }

    $date      = $row['date'];
    $date      = date("d M Y", strtotime($date));

    $subquery = "SELECT * FROM advertisements WHERE id = '$ad_id'";
    $subresult = $db->query($subquery);
    $subrow = $subresult->fetch_assoc();
    $subnum = $subresult->num_rows;
    if($subnum == 0){
            $ad_title = "Unknown";
    }else{
            $ad_title = $subrow['title'];
        }

    $no++;

?>

        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $ad_title ?></td>
            <td><?php echo $message ?></td>
            <td><?php echo $response ?></td>
            <td><?php echo $date ?></td>

        </tr>


<?php

}

}



?>


</table>





</div> 

</div>




</main>





<div class="bottom">

</div>


