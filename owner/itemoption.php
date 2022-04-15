<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['Ownerid'])) {
  $id=$_SESSION['Ownerid'];
  }else {
  header("Location: ./ownerlogin.php");
}
if (isset($_SESSION['Ownerid'])) {
  $id=$_SESSION['Ownerid'];
  if (isset($_POST['itementry'])) {
    $itemid=$_POST['item'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $query = "UPDATE items SET quantity=$quantity, price=$price WHERE item_id=$itemid";
    $result = mysqli_query($con, $query);
    echo "<script type='text/javascript'>
    alert('Quantity and Price updated Successfully.');
     window.location='./ownerdash.php';
       </script>";
  }
  }else {
  header("Location: ./ownerlogin.php");
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
<title>Stock</title>
<link rel="icon" href="../images/circle.png">
</head>
<body background="../images/back2.jpg">
  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ownerheader.php';
   ?>
<!--NavBar Ends-->
<br><br>
<div class="card ownercard" style="padding:10px 50px">
  <h3 style="text-align:center;">Enter Stock Quantity & Price</h3><br><br>
  <form class="" action="" method="post">
    <div class="form-group">
    <select class="form-control customselect smaller classic" name="item" id="item" required>
      <option value="" selected disabled>Select item</option>
      <?php
      $query = "SELECT item_id,i_eng FROM items;";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) > 0)
      {
        while ($row1 = mysqli_fetch_assoc($result)) {
              echo '<option value="'.$row1['item_id'].'">'.$row1['i_eng'].'</option>';
          }
        }
       ?>
    </select>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
      <label for quantity><b>Quantity (Grams, ml, piece)</b> </label>
        <input type="number" name="quantity" class="form-control"id="quantity" placeholder="Quantity in (Grams, ml, piece)">
         <span id="quamsg"></span>
      </div>
    </div>
    <div class="col">
      <div class="form-group">
      <label for price><b>Price (for 250g, 250ml, 1 Piece)</b> </label>
        <input type="number" name="price" class="form-control"id="price" placeholder="Price (for 250g, 250ml, 1 Piece)">
      <span id="primsg"></span>
      </div>
    </div>
  </div>
  <div class="text-center">
      <button class="btn btngreen" name="itementry" id="btn">Enter</button>
  </div>
  </form>
</div>


<br><br><br><br>
<div class="card ownercard">
  <h3 style="text-align:center;">Stock</h3><br><br>
  <table class="table table-hover" style="padding:20px;">
<thead>
  <tr>
    <th scope="col">Items</th>
    <th scope="col">Quantity</th>
    <th scope="col">Price (per 250g, 250ml, 1 Piece)</th>
  </tr>
</thead>
<tbody>
    <?php
    $query = "SELECT * FROM items;";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0)
    {
        while ($row1 = mysqli_fetch_assoc($result)) {
            $quantity=$row1['quantity'];
            if ($quantity > 0) {
              $type=$row1['type'];
              if ($type==1) {
                $fquantity=$quantity/1000;
                $unit="kg";
              }
              else if ($type==2) {
                $fquantity=$quantity;
                if ($fquantity==1) {
                  $unit="piece";
                }
                else {
                $unit="pieces";
                }
              }else if ($type==3) {
                $fquantity=$quantity/1000;
                $unit="litre";
              }
            echo '
            <tr>
              <th scope="col">'.$row1['i_eng'].'</th>
              <th scope="col">'.$fquantity.' '.$unit.'</th>
              <th scope="col">₹'.$row1['price'].'</th>
            </tr>';

          }
        }
      }

     ?>
</tbody>
</table>
</div><br><br>
<script type="text/javascript">
$(document).ready(function(){



   $("#quantity").keyup(function(){
  // check
     if(valqua()){

       $("#quantity").css("border","2px solid #009975");

       $("#quamsg").html("<p class='text-success'>Validated</p>");
      }else{

       $("#quantity").css("border","2px solid red");

        $("#quamsg").html("<p class='text-danger'>Must be numbers</p>");
       }
       buttonState();
   });
    $("#btn").prop('disabled', true);
   $("#price").keyup(function(){
  // check
     if(valpri()){

       $("#price").css("border","2px solid #009975");

       $("#primsg").html("<p class='text-success'>Validated</p>");
      }else{

       $("#price").css("border","2px solid red");

        $("#primsg").html("<p class='text-danger'>Must be number</p>");
       }
       buttonState();
   });
});
   function buttonState(){
    if(valpri() && valqua()){

      $("#btn").prop('disabled', false);
    }else{

      $("#btn").prop('disabled', true);
    }
  }


  function valqua(){
    var number_check=new RegExp('[0-9]');
    var qu=$("#quantity").val();
    if(qu.match(number_check)){
      return true;
    }  else{
      return false;
    }
  }
  function valpri(){
    var number_check=new RegExp('[0-9]');
    var pr=$("#price").val();
    if(pr.match(number_check)){
      return true;
    }  else{
      return false;
    }
  }
         </script>
                <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
