<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();

    $category = (int) mysqli_real_escape_string($con, $_POST['formcategory']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $Hname = mysqli_real_escape_string($con, $_POST['Hname']);
    $Mname = mysqli_real_escape_string($con, $_POST['Mname']);
    $type = (int) mysqli_real_escape_string($con, $_POST['type']);
    if(!empty($name) && !empty($category) && !empty($Hname) && !empty($Mname) && !empty($type)){
        $sql = mysqli_query($con, "SELECT i_eng FROM items WHERE i_eng = '{$name}'");
        if(!mysqli_num_rows($sql) > 0){
            if(isset($_FILES['image'])){ //if file is uploaded
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
                    if(move_uploaded_file($temp_name, $dirname)){

                        //inserting data into database
                        $sql2 = mysqli_query($con, "INSERT INTO items (i_eng, i_mar, i_hin, category_type, type, quantity, price, img)
                                            VALUES('{$name}', '{$Mname}', '{$Hname}', {$category}, {$type}, 0, 0,'{$new_img_name}')");
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
        echo "Please Select category and type";
    }


?>