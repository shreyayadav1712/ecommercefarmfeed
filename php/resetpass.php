
<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';


    $phone=mysqli_real_escape_string($con,$_POST['number']);
    $str = substr($phone, 3);
    $query = "SELECT c_id FROM customer WHERE c_phone=$str";
    $result = mysqli_query($con, $query);


    if (mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_assoc($result);
    $cid=$row['c_id'];

    }


  $password=mysqli_real_escape_string($con,$_POST['repass']);
  $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);


  if($password === "" || $cid=== ""){
      echo "Data Not Properly Entered Please Re-Register.";

  }
  else{
  $query = "UPDATE customer SET c_password='$hashed_pwd' WHERE c_id=$cid";
  $result = mysqli_query($con, $query);

  if($result){
      echo "Password Updated Successfully.";
  }


}

?>
