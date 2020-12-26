<?php require('includes/header.php'); ?>

    <!-- Navigation -->

<?php require('includes/navigation.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
<?php
    $per_page = 5;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = "";
    }
    if($page == "" || $page == 1) {
        $page_1 = 0;
    } else {
        $page_1 = ($page * $per_page) - $per_page;
    }

    if(!empty($_SESSION['user_role'])) {
        $post_query_count = "SELECT * FROM posts";
        $find_count_query = mysqli_query($connection, $post_query_count);
        $count = mysqli_num_rows($find_count_query);
        $count = ceil($count/$per_page);

        $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
        $select_all_posts_query = mysqli_query($connection, $query);

    } elseif(empty($_SESSION['user_role'])) {
        $post_query_count = "SELECT * FROM posts WHERE post_status = 'published' ";
        $find_count_query = mysqli_query($connection, $post_query_count);
        $count = mysqli_num_rows($find_count_query);
        $count = ceil($count/$per_page);

        $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
        $select_all_posts_query = mysqli_query($connection, $query);
        
    }

    $count_post = mysqli_num_rows($select_all_posts_query);
    if($count_post == 0) {
        echo "<h1 class='text-center'>There is no published posts!!!</h1>";
    } else {
?> 
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
<?php
    while($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,10);
        $post_status = $row['post_status'];
?>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2> 
                <p class="lead">
                    by 
                    <a href="author_posts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id;?>">
                    <?php echo $post_user; ?>
                </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id;?>">
                    <img width="100%" height="300px" src="images/<?php echo $post_image;?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
<?php
        }
    }
?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php require('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
<?php
    for($i=1; $i <= $count; $i++) {
        if($i == $page) {
            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
        } else {
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
    }
?>
        </ul>

        <!-- Footer -->
<?php require('includes/footer.php'); ?>
        
