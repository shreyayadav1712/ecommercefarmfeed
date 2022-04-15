<?php
  include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);

  if(isset($_GET['lang'])){
    $getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
  }
  else{
    $getLang="english";
  }

  if (!empty($getLang)) {
    $_SESSION['language'] = $getLang;
  }
  include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'langs'.DIRECTORY_SEPARATOR.'set_lang.php';

  $did = $_REQUEST['s_id'];
  $cid = (int) $_REQUEST['c_id'];
  if($cid != 0){
    if ($did==1) {
      $query = "SELECT * FROM items WHERE category_type = {$cid} ORDER BY i_eng ASC";
      $result = mysqli_query($con, $query);
    } elseif($did==2) {
      $query = "SELECT * FROM items WHERE category_type = {$cid} ORDER BY i_eng DESC";
      $result = mysqli_query($con, $query);
    }elseif($did==3) {
      $query = "SELECT * FROM items WHERE category_type = {$cid} ORDER BY price ASC";
      $result = mysqli_query($con, $query);
    }
    elseif($did==4) {
      $query = "SELECT * FROM items WHERE category_type = {$cid} ORDER BY price DESC";
      $result = mysqli_query($con, $query);
    }else {
      $query = "SELECT * FROM items WHERE category_type = {$cid}";
      $result = mysqli_query($con, $query);
    }
  }else{
    if ($did==1) {
      $query = "SELECT * FROM items ORDER BY i_eng ASC";
      $result = mysqli_query($con, $query);
    } elseif($did==2) {
      $query = "SELECT * FROM items ORDER BY i_eng DESC";
      $result = mysqli_query($con, $query);
    }elseif($did==3) {
      $query = "SELECT * FROM items ORDER BY price ASC";
      $result = mysqli_query($con, $query);
    }
    elseif($did==4) {
      $query = "SELECT * FROM items ORDER BY price DESC";
      $result = mysqli_query($con, $query);
    }else {
      $query = "SELECT * FROM items";
      $result = mysqli_query($con, $query);
    }
  }
  
  echo '<div class="maincontain">';
  $allok=0;
  if (mysqli_num_rows($result) > 0){
    while ($row1 = mysqli_fetch_assoc($result)) {
      $eng=$row1['i_eng'];
      $allok=0;
      $img=$row1['img'];
      $type=$row1['type'];
      $itemid=$row1['item_id'];
      $price=$row1['price'];
      $type=$row1['type'];
      $quantity=$row1['quantity'];
      if ($type==1) {
        if ($quantity > 0) {
          $avaiquantity=($quantity/1000);
          $allok=1;
          $finalprice=$price*4;
          $unit="kg";
        }
      }
      else if ($type==2) {
        if ($quantity > 0) {
          $avaiquantity=($quantity);
          $allok=1;
          $finalprice=$price;
          $unit="pieces";
        }
      }
      else if ($type==3) {
        if ($quantity > 0) {
          $avaiquantity=($quantity/1000);
          $allok=1;
          $finalprice=$price*4;
          $unit="litre";
        }
      }
      if ($allok==1) {
        echo '
        <div class="subcontain box">
          <div class="card newscard">
            <figure>
            <img style=" width:100%;height: 200px;background-size: contain;"  src="../images/Veg/'.$img.'" alt="Card image cap">
            </figure>
            <div class="card-body" style="width:80%;margin:auto;">
                <h5 class="card-title name">'.lang($eng).'</h5>
                <form method="post">
                <input type="hidden" name="itemid" value="'.$itemid.'">
                <input type="hidden" name="itemtype" value="'.$type.'">
                <input type="hidden" name="itemprice" value="'.$price.'">';

                if ($type==1) {
                  echo'
                    <div class="form-group">
                      <select class="form-control customselect classic" name="quantity1" id="qty" required>
                        <option value="" selected disabled>'.lang('quantity').'</option>
                        <option value="250">250g&nbsp;&nbsp;&nbsp;&nbsp;₹'.((250/250)*$price).' </option>
                        <option value="500">500g&nbsp;&nbsp;&nbsp;&nbsp;₹'.((500/250)*$price).' </option>
                        <option value="1000">1kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((1000/250)*$price).' </option>
                        <option value="1500">1.5kg&nbsp;&nbsp;&nbsp;₹'.((1500/250)*$price).' </option>
                        <option value="2000">2kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((2000/250)*$price).' </option>
                        <option value="3000">3kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((3000/250)*$price).' </option>
                        <option value="5000">5kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((5000/250)*$price).' </option>
                      </select>
                    </div>';
                }
                if ($type==2) {
                  echo'
                    <div class="form-group">
                      <select class="form-control customselect classic" name="quantity1" id="qty" required>
                        <option value="" selected disabled>'.lang('quantity').'</option>
                        <option value="1">1 piece&nbsp;&nbsp;&nbsp;&nbsp;₹'.(1*$price).'</option>
                        <option value="2">2 pieces&nbsp;&nbsp;&nbsp;₹'.(2*$price).'</option>
                        <option value="3">3 pieces&nbsp;&nbsp;&nbsp;₹'.(3*$price).'</option>
                        <option value="4">4 pieces&nbsp;&nbsp;&nbsp;₹'.(4*$price).'</option>
                        <option value="5">5 pieces&nbsp;&nbsp;&nbsp;₹'.(5*$price).'</option>
                      </select>
                    </div>';
                }
                if ($type==3) {
                  echo'
                    <div class="form-group">
                      <select class="form-control customselect classic" name="quantity1" id="qty" required>
                        <option value="" selected disabled>'.lang('quantity').'</option>
                        <option value="250">250 ml&nbsp;&nbsp;&nbsp;&nbsp;₹'.((250/250)*$price).' </option>
                        <option value="500">500 ml&nbsp;&nbsp;&nbsp;&nbsp;₹'.((500/250)*$price).' </option>
                        <option value="1000">1 litre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((1000/250)*$price).' </option>
                        <option value="1500">1.5 litre&nbsp;&nbsp;&nbsp;₹'.((1500/250)*$price).' </option>
                        <option value="2000">2 litre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((2000/250)*$price).' </option>
                        <option value="3000">3 litre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((3000/250)*$price).' </option>
                        <option value="5000">5 litre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₹'.((5000/250)*$price).' </option>
                      </select>
                    </div>';
                }
                echo '
                  <div class="row">
                    <div class="col">
                      <input type="button" class="btn btngreen" style="text-align:left;" value="₹'.$finalprice.'/'.$unit.'"/>
                    </div>
                    <div class="col">
                      <input type="submit" name="addtocart" class="btn btnwhite" value="'.lang('add_to_cart').'">
                    </div>
                  </div>
                  </form>
                  </div>
                  </div>
                  </div>';
      }

    }
  }
  echo "</div>";
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
 ?>
