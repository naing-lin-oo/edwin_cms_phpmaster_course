<?php require("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php require("includes/admin_navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
    $query = "SELECT * FROM posts";
    $select_all_post = mysqli_query($connection, $query);
    $post_count = mysqli_num_rows($select_all_post);
?>
                                <div class='huge'><?php echo $post_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
    $query = "SELECT * FROM comments";
    $select_all_comment = mysqli_query($connection, $query);
    $comment_count = mysqli_num_rows($select_all_comment);
?>
                                    <div class='huge'><?php echo $comment_count; ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
    $query = "SELECT * FROM users";
    $select_all_user = mysqli_query($connection, $query);
    $user_count = mysqli_num_rows($select_all_user);
?>
                                    <div class='huge'><?php echo $user_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);
    $categories_count = mysqli_num_rows($select_all_categories);
?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
<?php
    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
    $select_draft_post = mysqli_query($connection, $query);
    $draft_post_count = mysqli_num_rows($select_draft_post);

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
    $select_unapproved_comment = mysqli_query($connection, $query);
    $unapproved_comment_count = mysqli_num_rows($select_unapproved_comment);

    $query = "SELECT * FROM users WHERE user_role = 'Subscriber' ";
    $select_subscriber_user = mysqli_query($connection, $query);
    $subscriber_user_count = mysqli_num_rows($select_subscriber_user);

?>
        <!-- /#page-wrapper -->
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
<?php
    $element_text = ['Posts', 'Unactive Posts',  'Comments', 'Pending Comments', 'Users', 'Subcribers', 'Categories'];
    $element_count = [$post_count , $draft_post_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_user_count, $categories_count];

    for($i=0; $i < 7; $i ++) {
        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
    }
?>  
                            // ['Posts', 1000],
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                </div>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
        </div>  <!-- /.row -->
        </div>   <!-- /.container-fluid -->
    </div>
<?php require("includes/admin_footer.php"); ?>
