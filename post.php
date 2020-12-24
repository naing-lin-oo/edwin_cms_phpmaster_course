<?php require("includes/header.php"); ?>
    <!-- Navigation -->
<?php require("includes/navigation.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
<?php
    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];

        $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$post_id}";
        $send_query = mysqli_query($connection, $view_query);
        confirmQuery($send_query);

        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
        $select_all_posts_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_all_posts_query)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
?>

                

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php if(!empty($post_author)) {
                        echo $post_author;
                    } elseif(!empty($post_user)) {
                        echo $post_user;
                    } ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img width="100%" height="300px" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
<?php
        }
    } else {
        header("Location: index.php");
    }
?>

                <!-- Blog Comments -->
<?php
    if(isset($_POST['create_comment']))  {
        $post_id = escape($_GET['p_id']);
        $comment_author = escape($_POST['comment_author']);
        $comment_email = escape($_POST['comment_email']);
        $comment_content = escape($_POST['comment_content']);
        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            $query  = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
            $query .= "VALUES ({$post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
            $create_comment_query = mysqli_query($connection, $query);
            confirmQuery($create_comment_query);
            // $query  = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
            // $query .= "WHERE post_id = $post_id";
            // $update_comment_count = mysqli_query($connection, $query);
            // confirmQuery($update_comment_count);
        } else{
            echo "<script>alert('Fields cannot be empty')</script>";
        }       
    }
?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
<?php 
    $query  = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC";
    $select_comments_query = mysqli_query($connection, $query);
    confirmQuery($select_comments_query);
    while($row = mysqli_fetch_array($select_comments_query)) {
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_date = $row['comment_date'];
?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
<?php
    }
?>
                <!-- Comment -->
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php require("includes/sidebar.php"); ?>
                <!-- Side Widget Well --> 

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php require("includes/footer.php"); ?>
