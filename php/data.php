<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';

$password=mysqli_real_escape_string($con,$_POST['password']);
$fname=mysqli_real_escape_string($con,$_POST['fname']);
$lname=mysqli_real_escape_string($con,$_POST['lname']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$pin=mysqli_real_escape_string($con,$_POST['pincode']);
$address=mysqli_real_escape_string($con,$_POST['address']);
$phone=mysqli_real_escape_string($con,$_POST['number']);

$lat1=mysqli_real_escape_string($con,$_POST['latitude']);
$lon1=mysqli_real_escape_string($con,$_POST['longitude']);
$str = substr($phone, 3);
  $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
if($password === "" || $fname=== "" || $lname=== "" || $email === ""|| $pin=== "" || $address=== "" || $phone === ""){
    echo "Data Not Properly Entered Please Re-Register.";

}
else{
$query = "INSERT INTO `customer`(`f_name`, `l_name`, `c_address`, `c_pin`, `c_phone`, `c_email`, `c_password`, `latitude`, `longitude`) VALUES ('$fname','$lname','$address','$pin',$str,'$email','$hashed_pwd','$lat1','$lon1')";
$result = mysqli_query($con, $query);

if($result){
    echo "User Registered Successfully.";
}

}


?>
