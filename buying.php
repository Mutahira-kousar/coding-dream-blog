<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php if(!isset($_SESSION['id'])){ header("Location: logout.php"); } ?>



<?php if($logrole == 'admin'){ ?>

<?php include_once "admin.php"; ?>

<?php }else{ header("Location: logout.php"); } 




?>







<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Buying Request</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>

<!-- give response -->


<?php

if(isset($_GET['response'])){

    $response_id = $_GET['response'];

    $responseQuery = "SELECT * FROM buying WHERE id = '{$response_id}' LIMIT 1";
    $responseRes = $db->query($responseQuery);
    $editRow = $responseRes->fetch_assoc();
    $editNum = $responseRes->num_rows;

    if($editNum == 0){
        echo "<div class='alert alert-danger'>No Record.</div>";
    }else{

        $editresponse = $editRow['response'];

        if(isset($_POST['editresponse'])){

            $response = $db->real_escape_string($_POST['response']);

            $updateQuery = "UPDATE buying SET response = '{$response}' WHERE id = '{$response_id}' ";
            $updateResult = $db->query($updateQuery);

            if($updateResult){

                header("Location: buying.php?response={$response_id}");

            }

        }

        ?>

<form  method="post">
    <div class="form-group">
        <label for="response">Response:</label>
        <input type="text" name="response" id="response" required class="form-control" value="<?php echo $editresponse; ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Post" name="editresponse" class="btn btn-info">
        
    </div>
</form>


        <?php

    }

}

?>







<table class="table table-stipped">


<tr>
    <th>No.</th>
    <th>Buying Ad</th>
    <th>User</th>
    <th>Message</th>
    <th>Response</th>
    <th>Date</th>
    <th>Action</th>
</tr>


<?php 


$query = "SELECT * FROM buying ORDER BY id DESC";
$result = $db->query($query);
$num = $result->num_rows;
if($num == 0){

echo "<tr><td colspan='5' class='text-center'>No Buying Request</td></tr>";

}else{

    $no = 1;
    while($row = $result->fetch_assoc()){
    
    $buying_id = $row['id'];
    $ad_id     = $row['ad_id'];
    $user_id     = $row['user_id'];
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


    $subuserQuery = "SELECT * FROM users WHERE id = '$user_id'";
    $subuserResult = $db->query($subuserQuery);
    $subuserRow = $subuserResult->fetch_assoc();
    $subuserNum = $subuserResult->num_rows;
    if($subuserNum == 0){
            $user_name = "Unknown";
    }else{
            $user_name = $subuserRow['name'];
        }

    $no++;

?>

        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $ad_title ?></td>
            <td><?php echo $user_name ?></td>
            <td><?php echo $message ?></td>
            <td><?php echo $response ?></td>
            <td><?php echo $date ?></td>
            <td>
                <a href="buying.php?response=<?php echo $buying_id ?>" class="btn btn-warning btn-sm">Response</a>
                <a href="buying.php?delete=<?php echo $buying_id ?>" class="btn btn-danger btn-sm">X</a>
            </td>

        </tr>


<?php

}

}


if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    $deleteQuery = "DELETE FROM buying WHERE id = '$delete_id'";
    $deleteResult = $db->query($deleteQuery);

    if($deleteResult){

        header("Location: buying.php");

    }

}

?>


</table>





</div> 

</div>




</main>





<div class="bottom">

</div>


