  <?php
  include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
  session_start();
  if (isset($_SESSION['Delid'])) {
    $id=$_SESSION['Delid'];
    }else {
    header("Location: ./ownerlogin.php");
  }
  if (isset($_SESSION['Delid'])) {
    $id=$_SESSION['Delid'];
    if (isset($_POST['vieworderitems'])) {
      $deliver=0;
      $orderid=$_POST['orderid'];
      $cid=$_POST['customerid'];
      $ordertime=$_POST['ordertime'];
      if (isset($_POST['deliveryboyid'])) {
        $deliverid=$_POST['deliveryboyid'];
        $query5 = "SELECT f_name,l_name FROM employee WHERE d_id=$deliverid";
        $result5 = mysqli_query($con, $query5);
        $row5 = mysqli_fetch_assoc($result5);
        $deliverboy=$row5['f_name']." ".$row5['l_name'];
      }
      if (isset($_POST['deliveryboy'])) {
        $deliver=$_POST['deliveryboy'];
      }
      if (isset($_POST['dispatchtime'])) {
        $dispatchtime=$_POST['dispatchtime'];
      }
      if (isset($_POST['delivertime'])) {
        $delivertime=$_POST['delivertime'];
      }
    }
    if (isset($_POST['delivered'])) {
      $currenttime=time();
      $orderid=$_POST['orderid'];
      $query = "UPDATE finalorder SET delivery=1,timedelivery=$currenttime WHERE o_id=$orderid";
      $result = mysqli_query($con, $query);
      echo "<script type='text/javascript'>
      alert('Order ".$oerderid." is Delivered.');
       window.location='./deliverydash.php';
         </script>";
    }
    }else {
    header("Location: ./dlogin.php");
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
  <title>Order View</title>
  <link rel="icon" href="../images/circle.png">
  </head>
  <body background="../images/back2.jpg">
    <?php
      include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'deliveryheader.php';
     ?>
  <!--NavBar Ends-->
  <br><br>
  <div class="card ownercard">
    <?php   if (isset($_POST['vieworderitems'])) {
      $query13 = "SELECT * FROM customer WHERE c_id=$cid;";
      $result13 = mysqli_query($con, $query13);
      $row13 = mysqli_fetch_assoc($result13);
       ?>
      <h4 style="text-align:center;">Order Id.<?php echo $orderid; ?></h4>
      <h5>Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row13['f_name']; ?> <?php echo $row13['l_name']; ?> </h5>
      <h5>Mobile No. :&nbsp;&nbsp;&nbsp; <?php echo $row13['c_phone']; ?> </h5>
      <h5>Email Id : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo  $row13['c_email']; ?> </h5>
      <h5>Address :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row13['c_address']; ?> <?php echo $row13['c_pin']; ?> </h5>
      <?php if (isset($_POST['deliveryboyid'])) { ?>
        <h5>Delivered By :&nbsp; <?php echo $deliverboy; ?></h5>
      <?php } ?>
  <h5>Ordered At :&nbsp;&nbsp;&nbsp; <?php echo $ordertime; ?></h5>
  <?php if (isset($dispatchtime)) { ?>
  <h5>Dispatched At:<?php echo $dispatchtime; ?></h5>
  <?php } ?>
  <?php if (isset($delivertime)) { ?>
  <h5>Delivered At:&nbsp;&nbsp;&nbsp;<?php echo $delivertime; ?></h5>
  <?php } ?>
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
            $price=$row12['price'];
            $finalprice=$finalprice+$price;
            $itemid=$row12['item_id'];
            $query12 = "SELECT i_eng,type FROM items WHERE item_id=$itemid;";
            $result12 = mysqli_query($con, $query12);
            $row1 = mysqli_fetch_assoc($result12);
            $type=$row1['type'];
            $weight=$row12['weight'];
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
         <th scope="col" colspan=2>Total Price</th>
         <th scope="col">₹<?php echo $finalprice; ?></th>
       </tr>
       </thead>
    </tbody>
    </table>
  <br><br>
  <?php if ($deliver==1) {?>
  <h4>Delivery Status</h4><br>
    <form class="" action="" method="post">
      <input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
      <input type="submit" class="btn btngreen" name="delivered" id="btn" value="Delivered">
      <br> <small>Click if Delivered.</small>
    </form>

  <?php } ?>
  <?php } ?>

<br><br>


  </div>
         <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  </html>
