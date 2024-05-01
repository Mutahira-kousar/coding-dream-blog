<?php include_once "connect.php"; ?>
<?php include_once "header.php"; ?>
<?php include_once "navbar.php"; ?>




<main role="main" class="container">




<div class="row">


<div class="col-md-12 col-sm-12 col-lg-12">
  
 
<blockquote class="blockquote text-center mb-5">
  <h1 class="mb-0 text-uppercase display-4">Post Detail</h1>
  <footer class="blockquote-footer">Coding Dream Blog</footer>
</blockquote>





<?php 

if(isset($_GET['post'])){

$post = $_GET['post'];


$query       = "SELECT * FROM posts WHERE id = '{$post}' AND status = 1 ORDER BY id DESC";
$result      = $db->query($query);


if($result->num_rows == 0){

echo "<h5 class='alert'>No Record.</h5>";

}else{

$row      = $result->fetch_assoc();


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




}

?>



<div class="row">
    

      <div class="col-md-4 col-sm-4 col-lg-4">
        <img class="img rounded-5" src="<?php echo $image ?>" style="width: 100%; height: 350px;">


        <?php 
        
            if(isset($logid)){

        ?>


        

        <form method="post">
       

        <input type="hidden" name="postid" value="<?php echo $id ?>">
        <input type="hidden" name="userid" value="<?php echo $logid ?>">
        


        <div class="form-group">
            <label for="comment">Type Your Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        </div>


        <div class="form-group">
            <input type="submit" name="postcomment" class="btn btn-info" value="comment">
        </div>


        </form>


        <?php 
        
            }else{

                echo "<h5 class='alert alert-warning mt-3 rounded-5'>Please <a href='login.php' class='text-info'>Login</a> to post comment.</h5>";

            }
        
        
        ?>


        <?php 
        
        
                if(isset($_POST['postcomment'])){

                    $postid   = $_POST['postid'];
                    $userid   = $_POST['userid'];
                    $comment  = $db->real_escape_string($_POST['comment']);

                    
                    $checkQuery = "SELECT * FROM comments WHERE user_id = '{$userid}' AND status = 0 LIMIT 1";
                    $checkResult = $db->query($checkQuery);
                    $checkNum = $checkResult->num_rows;
                    if($checkNum > 0){
                        echo "<p class='alert alert-danger'>Your comment status is blocked for this post.</p>";
                    }else{
          
                    $commentQuery = "INSERT INTO comments (post_id, user_id, comment) VALUES ('{$postid}', '{$userid}', '{$comment}')";
                    $commentResult = $db->query($commentQuery);

                    if($commentResult){

                        header("Location: detail.php?post={$postid}");

                    }

                }


            }
        
        
    
        ?>

    
     </div>

     <div class="col-md-8 col-sm-8 col-lg-8">
        <div class="card rounded-5">
            <div class="card-body">
            <table class="table mb-0">

<tr>
    <th class="border-0">Title</th>
    <td class="border-0"><?php echo $title ?></td>
</tr>

<tr>
    <th>Category</th>
    <td><?php echo $category ?></td>
</tr>

<tr>
    <th>Posted By</th>
    <td><?php echo $posted_by ?></td>
</tr>

<tr>
    <th>Published Date</th>
    <td><?php echo $date ?></td>
</tr>

    
<tr>
    <td colspan="2"><?php echo $description ?></td>
</tr>




</table>

            </div>
        </div>

<!-- Ask Question -->


    <?php 
        
        if(isset($logid)){

    ?>


    

    <form method="post">
   

    <input type="hidden" name="postid" value="<?php echo $id ?>">
    <input type="hidden" name="questioner" value="<?php echo $logid ?>">
    


    <div class="form-group">
        <label for="comment">Ask Question</label>
        <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
    </div>


    <div class="form-group">
        <input type="submit" name="askquestion" class="btn btn-info" value="Ask">
    </div>


    </form>


    <?php 
    
        }else{

            echo "<h5 class='alert alert-warning mt-3 rounded-5'>Please <a href='login.php' class='text-info'>Login</a> to ask question.</h5>";

        }
    
    
    ?>


    <?php 
    
    
            if(isset($_POST['askquestion'])){

                $postid     = $_POST['postid'];
                $questioner = $_POST['questioner'];
                $question   = $db->real_escape_string($_POST['question']);

                
                $checkQuery = "SELECT * FROM questions WHERE questioner = '{$questioner}' AND post_id = '{$postid}' LIMIT 1";
                $checkResult = $db->query($checkQuery);
                $checkNum = $checkResult->num_rows;
                if($checkNum > 0){
                    echo "<p class='alert alert-warning'>You already asked a question on this post</p>";
                }else{
      
                $questionQuery = "INSERT INTO questions (post_id, questioner, question) VALUES ('{$postid}', '{$questioner}', '{$question}')";
                $questionResult = $db->query($questionQuery);

                if($questionResult){

                    header("Location: detail.php?post={$postid}");

                }

            }


        }
    
    

    ?>


     </div>

</div>



<br>

<div class="row">

<div class="col-md-4 col-sm-4 col-lg-4">
<h3>Comments:</h3><br>



<table class="table table-borderless table-striped">
    <tr>
        <th>No.</th>
        <th>Comment</th>
    </tr>


    <?php

      $showComments = "SELECT * FROM comments WHERE post_id = '{$post}' AND status = 1 ORDER BY id DESC";
        $showResult = $db->query($showComments);
        $showNum = $showResult->num_rows;
        if($showNum == 0){
            echo "<tr><td colspan='2'>No Comments.</td></tr>";
        }else{
            $i = 0;
            while($showRow = $showResult->fetch_assoc()){
                $i++;
                $comment = $showRow['comment'];
                $userid = $showRow['user_id'];
                $userQuery = "SELECT * FROM users WHERE id = '{$userid}' LIMIT 1";
                $userResult = $db->query($userQuery);
                $userRow = $userResult->fetch_assoc();
                $usernum = $userResult->num_rows;
                if($usernum == 0){
                    $username = 'Unknown';
                }else{
                    $username = $userRow['name'];
                    $userrole = $userRow['role'];

                }

                
                echo "<tr><td>{$i}</td><td>{$comment} - <small>by {$username} <sup>({$userrole})</sup></small></td></tr>";
                

                
            }
        }



    ?>


</table>

</div>



<div class="col-md-8 col-sm-8 col-lg-8">
<h3>Asked Questions & Replies:</h3><br>


<table class="table table-borderless table-striped">
    <tr>
        <th>No.</th>
        <th>Question</th>
        <th>Reply</th>
        <th>Stars</th>
        <th>UpStar</th>

    </tr>


    <?php

      $showquestions = "SELECT * FROM questions WHERE post_id = '{$post}' ORDER BY stars DESC";
        $showResult = $db->query($showquestions);
        $showNum = $showResult->num_rows;
        if($showNum == 0){
            echo "<tr><td colspan='5'>No Question Asked.</td></tr>";
        }else{
            $i = 0;
            while($showRow = $showResult->fetch_assoc()){
                $i++;
                $question = $showRow['question'];
                $userid = $showRow['questioner'];
                $userQuery = "SELECT * FROM users WHERE id = '{$userid}' LIMIT 1";
                $userResult = $db->query($userQuery);
                $userRow = $userResult->fetch_assoc();
                $usernum = $userResult->num_rows;
                if($usernum == 0){
                    $username = 'Unknown';
                }else{
                    $username = $userRow['name'];
                    $userrole = $userRow['role'];

                }


                if(!empty($showRow['answer']) && $showRow['respond_by'] > 0){
                    $respond_by = $showRow['respond_by'];
                    $respondQuery = "SELECT * FROM users WHERE id = '{$respond_by}' LIMIT 1";
                    $respondResult = $db->query($respondQuery);
                    $respondRow = $respondResult->fetch_assoc();
                    $respondNum = $respondResult->num_rows;
                    if($respondNum == 0){
                        $respond_by = 'Unknown';
                    }else{
                        $respond_by = $respondRow['name'];
                    }
                }else{
                    $respond_by = '-';
                }


                $starstatus = $showRow['status'];
                
                if($starstatus > 0){
                    $stars = $showRow['stars'];
                    
                    if(empty($showRow['answer'])){
                        $answer = '-';
                    }else{
                        $answer = $showRow['answer'];
                    }
                }else{

                    $answer = '-';
                    $stars = '-';
                }

                
                ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $question ?> <small>From <?php echo $username ?> <sup>(<?php echo $userrole ?>)</sup></small></td>
                    <td><?php echo $answer ?> <small><sup>By <?php echo $respond_by ?></sup></small></td>
                    <td><?php echo $stars ?></td>
                    <td>

                    <?php 
                    
                        if(isset($logid)){

                            if($starstatus > 0){

                                echo "<a href='detail.php?post={$post}&question={$showRow['id']}&giver={$logid}' class='btn btn-warning btn-sm'><i class='fas fa-arrow-up'></i></a>";

                            }else{

                                echo '-';
                            }

                        }else{

                            echo "<a href='login.php' class='btn btn-info'>Login to Star</a>";

                        }

                        ?>


                    </td>
                </tr>


                <?php
                

                
            }
        }



    ?>


</table>

<!-- start increment -->

<?php

if (isset($_GET['post']) && isset($_GET['question']) && isset($_GET['giver'])) {
    $post = $_GET['post'];
    $question = $_GET['question'];
    $giver = $_GET['giver'];

    // Retrieve the current starsgivers value from the database
    $sql = "SELECT stars, starsgivers FROM questions WHERE post_id = $post AND id = $question";
    $result = $db->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stars = $row['stars'];
        $starsgivers = json_decode($row['starsgivers'], true);

        // Check if the giver's ID is not in the starsgivers array
        if (!in_array($giver, $starsgivers)) {
            // Increment the stars by 1 and add the giver's ID to starsgivers array
            $stars++;
            $starsgivers[] = $giver;

            // Update the database with the new values
            $starsgivers_json = json_encode($starsgivers);
            $sql_update = "UPDATE questions SET stars = $stars, starsgivers = '$starsgivers_json' WHERE post_id = $post AND id = $question";
            $db->query($sql_update);
        }
    }
    
    header("Location: detail.php?post=$post");
}




?>




</div>
</div>



<?php } ?>








</div> 

</div>




</main>







