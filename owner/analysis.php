<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['Ownerid'])) {
  $id=$_SESSION['Ownerid'];
  }else {
  header("Location: ./ownerlogin.php");
}

 ?>
<html lang="en">
<head>
  <title>Delivery Boy Details</title>
  <link rel="icon" href="../images/circle.png">
</head>
<body>

  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ownerheader.php';
   ?>
   <br><br>
<div class="card ownercard">
  <h3 style="text-align:center">Select Dates</h3>
<form class="" action="" method="post" >
  <div class="row " >
    <div class="col-md-4">
      <div class="form-group">
        <label for="sdate">Start Date</label>
        <input type="date" name="date1" class="form-control" id="sdate" placeholder="Since when" required>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="epdate">End Date</label>
        <input type="date" name="date2" class="form-control" id="epdate" placeholder="Since when" required>
      </div>
    </div>
    <div class="col-md-4" style="margin:auto">
        <input type="submit"class="btn btnwhite" name="time" value="View">
    </div>
  </div>
</form>
</div>
<br><br>
<?php if (isset($_POST['time'])) {

  $date1 = explode('-', mysqli_real_escape_string($con,$_POST['date1']));
               $month = $date1[1];
                $day   = $date1[2];
               $year  = $date1[0];
               $hour=00;
               $minu=00;
               $dateStr = "$month"."/".$day."/"."$year";
               $timeStr = "$hour".":"."$minu".":00";
               list($hours, $minu) = explode(':', $timeStr);
               $dateTime = DateTime::createFromFormat('m/d/Y', $dateStr)->setTime($hours, $minu);
               $timeStamp = $dateTime->getTimestamp();

               $date2 = explode('-',mysqli_real_escape_string($con, $_POST['date2']));
               $month2 = $date2[1];
               $day2   = $date2[2];
               $year2  = $date2[0];
               $hour2=23;
               $minu2=59;
               $dateStr2 = "$month2"."/".$day2."/"."$year2";
               $timeStr2 = "$hour2".":"."$minu2".":00";
               list($hours2, $minu2) = explode(':', $timeStr2);
               $dateTime = DateTime::createFromFormat('m/d/Y', $dateStr2)->setTime($hours2, $minu2);
               $timeStamp2 = $dateTime->getTimestamp();

               $from=date('d/m/y',$timeStamp);
               $to=date('d/m/y',$timeStamp2);
                ?>


<div class="card ownercard">
  <h3 style="text-align:center;">Deliveries From:<?php echo $from; ?>   To:<?php echo $to; ?> </h3>
  <table class="table table-hover" style="padding:20px;">
  <thead>
  <tr>
    <th scope="col">Item</th>
    <th scope="col">Quantity</th>
    <th scope="col">Price</th>
  </tr>
  </thead>
  <tbody>
    <?php
    $totalfinal=0;
    $query2 = "SELECT o_id FROM finalorder WHERE delivery=1 && timedelivery BETWEEN $timeStamp AND $timeStamp2";
    $result2 = mysqli_query($con, $query2);
    $query = "SELECT item_id,i_eng,type FROM items;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {


        while ($row1 = mysqli_fetch_assoc($result)) {
          $finalquantity=0;
          $finalprice=0;
          if (mysqli_num_rows($result2) > 0)
          {
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $orderid = $row2['o_id'];
                $query3 = "SELECT price,weight FROM cart WHERE o_id=$orderid && item_id=".$row1['item_id'];
                $result3 = mysqli_query($con, $query3);
                if (mysqli_num_rows($result3) > 0)
                {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                      $finalprice=$finalprice+$row3['price'];
                      $totalfinal=$totalfinal+$finalprice;
                      $finalquantity=$finalquantity+$row3['weight'];
                    }

                  }
              }
              if ($finalquantity > 0) {

                $weight=$finalquantity;

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
                $finalquantity=$weight;

              echo '
              <tr>
                <th scope="col">'.$row1['i_eng'].'</th>
                <th scope="col">'.$finalquantity.' '.$unit.'</th>
                <th scope="col">₹'.$finalprice.'</th>
              </tr>';
            }
              mysqli_data_seek($result2, 0);
            }

        }
      }

     ?>
     <tr>
       <th colspan="2">Total Collection</th>
       <th>₹<?php echo $totalfinal; ?></th>
     </tr>
  </tbody>
  </table>
</div>
<br><br><br>
<div class="card ownercard">
  <h3 style="text-align:center;">Delivery boy Details From: <?php echo $from; ?> To:<?php echo $to; ?> </h3>
  <table class="table table-hover" style="padding:20px;">
  <thead>
  <tr>
    <th scope="col">Id</th>
    <th scope="col">Name</th>
    <th scope="col">Mobile No.</th>
    <th scope="col">Orders</th>
    <th scope="col">Collection</th>
  </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM employee;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {
        while ($row1 = mysqli_fetch_assoc($result)) {
          $final=0;
          $did=$row1['d_id'];
          $query2 = "SELECT o_id FROM finalorder WHERE delivery=1 && deliveryboy=$did && timedelivery BETWEEN $timeStamp AND $timeStamp2";
          $result2 = mysqli_query($con, $query2);
          $row25 = mysqli_num_rows($result2);
          if (mysqli_num_rows($result2) > 0)
          {
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $orderid = $row2['o_id'];
                $query3 = "SELECT price FROM cart WHERE o_id=$orderid";
                $result3 = mysqli_query($con, $query3);
                if (mysqli_num_rows($result3) > 0)
                {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                      $final=$final+$row3['price'];
                    }
                  }
              }
            }

            echo '
            <tr>
              <th scope="col">'.$row1['d_id'].'</th>
              <th scope="col">'.$row1['f_name'].' '.$row1['l_name'].'</th>
              <th scope="col">'.$row1['phone'].'</th>
              <th scope="col">'.$row25.'</th>
              <th scope="col">₹'.$final.'</th>
            </tr>';
        }
      }

     ?>
  </tbody>
  </table>
</div>
<?php } ?>


       <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
