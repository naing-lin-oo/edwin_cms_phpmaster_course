<?php
    function escape($string) {
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }

    function confirmQuery($result){
        global $connection;
        if(!$result) {
            die("Query Failed".mysqli_error($connection));
        }
    }

    function insertCategories() {
        global $connection;
        if(isset($_POST['submit'])) {
            $cat_title = escape($_POST['cat_title']);
            if($cat_title == "" || empty($cat_title)) {
                echo "This field should not be empty";
            } else {
                $query = "INSERT INTO categories(cat_title) ";
                $query.= "VALUE ('$cat_title') ";
                $create_category_query = mysqli_query($connection, $query);
                confirmQuery($create_category_query);
                header("Location: categories.php");
            }
        }
    }

    function findAllCategories() {
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<tr>";
                echo "<td>{$cat_id}</td>";
                echo "<td>{$cat_title}</td>";
                echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "</tr>";
        }
    }

    function deleteCategories() {
        global $connection;

        if(isset($_SESSION['user_role'])) {
            if($_SESSION['user_role'] == 'Admin') {
                if(isset($_GET['delete'])) {
                    $delete_cat_id = escape($_GET['delete']);
                    $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
                    $delete_cat_query = mysqli_query($connection, $query);
                    header("Location: categories.php");
                }  
            }
        }
    }

    function userOnlineCount() {
        if(isset($_GET['onlineusers'])) {
            global $connection;
            if(!$connection) {
                session_start();
                include("../includes/db.php");

                $session = session_id();
                $time = time(); 
                $time_out_in_seconds = 05;
                $time_out = $time - $time_out_in_seconds;

                $query = "SELECT * FROM users_online WHERE session = '$session' ";
                $send_query = mysqli_query($connection, $query);
                $count = mysqli_num_rows($send_query);

                if($count == NULL) {
                    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
                } else {
                    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
                }

                $user_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
                echo $count_user = mysqli_num_rows($user_online_query);
            }
        }
    }
    userOnlineCount();
?>