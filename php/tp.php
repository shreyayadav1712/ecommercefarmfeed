<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
  $password='farm@1999';
  $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO `owner`(`f_name`, `l_name`, `email`, `password`) VALUES ('jay','patil','farmfresh@gmail.com','$hashed_pwd');";
$result = mysqli_query($con, $query);

 ?>
