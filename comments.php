<?php
include_once "connect.php";
include_once "header.php";
if (!isset($_SESSION['id'])) {
    header("Location: logout.php");
}

if ($logrole == 'admin') {
    include_once "admin.php";
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
                        $query = "SELECT * FROM posts WHERE id = $post_id";
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

<!-- edit comment -->
<?php

if(isset($_GET['edit'])){

    $edit_id = $_GET['edit'];

    $editQuery = "SELECT * FROM comments WHERE id = '{$edit_id}' AND post_id = '{$post_id}' LIMIT 1";
    $editResult = $db->query($editQuery);
    $editRow = $editResult->fetch_assoc();
    $editNum = $editResult->num_rows;

    if($editNum == 0){
        echo "<div class='alert alert-danger'>Comment does not exist.</div>";
    }else{

        $editComment = $editRow['comment'];

        if(isset($_POST['editComment'])){

            $comment = $_POST['comment'];

            $updateQuery = "UPDATE comments SET comment = '{$comment}' WHERE id = '{$edit_id}' AND post_id = '{$post_id}' ";
            $updateResult = $db->query($updateQuery);

            if($updateResult){

                header("Location: comments.php?post={$post_id}");

            }

        }

        ?>

<form action="" method="post">
    <div class="form-group">
        <label for="comment">Comment:</label>
        <input type="text" name="comment" id="comment" required class="form-control" value="<?php echo $editComment; ?>">
    </div>
    <div class="form-group">
        <input type="submit" value="Edit" name="editComment" class="btn btn-info">
        
    </div>
</form>


        <?php

    }

}

?>


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
echo "<td><a href='comments.php?post={$post_id}&edit={$comment_id}' class='btn btn-info btn-sm'>Edit</a>";
echo "<a href='comments.php?post={$post_id}&delete={$comment_id}' class='btn btn-danger btn-sm'>X</a>";
echo "<a href='comments.php?post={$post_id}&block={$comment_id}' class='btn btn-warning btn-sm'>Block</a></td></tr>";

                
            }


        }



    ?>


</table>

</div>






<?php

  }
                    
                    
 }                
?>


<?php 



if(isset($_GET['block']) && isset($_GET['post'])){

    $block_id = $_GET['block'];
    $post_id = $_GET['post'];

    $blockQuery = "UPDATE comments SET status = 0 WHERE id = '{$block_id}' AND post_id = '{$post_id}' ";
    $blockResult = $db->query($blockQuery);

    if($blockResult){

        header("Location: comments.php?post={$post_id}");

    }

}

// delete comment
if(isset($_GET['delete']) && isset($_GET['post'])){

    $delete_id = $_GET['delete'];
    $post_id = $_GET['post'];

    $deleteQuery = "DELETE FROM comments WHERE id = '{$delete_id}' AND post_id = '{$post_id}' ";
    $deleteResult = $db->query($deleteQuery);

    if($deleteResult){

        header("Location: comments.php?post={$post_id}");

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

            $answer = $db->real_escape_string($_POST['answer']);

            $updateQuery = "UPDATE questions SET answer = '{$answer}', respond_by = '{$logid}' WHERE id = '{$reply_id}' AND post_id = '{$post_id}' ";
            $updateResult = $db->query($updateQuery);

            if($updateResult){

                header("Location: comments.php?post={$post_id}");

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

                if(!empty($showRow['answer']) && $showRow['respond_by'] > 0){ //question exist or responed by user
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

// status and stars

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
                    <a href="comments.php?post=<?php echo $post_id ?>&reply=<?php echo $question_id ?>" class="btn btn-primary btn-sm">Reply</a>
                    <a href="comments.php?post=<?php echo $post_id ?>&validate=<?php echo $question_id ?>" class="btn btn-info btn-sm">Validate</a>
                    <a href="comments.php?post=<?php echo $post_id ?>&removequestion=<?php echo $question_id ?>" class="btn btn-danger btn-sm">X</a>
                    </td>
                    

                    
                </tr>


                <?php
                

                
            }
        }




        // validate question
        if(isset($_GET['validate']) && isset($_GET['post'])){

            $validate_id = $_GET['validate'];
            $post_id = $_GET['post'];

            $validateQuery = "UPDATE questions SET status = 1 WHERE id = '{$validate_id}' AND post_id = '{$post_id}' ";
            $validateResult = $db->query($validateQuery);

            if($validateResult){

                header("Location: comments.php?post={$post_id}");

            }

        }

        // delete question
        if(isset($_GET['removequestion']) && isset($_GET['post'])){

            $removequestion_id = $_GET['removequestion'];
            $post_id = $_GET['post'];

            $removequestionQuery = "DELETE FROM questions WHERE id = '{$removequestion_id}' AND post_id = '{$post_id}' ";
            $removequestionResult = $db->query($removequestionQuery);

            if($removequestionResult){

                header("Location: comments.php?post={$post_id}");

            }

        }



    ?>


</table>


</div>



            
        </div>
    </div>
</main>


