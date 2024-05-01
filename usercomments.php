<?php
include_once "connect.php";
include_once "header.php";
if (!isset($_SESSION['id'])) {
    header("Location: logout.php");
}

if ($logrole == 'user') {
    include_once "user.php";
} else {
    header("Location: logout.php");
}



?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            
            


                <?php 
                
                
                    if(isset($_GET['post'])){

                        $post_id = $_GET['post'];

                        // check if post exists
                        $query = "SELECT * FROM posts WHERE id = $post_id AND posted_by = '{$logid}' LIMIT 1 ";
                        $result = $db->query($query);
                        $post = $result->fetch_assoc();
                        $num = $result->num_rows;

                        if($num == 0){

                            echo "<div class='alert alert-danger'>Post does not exist.</div>";
                        }else{

                            $post_id = $post['id']; 
                            $post_title = $post['title'];



                            ?>


<h3>Manage Comments & Questions/Answers of <u><?php echo ucfirst($post_title); ?></u>:</h3><br>


<div class="col-md-12 col-sm-12 col-lg-12">
<h3>Comments:</h3><br>


<table class="table table-dark table-striped">
    <tr>
        <th>No.</th>
        <th>Comment</th>
        <th>Action</th>
    </tr>


    <?php

      $showComments = "SELECT * FROM comments WHERE post_id = '{$post_id}' ORDER BY id DESC";
        $showResult = $db->query($showComments);
        $showNum = $showResult->num_rows;
        if($showNum == 0){
            echo "<tr><td colspan='5'>No Comments.</td></tr>";
        }else{
            $i = 0;
            while($showRow = $showResult->fetch_assoc()){
                $i++;
                $comment_id = $showRow['id'];
                $comment = $showRow['comment'];
                $commentstatus = $showRow['status'];
                if($commentstatus == 0){
                    $commentstatus = "<span style='color: red;'>Blocked</span>";
                }else{
                    $commentstatus = "<span style='color: green;'>Published</span>";
                }

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

                
echo "<tr><td>{$i}</td><td>{$comment} - <small>by {$username} <sup>({$userrole}) $commentstatus</sup></small></td>";

                
            }


        }



    ?>


</table>

</div>






<?php

  }
                    
                    
 }                
?>



<br><br>
<div class="col-md-12 col-sm-12 col-lg-12">
<h3>Question & Replies:</h3><br>
<p><b>Note: </b> Following questions & answers ranked based on stars given.</p>


<?php


if(isset($_GET['reply']) && isset($_GET['post'])){

    $reply_id = $_GET['reply'];

    $replyQuery = "SELECT * FROM questions WHERE id = '{$reply_id}' AND post_id = '{$post_id}' LIMIT 1";
    $replyResult = $db->query($replyQuery);
    $replyRow = $replyResult->fetch_assoc();
    $replyNum = $replyResult->num_rows;

    if($replyNum == 0){
        echo "<div class='alert alert-danger'>Question does not exist.</div>";
    }else{

        $replyQuestion = $replyRow['question'];
        
        if(empty($replyRow['answer'])){
            $replyAnswer = '';
        }else{

            $replyAnswer = $replyRow['answer'];
        }


        if(isset($_POST['updateReply'])){

            $answer = $_POST['answer'];

            $updateQuery = "UPDATE questions SET answer = '{$answer}', respond_by = '{$logid}' WHERE id = '{$reply_id}' AND post_id = '{$post_id}' ";
            $updateResult = $db->query($updateQuery);

            if($updateResult){

                header("Location: usercomments.php?post={$post_id}");

            }else{

                echo $db->error;
            }

        }

        ?>

<form action="" method="post">
    <div class="form-group">
        <label for="answer">Answer:</label>
        <input type="text" name="answer" id="answer" required class="form-control" value="<?php echo $replyAnswer; ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Update" name="updateReply" class="btn btn-info">
        
    </div>
</form>


        <?php

    }

}

?>


<table class="table table-dark table-striped">
    <tr>
        <th>No.</th>
        <th>Question</th>
        <th>Reply</th>
        <th>Stars</th>
        <th>Action</th>

    </tr>


    <?php

      $showquestions = "SELECT * FROM questions WHERE post_id = '{$post_id}' ORDER BY stars DESC";
        $showResult = $db->query($showquestions);
        $showNum = $showResult->num_rows;
        if($showNum == 0){
            echo "<tr><td colspan='5'>No Question Asked.</td></tr>";
        }else{
            $i = 0;
            while($showRow = $showResult->fetch_assoc()){
                $i++;
                $question_id = $showRow['id'];
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
                    <td><?php echo $answer ?> <small>(By <?php echo $respond_by ?>)</small></td>
                    <td><?php echo $stars ?></td>
                    <td>
                    <a href="usercomments.php?post=<?php echo $post_id ?>&reply=<?php echo $question_id ?>" class="btn btn-primary btn-sm">Reply</a>
                    
                    </td>
                    

                    
                </tr>


                <?php
                

                
            }
        }







    ?>


</table>


</div>



            
        </div>
    </div>
</main>


