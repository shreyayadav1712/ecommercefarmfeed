<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
    session_start();
    
    $fname =  mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = (double) mysqli_real_escape_string($con, $_POST['mobile']);
    $address =  mysqli_real_escape_string($con, $_POST['address']);
    $lat = (double) mysqli_real_escape_string($con, $_POST['lat']);
    $long = (double) mysqli_real_escape_string($con, $_POST['long']);
    $pass =  mysqli_real_escape_string($con, $_POST['password']);
    $repassword =  mysqli_real_escape_string($con, $_POST['repassword']);
    $password = password_hash($pass, PASSWORD_BCRYPT);
    $pincode = (int) mysqli_real_escape_string($con, $_POST['pincode']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($mobile)  && !empty($address)  && !empty($password)  && !empty($repassword) && !empty($pincode)){
            if(!empty($lat) && !empty($long)){
                $query = mysqli_query($con, "SELECT * FROM customer WHERE c_phone = {$mobile}");
                if(!mysqli_num_rows($query) > 0){
                    $sql2 = mysqli_query($con, "INSERT INTO customer (flag, f_name, l_name, c_address, c_pin, c_phone, c_email, c_password, latitude, longitude)
                                        VALUES(0, '{$fname}', '{$lname}', '{$address}', {$pincode}, {$mobile}, '{$email}', '{$password}', {$lat}, {$long})");
                    if($sql2){
                        $sql3 = mysqli_query($con, "SELECT * FROM customer WHERE c_phone = {$mobile}");
                        if(mysqli_num_rows($sql3) > 0){
                            echo "success";
                        }else{
                            echo "Something Went Wrong!2";
                        }
                    }else{
                        echo "Something Went Wrong!1";
                    }
                }else{
                    echo "Number Already Exist";
                }
            }
            else{
                echo "Click on Get Location Button";
            } 
    }else{
        echo "Something Went Wrong!0";
    }
?>