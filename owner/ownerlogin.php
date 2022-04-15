<!DOCTYPE html>
<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['Delid'])) {
  header("Location: ../delivery/deliverydash.php");
}
if (isset($_SESSION['Ownerid'])) {
  header("Location: ../owner/ownerdash.php");
}
if (isset($_POST['loginowner'])) {
  $mail = mysqli_real_escape_string($con,$_POST['o_number']);
  $query = "SELECT * FROM owner WHERE email='$mail'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $id = $row['owner_id'];
  $pass = $row['password'];
  $password = mysqli_real_escape_string($con,$_POST['o_password']);


  if (password_verify($password, $pass)) {
    $_SESSION['Ownerid'] = $id;
    $_SESSION['logintype'] = "0";
    // echo "Session set";
    header("Location: ./ownerdash.php");
  } else {
    header("Location: ./ownerlogin.php");
  }

}
 ?>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
<link rel="icon" href="../images/circle.png">
<link rel="manifest" href="../php/webmanifest.json">
<title>Owner Login</title>
</head>

<body>
  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ownerheader.php';
   ?><br><br>
  <p class="languages"><a href="?lang=english">English</a> | <a href="?lang=marathi">मराठी</a> | <a href="?lang=hindi">हिन्दी</a></p>
  <br><br>
<div class="card logcard">
  <h3 class="cardhead">Owner Login</h3>
  <form method="post">
  <br>
     <div class="form-group">
      <label for logpassword><b><?php echo lang('email')?></b> </label>
         <input type="email" class="form-control" name="o_number" id="email" placeholder=<?php echo lang('email') ;?> required>
          <span id="emmsg"></span>
     </div>
  <div class="form-group">
    <label for logpassword><b><?php echo lang('password')?></b> </label>
    <input type="password"name="o_password" class="form-control" name="logpass" id="logpassword" placeholder=<?php echo lang('password')?>>
     <span id="pomsg">
  </div>
  <br><br>
  <button class="btn btngreen" name="loginowner" id="btn"><?php echo lang('login_btn')?></button>
  </form>
  </div>
<br><br>

<script src="../php/index.js" type="module"></script>

<script type="text/javascript">
  $(document).ready(function(){

     $("#btn").prop('disabled', true);

    $("#lognum").keyup(function(){

      if(validatePass()){

        $("#lognum").css("border","2px solid #009975");

        $("#momsg").html("<p class='text-success'>Mobile Number validated</p>");
      }else{

        $("#lognum").css("border","2px solid red");

        $("#momsg").html("<p class='text-danger'>Should be 10 digits</p>");
      }
      buttonState();
    });
      $("#logpassword").keyup(function(){
      // check
      if(validatePass()){

        $("#logpassword").css("border","2px solid #009975");

        $("#pomsg").html("<p class='text-success'>Validated</p>");
      }else{

        $("#logpassword").css("border","2px solid red");

        $("#pomsg").html("<p class='text-danger'>Password not valid</p>");
      }
      buttonState();
    });
  });
  $("#email").keyup(function(){
     // check
     if(valEmail()){

       $("#email").css("border","2px solid #009975");

       $("#emmsg").html("<p class='text-success'>Email Validated</p>");
     }else{

       $("#email").css("border","2px solid red");

       $("#emmsg").html("<p class='text-danger'>Not in email format</p>");
     }
     buttonState();
   });

  function buttonState(){
    if(validatePass() && valEmail()){

       $("#btn").prop('disabled', false);
    }else{

      $("#btn").prop('disabled', true);
    }
  }


  function valMob(){
    var number_check=new RegExp('[0-9]');
    var mob1=$("#lognum").val();
    if(mob1.length==10  && mob1.match(number_check)){
      return true;
    }  else{
      return false;
    }
  }
  function valEmail(){
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var em=$("#email").val();
    if(em.match(regex)){
      return true;
    }  else{
      return false;
    }
  }
  function validatePass(){
    var passw=$("#logpassword").val();

    if(passw.length > 2){
      return true;
    }else{
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
