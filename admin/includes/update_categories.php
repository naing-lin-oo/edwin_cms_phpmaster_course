<form action="" method="POST">                        
<?php 
    // FIND EDIT CATEGORIES QUERY
    if(isset($_GET['edit'])) {
        $edit_cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id={$edit_cat_id}";
        $edit_select_categories = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($edit_select_categories)) {
            $cat_title = $row['cat_title'];
?>
        <div class="form-group">
            <label for="cat-title">Edit Category Title</label>
        <input class="form-control" type="text" name="cat_title" value="<?php if(isset($cat_title)) echo $cat_title ?>">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
        </div>  
<?php
        }
    } 
?> 
<?php
    // UPDATE CATEGORY QUERY
    if(isset($_POST['update_category'])) {
        $update_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = $edit_cat_id";
        $update_cat_query = mysqli_query($connection, $query);
        confirmQuery($update_cat_query);
        header("Location: categories.php");
    }
?>
</form>