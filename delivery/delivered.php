<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['Delid'])) {
  $id=$_SESSION['Delid'];
  }else {
  header("Location: ./dlogin.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Delivered Items</title>
<link rel="icon" href="../images/circle.png">
</head>
<body background="../images/back2.jpg">
  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'deliveryheader.php';
   ?>
<!--NavBar Ends-->
<br><br>
<div class="card ownercard">
  <h3 style="text-align:center;">Dispatched Orders</h3>
  <table class="table table-hover" style="padding:20px;">
  <thead>
  <tr>
    <th scope="col">Order No.</th>
    <th scope="col">Dispatched At</th>
    <th scope="col">Details</th>
  </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM finalorder WHERE delivery=1 && deliveryboy=$id ORDER BY timedelivery DESC;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {
        while ($row1 = mysqli_fetch_assoc($result)) {
          $ordertime=date('d/m/y h:i a', $row1['timeorder']);
          $dispatchtime=date('d/m/y h:i a', $row1['timedispatch']);
          $delivertime=date('d/m/y h:i a', $row1['timedelivery']);
            echo '
            <tr>
              <th scope="col">'.$row1['o_id'].'</th>
              <th scope="col">'.$delivertime.'</th>
              <th scope="col">
              <form action="./order.php" method="post" id="form1">
                <input type="hidden" name="orderid" value="'.$row1['o_id'].'">
                <input type="hidden" name="customerid" value="'.$row1['c_id'].'">
                <input type="hidden" name="ordertime" value="'.$ordertime.'">
                <input type="hidden" name="dispatchtime" value="'.$dispatchtime.'">
                <input type="hidden" name="delivertime" value="'.$delivertime.'">
                <input type="hidden" name="deliveryboyid" value="'.$row1['deliveryboy'].'">
                <input type="submit"class="btn btnwhite" name="vieworderitems" value="View">
              </form>
              </th>
            </tr>';
        }
      }

     ?>
  </tbody>
  </table>
</div>

       <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
