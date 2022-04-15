<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $Hname = mysqli_real_escape_string($con, $_POST['Hname']);
    $Mname = mysqli_real_escape_string($con, $_POST['Mname']);
    $id = mysqli_real_escape_string($con, $_POST['itemid']);

    if(!empty($name) && !empty($id) && !empty($Hname) && !empty($Mname)){
        $sql = mysqli_query($con, "SELECT * FROM items WHERE item_id = {$id}");
        if(mysqli_num_rows($sql) > 0){
            if($_FILES['image']['name'] != null){ //if file is uploaded
                $img_name = $_FILES['image']['name'];
                // $img_type = $_FILES['image']['type'];
                $temp_name = $_FILES['image']['tmp_name'];
                //spliting the image name into 2 parts name and extention
                $img_split = explode(".", $img_name);
                $img_ext = end($img_split);   //got the extention of file
                $extentions = ['png', 'jpg', 'jpeg'];
                if(in_array($img_ext, $extentions) == true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    $dirname = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'Veg'.DIRECTORY_SEPARATOR.$new_img_name;
                    $query = mysqli_query($con, "SELECT * FROM items WHERE item_id = {$id}");
                    $row = mysqli_fetch_assoc($query);
                    $delImage = $row['img'];
                    unlink(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'Veg'.DIRECTORY_SEPARATOR.$delImage);
                    if(move_uploaded_file($temp_name, $dirname)){
                        //inserting data into database
                        $sql2 = mysqli_query($con, "UPDATE  items SET i_eng = '{$name}', i_mar = '{$Mname}', i_hin = '{$Hname}', img = '{$new_img_name}'
                                WHERE item_id = {$id}");
                        if($sql2){ 
                            echo "success";
                        }else{
                            echo "Something Went Wrong!";
                        }
                    }
                
                }else{
                    echo "Please Select a file of extentions:(jpeg, png, jpg)";
                }
            
            }else{
                echo "Please Select an Image file!";
            }
        }else{
            echo 'Item Already Exist';
        }
    }else{
        echo "error";
    }

    
                            

?>