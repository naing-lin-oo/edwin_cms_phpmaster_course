<?php
    if(isset($_GET['user_id'])) {
        $edit_user_id = escape($_GET['user_id']);
        $query = "SELECT * FROM users WHERE user_id=$edit_user_id";
        $select_user_by_id = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_user_by_id)) {
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
        }

    if(isset($_POST['update_user'])) {
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_role = escape($_POST['user_role']);
        $username = escape($_POST['username']);

        // $post_image = escape($_FILES['image']['name']);
        // $post_image_temp = escape($_FILES['image']['tmp_name']);

        $user_email = escape($_POST['user_email']);
        $user_passwords = escape($_POST['user_password']);

        // move_uploaded_file($post_image_temp, "../images/$post_image");

        // if(empty($post_image)) {
        //     $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
        //     $select_image = mysqli_query($connection, $query);
        //     while($row = mysqli_fetch_array($select_image)) {
        //         $post_image = $row['post_image'];
        //     }
        // }
        if($user_password !== $user_passwords) {
            $user_passwords = password_hash($user_passwords, PASSWORD_BCRYPT, array('cost' => 12));
        }
        $query  = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        // $query .= "post_date = now(), ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_passwords}' ";
        // $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE user_id = {$edit_user_id}";

        $update_user_query = mysqli_query($connection, $query);
        confirmQuery($update_user_query);
        header("Location: users.php");
    }
    }
?>
<form action="" method="post" enctype="multipart/form-data">   
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    <div class="form-group">
        <select class="form-control" name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
<?php
    if($user_role == "Admin") {
        echo "<option value='Subscriber'>Subscriber</option>";
    } else {
        echo "<option value='Admin'>Admin</option>";
    }
?> 
        </select>
    </div>    
    <div class="form-group">
        <label for="author">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
    </div>
</form>