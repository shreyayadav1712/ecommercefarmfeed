<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';


$phone=mysqli_real_escape_string($con,$_POST['number']);
$str = substr($phone, 3);
if($str===''){
  echo "Not there .";
}
else{
  // echo $str;
$query = "SELECT * from customer WHERE c_phone='$str'";
$result = mysqli_query($con, $query);
$present=mysqli_num_rows ($result);

    if($present == 0){
      echo 'false';
    }
    else{
      echo 'true';
    }


}

?>
