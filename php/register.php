<?php
session_start();
if (isset($_SESSION['Custid'])) {
  header("Location: ./home.php");
}
 ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sign up</title>
<link rel="icon" href="../images/circle.png">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
</head>

<body>
  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
   ?><br><br>
   <p class="languages"><a href="?lang=english">English</a> | <a href="?lang=marathi">मराठी</a> | <a href="?lang=hindi">हिन्दी</a></p>
   <br><br>
<div class="card regcard">
  <h3 class="cardhead"><?php echo lang('sign_up') ;?></h3>
  <form action="#" id="form" >
  <br>
  <div class="row">
    <div class="col">
      <div class="error-text">This is an error message!!</div>
    </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="fname" id="firstname" placeholder="<?php echo lang('fname') ;?>" required>
             <span id="fnamemsg"></span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="lname" id="lastname" placeholder="<?php echo lang('lname') ;?>" required>
             <span id="lnamemsg"></span>
         </div>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
             <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo lang('email') ;?>" required>
              <span id="emmsg"></span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="mobile" id="mobile" placeholder="<?php echo lang('mobile') ;?>" required>
             <span id="mobilemsg"></span>
         </div>
      </div>
  </div>
  <div class="form-group">
    <textarea class="form-control" name="address" placeholder="<?php echo lang('delivery') ;?>"  id="add" rows="2" columns="10" required></textarea>
    <span id="addmsg"></span>
  </div>
  <div class="form-group">
    <input type="number" class="form-control" name="pincode" id="pin" placeholder="<?php echo lang('pin')?>"  required>
    <span id="pinMsg"></span>
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" id="pass" placeholder="<?php echo lang('enter_password')?>"  required>
    <span id="passMsg"></span>
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="repassword" id="pass1" placeholder="<?php echo lang('re_enter_pass')?>" required>
    <span id="pass1Msg"></span>
  </div>
  <input type="button" style="width:210px;" class="btn btn3" onclick="getLocation()"value="<?php echo lang('get_location')?>" />
  <br>
  <small>Allow Location Access On Your Device</small><br>
  <small>For each entry get new location.</small>
  <p id="demo" ></p>
  <input type="hidden" id="lat" name="lat" />
  <input type="hidden" id="long" name="long"  />
  <span id="getloc" class="text-danger" style="font-weight: 700"></span>

  <button class="btn btngreen" type="submit"name="register" id="btn"><?php echo lang('REGISTER')?></button>
  </form>
</div>

<br><br>


<?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src='./register.js'></script>
</body>
</html>
