<?php require('includes/header.php'); ?>

    <!-- Navigation -->

<?php require('includes/navigation.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
<?php

    if(isset($_POST["submit"])) {
        $search = $_POST["search"];
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
        $search_query = mysqli_query($connection, $query);
        if(!$search_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        $count = mysqli_num_rows($search_query);
        if($count == 0) {
            echo "<h1>No Result</h1>";
        }else{
            while($row = mysqli_fetch_assoc($search_query)) {
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
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
<?php
            }      
        }
    }
?>
 

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php require('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php require('includes/footer.php'); ?>
        
