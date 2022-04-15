<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();
    if(isset($_GET['key']) && isset($_GET['token'])){
        $id = (int) $_GET['key'];
        $token = $_GET['token'];
        $sql = mysqli_query($con, "SELECT * FROM verify WHERE id = {$id}");
        if(mysqli_num_rows($sql) > 0){
            $fetch = mysqli_fetch_assoc($sql);
            if($token == $fetch['token']){
                $sql2 = mysqli_query($con, "UPDATE customer SET flag = 1 WHERE c_id = {$id}");
                if($sql2){
                    $sql3 = mysqli_query($con, "DELETE FROM verify WHERE id = {$id}");
                    if($sql3){
                        header("Location: cart.php");
                    }else{
                        echo "Error";
                    }
                }else{
                    echo "Error";
                }
            }else{
                echo "Not verified";
            }
        }else{
            echo "Something Went Wrong1";
        }
    }else{
        echo "Something Went Wrong2";
    }
?>