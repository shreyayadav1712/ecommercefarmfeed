<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();

    $id = mysqli_escape_string($con, $_POST['itemid']);
    $edit = mysqli_escape_string($con, $_POST['edit']);
    $del = mysqli_escape_string($con, $_POST['delete']);

    if(!empty($id) && !empty($del)){
        $query = "SELECT * FROM items WHERE item_id = {$id}";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $img = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'Veg'.DIRECTORY_SEPARATOR.$row['img'];
            if(!empty($img)){
                unlink($img);
                $sql = mysqli_query($con, "DELETE FROM items WHERE item_id = {$id}");
                if($sql){
                    header("Location: ./additems.php");
                }else{
                    header("Location: ./additems.php?error=error");
                }
            }else{
                echo "Something Went Wrong, Try again later if error doesn't resolve contact";
            }
        }else{
            echo "Item doesn't exist";
        }
    }else{
        "Something went wrong";
    }

    if(!empty($id) && !empty($edit)){
        header("Location: ./edititems.php?id=$id");
    }

    
?>