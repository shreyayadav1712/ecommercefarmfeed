<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['Custid']) && isset($_POST['invoice'])) {
  $id=$_SESSION['Custid'];
  $orderid=$_POST['orderid'];
  $delivertime=$_POST['delivertime'];
  $ordertime=$_POST['ordertime'];
}else {
  header("Location: ./home.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
<title>Invoice</title>
<link rel="icon" href="../images/circle.png">
</head>
<body background="../images/back2.jpg">
  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
   ?>

<!--NavBar Ends-->
<br><br>
<div class="card ownercard">
  <?php   if (isset($_POST['invoice'])) {
    $query13 = "SELECT * FROM customer WHERE c_id=$id;";
    $result13 = mysqli_query($con, $query13);
    $row13 = mysqli_fetch_assoc($result13);
     ?>
    <h4 style="text-align:center;">Order No.<?php echo $orderid; ?></h4>
    <div class="row">
      <div class="col">
          <h5>Name : <?php echo $row13['f_name']; ?> <?php echo $row13['l_name']; ?> </h5>
      </div>
    </div>
    <div class="row">
      <div class="col">
          <h5>Address : <?php echo $row13['c_address']; ?> <?php echo $row13['c_pin']; ?> </h5>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5>Mobile No. : <?php echo $row13['c_phone']; ?> </h5>
      </div>
      <div class="col">
        <h5>Email Id :  <?php echo  $row13['c_email']; ?> </h5>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h5>Ordered At : <?php echo $ordertime; ?></h5>
      </div>
      <div class="col">
        <h5>Delivered At:<?php echo $delivertime; ?></h5>
      </div>
    </div>

    <br><br>
  <table class="table table-hover" style="padding:20px;">
  <thead>
  <tr>
    <th scope="col"><?php echo lang('products') ?></th>
    <th scope="col"><?php echo lang('quantity') ?></th>
    <th scope="col"><?php echo lang('price') ?></th>
  </tr>
  </thead>
  <tbody>
    <?php

    $query = "SELECT * FROM cart WHERE o_id=$orderid;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {
      $finalprice=0;
        while ($row12 = mysqli_fetch_assoc($result)) {
          $weight=$row12['weight'];
          $price=$row12['price'];
          $finalprice=$finalprice+$price;
          $itemid=$row12['item_id'];
          $query12 = "SELECT i_eng,type FROM items WHERE item_id=$itemid;";
          $result12 = mysqli_query($con, $query12);
          $row1 = mysqli_fetch_assoc($result12);

          $type=$row1['type'];
          if ($type==1) {
            $conversion=$weight/250;
            if ($weight < 1000) {
              $unit="g";
            }
            else {
               $unit="kg";
               $weight=$weight/1000;
            }
          }
          else if ($type==2) {
            $conversion=$weight;
            if ($weight == 1) {
              $unit="piece";
            }
            else {
             $unit="pieces";
            }
          }
          if ($type==3) {
            $conversion=$weight/250;
            if ($weight < 1000) {
              $unit="ml";
            }
            else {
               $unit="litre";
               $weight=$weight/1000;
            }
          }

            echo '
            <tr>
              <td scope="col">'.lang($row1['i_eng']).'</td>
              <td scope="col">'.$weight.' '.$unit.'</td>
              <td scope="col">₹'.$price.'</td>
            </tr>';
        }
      }
     ?>
     <thead>
     <tr>
       <th scope="col" colspan=2><?php echo lang('total_price')?></th>
       <th scope="col">₹<?php echo $finalprice; ?></th>
     </tr>
     </thead>
  </tbody>
  </table>
<br><br>

<?php } ?>




</div>
       <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
