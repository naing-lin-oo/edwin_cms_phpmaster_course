<?php require('includes/header.php'); ?>

    <!-- Navigation -->

<?php require('includes/navigation.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
<?php

    if(isset($_GET["category"])) {
        $cat_post_id = $_GET["category"];
        $query = "SELECT * FROM posts WHERE post_category_id = $cat_post_id";
        $search_query = mysqli_query($connection, $query);
        if(!$search_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        $count = mysqli_num_rows($search_query);
        if($count == 0) {
            echo "<h1>No Result</h1>";
        }else{
?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
<?php
            while($row = mysqli_fetch_assoc($search_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,10);
        ?>
        
                        
        
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
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
        
