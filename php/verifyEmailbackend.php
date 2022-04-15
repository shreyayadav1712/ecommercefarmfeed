<?php 
   include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
   session_start();
   
   $receiver =  mysqli_real_escape_string($con, $_POST['email']);
   $id =  (int) mysqli_real_escape_string($con, $_POST['id']);

    if(!empty($receiver) && !empty($id)){
        $sql = mysqli_query($con, "SELECT * FROM customer WHERE c_id = {$id}");
        $fetch = mysqli_fetch_assoc($sql);
        $token = md5($email).rand(10,9999);
        $link = "<a href='localhost/farmfresh/php/verifiedOrNot.php?key=".$id."&token=".$token."'>Click and Verify Email</a>";
        $subject = "Email Test via PHP using Localhost";
        $body = "Hi, {$fetch['f_name']} {$fetch['l_name']},\nClick on the below link to verify your email\n".$link;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
        $headers .= 'From: test843333@gmail.com '. "\r\n";
        $sql2 = mysqli_query($con, "SELECT * FROM verify WHERE id = {$id}");
        if(!mysqli_num_rows($sql2) > 0){
            $sql3 = mysqli_query($con, "INSERT verify (id, token) VALUES({$id}, '{$token}')");
        }else{
            $sql3 = mysqli_query($con, "UPDATE verify SET token = '{$token}' WHERE id = {$id}");
        }
        if(mail($receiver, $subject, $body, $headers)){
            echo "success";
        }else{
            echo "Sorry, failed while sending mail!";
        }

   }else{
    echo "error";
   }
?>