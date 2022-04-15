<?php
session_start();
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['Custid'])) {
  $id=$_SESSION['Custid'];
  if (isset($_POST['addtocart'])) {
    $itemid=$_POST['itemid'];
    $currenttime=time();
    $time=$currenttime+600;
    $quantity=$_POST['quantity1'];
    $itemtype=$_POST['itemtype'];
    $itemprice=$_POST['itemprice'];
    $query1= "SELECT cart_id,weight FROM `cart` WHERE o_id=0 && c_id=$id && item_id=$itemid";
   $result1 = mysqli_query($con, $query1);

   if (mysqli_num_rows($result1) > 0){
     $row2 = mysqli_fetch_assoc($result1);
     $cartid=$row2['cart_id'];
     $original=$row2['weight'];
     $final=$original+$quantity;
     if ($itemtype==1) {
       $conversion=$final/250;
       $finalprice=$itemprice*$conversion;
     }
     else if ($itemtype==2) { 
       $finalprice=$itemprice*$final;
     }
     else if ($itemtype==3) {
      $conversion=$final/250;
      $finalprice=$itemprice*$conversion;
    }
     $query= "UPDATE `cart` SET weight=$final,price=$finalprice WHERE cart_id=$cartid ";
     $result = mysqli_query($con, $query);
   }else {
     if ($itemtype==1) {
       $conversion=$quantity/250;
       $finalprice=$itemprice*$conversion;
     }
     else if ($itemtype==2) {
       $finalprice=$itemprice*$quantity;
     }
     else if ($itemtype==3) {
      $conversion=$quantity/250;
      $finalprice=$itemprice*$conversion;
    }
     $query= "INSERT INTO `cart`(`c_id`, `item_id`, `weight`, `price`) VALUES ($id,$itemid,$quantity,$finalprice)";
     $result = mysqli_query($con, $query);
   }
    header("Location: ./cart.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="icon" href="../images/circle.png">
  <link rel="manifest" href="webmanifest.json">
</head>
<body>

  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
   ?>
   <?php

      ?>
      <div class="pag">
     <p class="pagehead"> <?php echo lang('products')?></p>
     </div>
   <div style="margin:auto;width:70%;">
   <div class="row">
   <div class="col" style="margin: auto;">
  <p class="languages"><a href="?lang=english">English</a> | <a href="?lang=marathi">मराठी</a> | <a href="?lang=hindi">हिन्दी</a></p>
</div>

<div class="col">

  <div class="cont text-center">
    <select class="form-control sort customselect classic" name="sortby" onChange="ruralSelected()" id="sort">
      <option value="" selected disabled>Sort</option>
      <option value="1">Alphabetical: A-Z</option>
      <option value="2">Alphabetical: Z-A</option>
      <option value="3">Price: Low to High</option>
      <option value="4">Price: High to Low</option>
    </select>
  </div>
</div>

<div class="col">
  <div class="cont text-center">
    <select class="form-control category customselect classic" name="category" onChange="ruralSelected()" id="category">
      <option value="0" selected><?php echo lang('all')?></option>
      <?php
        $query=mysqli_query($con,"SELECT * FROM category");
        $rowcount=mysqli_num_rows($query);
        for($i=1;$i<=$rowcount;$i++)
        {
          $row=mysqli_fetch_array($query);
        ?>
      <option value="<?php echo $row["id"] ?>" ><?php echo $row["name"] ?></option>
      <?php
        }
      ?>
    </select>
    <!-- <select class="form-control category customselect classic" name="category" onChange="ruralSelected()" id="category">
      <option value=""  disabled>Category</option>
      <option value="1" selected>Vegetables</option>
      <option value="2">Fruits</option>
      <option value="3">Medicines</option>
    </select>  -->
  </div>
</div>
  </div>
  </div>

   <div id='rural_urban_layer' ></div>
   <script src="index.js" type="module"></script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">

// document.getElementById('my_selection').onchange = function() {
//     window.location.href = this.children[this.selectedIndex].getAttribute('href');
// }

function ruralSelected(){
    var sort = document.getElementById("sort");
    var category = document.getElementById("category");
    var c_id = category.options[category.selectedIndex].value;
    var s_id = sort.options[sort.selectedIndex].value;
     $.ajax({
         url : "card.php?s_id="+s_id+"&c_id="+c_id,
         cache : false,
         complete : function($response, $status){
            //  console.log($response.responseText);
             if ($status != "error" && $status != "timeout") {
                 $('#rural_urban_layer').html($response.responseText);
             }
         },
         error : function ($responseObj){
             alert("Something went wrong while processing your request.\n\nError => "
                 + $responseObj.responseText);
         }
     });
    }

// window.onload = function ruralSelected(){
//     var e = document.getElementById("sort");
//     var d_id = e.options[e.selectedIndex].value;
//      $.ajax({
//          url : "card.php?s_id="+d_id,
//          cache : false,
//          complete : function($response, $status){
//              console.log($response.responseText);
//              if ($status != "error" && $status != "timeout") {
//                  $('#rural_urban_layer').html($response.responseText);
//              }
//          },
//          error : function ($responseObj){
//              alert("Something went wrong while processing your request.\n\nError => "
//                  + $responseObj.responseText);
//          }
//      });
//     }



$(document).ready(function(){
  ruralSelected();
    var $btns = $('.btn').click(function() {
        if (this.id == 'all') {
          $('#parent > div').fadeIn(450);
        } else {
          var $el = $('.' + this.id).fadeIn(450);
          $('#parent > div').not($el).hide();
        }
        $btns.removeClass('active');
        $(this).addClass('active');
      })

    var $search = $("#search").on('input',function(){
        $btns.removeClass('active');
        var matcher = new RegExp($(this).val(), 'gi');
        $('.box').show().not(function(){
            return matcher.test($(this).find('.name, .sku').text())
        }).hide();
    })
})
</script>
</body>
</html>
