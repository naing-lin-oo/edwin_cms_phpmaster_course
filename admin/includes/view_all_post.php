<?php

    include("delete_modal.php");

    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $postValueId) {
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}"; 
                    $update_to_published_status = mysqli_query($connection, $query);
                    confirmQuery($update_to_published_status);
                break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}"; 
                    $update_to_draft_status = mysqli_query($connection, $query);
                    confirmQuery($update_to_draft_status);
                break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}"; 
                    $update_to_delete_status = mysqli_query($connection, $query);
                    confirmQuery($update_to_delete_status);
                break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                    $select_posts_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($select_posts_query)) {
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                    }
                    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_user, post_date, post_image, post_tags, post_content, post_comment_count, post_status) ";
                    $query.= "VALUES ({$post_category_id},'{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_tags}','{$post_content}',{$post_comment_count},'{$post_status}')";
                    $copy_query = mysqli_query($connection, $query);
                    confirmQuery($copy_query);
                    }
                }
            }   
?>
<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4" style="padding: 0px">
            <select name="bulk_options" class="form-control" id="">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select><br>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Com</th>
                <th>Date</th>
                <th>Publish</th>
                <th>Draft</th>
                <th>View Post</th>
                <th>View</th>
                <th colspan="2">Managing</th>
            </tr>
        </thead>
        <tbody>
<?php
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $select_posts = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_view_count = $row['post_view_count'];
        echo "<tr>";
        echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value={$post_id}></td>";
        echo "<td>{$post_id}</td>";

        if(!empty($post_author)) {
            echo "<td>$post_author</td>";
        } elseif(!empty($post_user)) {
            echo "<td>$post_user</td>";
        }

        echo "<td>{$post_title}</td>";

        $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
        $edit_select_categories = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($edit_select_categories)) {
            $cat_title = $row['cat_title'];

        echo "<td>{$cat_title}</td>";
        }
        
        echo "<td>{$post_status}</td>";
        echo "<td><img height='40px' width='80px' src='../images/$post_image'></td>";
        echo "<td>{$post_tags}</td>";

        $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
        $send_comment_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_comment_query);

        echo "<td><a href='comments.php?cp_id={$post_id}'>{$count}</a></td>";

        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?published=$post_id'>published</a></td>";
        echo "<td><a href='posts.php?draft=$post_id'>draft</a></td>";
        echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
        echo "<td><a href='posts.php?reset=$post_id'>{$post_view_count}</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
        echo "<td><a rel='$post_id' href='javascript:void(0)' id='' class='delete_link'>Delete</a></td>";
        // echo "<td><a id='deleteModal' href='posts.php?delete=$post_id'>Delete</a></td>";
        echo "</tr>";
    }
?>
        </tbody>
    </table>
</form>
<?php
    if(isset($_GET['published'])) {
        $published_post_id = escape($_GET['published']);
        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$published_post_id}";
        $published_post_query = mysqli_query($connection, $query);
        confirmQuery($published_post_query);
        header("Location: posts.php");
    }

    if(isset($_GET['draft'])) {
        $draft_post_id = escape($_GET['draft']);
        $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$draft_post_id}";
        $draft_post_query = mysqli_query($connection, $query);
        confirmQuery($draft_post_query);
        header("Location: posts.php");
    }
    if(isset($_GET['delete'])) {
        if(isset($_SESSION['user_role'])) {
            if($_SESSION['user_role'] == 'Admin') {
                $delete_post_id = escape($_GET['delete']);
                $query = "DELETE FROM posts WHERE post_id = $delete_post_id";
                $delete_post_query = mysqli_query($connection, $query);
                confirmQuery($delete_post_query);
                $query = "DELETE FROM comments WHERE comment_post_id = $delete_post_id";
                $delete_post_comments_query = mysqli_query($connection, $query);
                confirmQuery($delete_post_comments_query);
                header("Location: posts.php");
            }  
        }   
    }
    if(isset($_GET['reset'])) {
        $post_reset_id = escape($_GET['reset']);
        $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$post_reset_id} ";
        $reset_query = mysqli_query($connection, $query);
        confirmQuery($reset_query);
        header("Location: posts.php");  
    }
?>

<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id +" ";
            $(".modal_delete_link").attr("href", delete_url);
            $("#deleteModal").modal('show');
        });
    });
</script>