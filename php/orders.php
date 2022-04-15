<!DOCTYPE html>
<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['logintype'])) {
  $id=$_SESSION['Custid'];
  }else {
  header("Location: ./home.php");
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Orders</title>
    <link rel="icon" href="../images/circle.png">
  </head>
  <body>

    <?php
      include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
     ?>

     <div class="pag">
     <p class="pagehead"> <?php echo lang('my_orders')?> </p>
     </div>
     <?php
     $query123 = "SELECT * FROM finalorder WHERE c_id=$id && delivery=0;";
     $result123 = mysqli_query($con, $query123);
     if (mysqli_num_rows($result123) > 0)
     {
         while ($row123 = mysqli_fetch_assoc($result123)) {
            $oredrid=$row123['o_id'];
     $query = "SELECT * FROM cart WHERE c_id=$id && o_id=$oredrid;";
     $result = mysqli_query($con, $query);
     $totalfinalprice=0;

     echo '<div class="card ordercard">
     <div class="mainbox1">';
   if (mysqli_num_rows($result) > 0)
   {
       while ($row1 = mysqli_fetch_assoc($result)) {
         $iid=$row1['item_id'];
         $query12 = "SELECT * FROM items WHERE item_id=$iid";
         $result12 = mysqli_query($con, $query12);
         $row12 = mysqli_fetch_assoc($result12);
         $basicprize=$row12['price'];
         $type=$row12['type'];
         $quantity=$row12['quantity'];
         $weight=$row1['weight'];
         if ($type==1) {
           $conversion=$weight/250;
           $finalprice=$basicprize*$conversion;
           $totalfinalprice=$totalfinalprice+$finalprice;
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
           $finalprice=$basicprize*$conversion;
           $totalfinalprice=$totalfinalprice+$finalprice;
           if ($weight == 1) {
             $unit="piece";
           }
           else {
            $unit="pieces";
           }
         }
         else if ($type==3) {
          $conversion=$weight/250;
          $finalprice=$basicprize*$conversion;
          $totalfinalprice=$totalfinalprice+$finalprice;
          if ($weight < 1000) {
            $unit="ml";
          }
          else {
             $unit="ltr";
             $weight=$weight/1000;
          }
        }

         echo '
         <div class="subcontain1 box">
           <div class="box box1">
             <img src="../images/Veg/'.$row12['img'].'" alt=""style="width: 136px;padding: 8px;height: 164px;background-size: contain;">

             <div class="mainbox2">
             <h3>'.lang($row12['i_eng']).'</h3>
             <div class="mainbox3">
             <p>₹'.$finalprice.'</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <p>'.$weight.' '.$unit.'</p>
             </div>
             </div>
             </div>
             </div>
         ';

       }

       echo '</div>
       <div class="card totalprice" >
       <h3 style="font-weight:700;">'.lang('total_price').' ₹'.$totalfinalprice.'</h3>

       </div></div><br><br>';
     }
   }
 }
 else {
   echo '<div class="mainbox1">No New Orders.</div>';
 }
      ?>
      <br><br><br>
      <div class="card dashcard4">
        <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Order No.</th>
          <th scope="col">Order Date</th>
          <th scope="col">Delivery Date</th>
          <th scope="col">Recipt</th>
        </tr>
      </thead>
      <tbody>
          <?php
          $query = "SELECT * FROM finalorder WHERE c_id=$id && delivery=1 ORDER BY o_id DESC;";
          $result = mysqli_query($con, $query);
          if (mysqli_num_rows($result) > 0)
          {
              while ($row1 = mysqli_fetch_assoc($result)) {

                $ordertime=date('d/m/y h:i a', $row1['timeorder']);
                $delivertime=date('d/m/y h:i a', $row1['timedelivery']);
                  echo '
                  <tr>
                    <th scope="col">'.$row1['o_id'].'</th>
                    <th scope="col">'.$ordertime.'</th>
                    <th scope="col">'.$delivertime.'</th>
                    <th scope="col">
                    <form action="./invoice.php" method="post" id="form1">
                      <input type="hidden" name="orderid" value="'.$row1['o_id'].'">
                      <input type="hidden" name="ordertime" value="'.$ordertime.'">
                      <input type="hidden" name="delivertime" value="'.$delivertime.'">
                      <input type="submit"class="btn btnwhite" name="invoice" value="View">
                    </form></th>
                  </tr>';
              }
            }

           ?>
      </tbody>
    </table>

      </div>

<br><br><br>



       <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>


      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </body>
</html>
