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
    if(isset($_GET['p_id']) && isset($_GET['author'])){
        $post_id = $_GET['p_id'];
        $the_post_author = $_GET['author'];

        $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' OR post_user = '{$the_post_author}' ";
        $select_author_posts = mysqli_query($connection, $query);
        confirmQuery($select_author_posts);
        while($row = mysqli_fetch_assoc($select_author_posts)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
?>

                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    All posts by 
                    <?php 
                        if(!empty($post_author)) {
                            echo $post_author;
                        } elseif (!empty($post_user)) {
                            echo $post_user;
                        }
                        ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img width="100%" height="300px" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
<?php
        }
    }
?>
                <!-- Blog Comments -->
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
