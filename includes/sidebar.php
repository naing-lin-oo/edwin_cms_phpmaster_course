<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    <!-- Login -->
    <div class="well">

<?php if(isset($_SESSION['user_role'])): ?>
    <h3>Logged in as <b><?php echo $_SESSION['username'] ?></b></h3>
    <a class="btn btn-primary" href="admin/includes/logout.php">Logout</a>
<?php else: ?>
    <h4>Login To Admin</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input name="user_password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>
            </div>
        </form>
<?php endif; ?>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
<?php
    $query = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
    
        echo"<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
    }
?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
<?php require("widget.php"); ?>
    