<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
if (isset($_SESSION['Ownerid'])) {
  $id=$_SESSION['Ownerid'];
  }else {
  header("Location: ./ownerlogin.php");
}
if (isset($_POST['delete'])) {
  $did=$_POST['did'];
  $query = "DELETE FROM employee WHERE d_id=$did;";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script type='text/javascript'>
    alert('Delivery Boy Deleted');
     window.location='./ownerdash.php';
       </script>";
  }

}
if (isset($_POST['registerd'])) {
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $phone=$_POST['logmob'];

  $query = "INSERT INTO `employee`(`f_name`, `l_name`, `phone`, `email`, `address`) VALUES ('$fname','$lname',$phone,'$email','$address');";
  $result = mysqli_query($con, $query);

  $query1 = "SELECT d_id FROM employee WHERE phone=$phone";
  $result1 = mysqli_query($con, $query1);
  $row1 = mysqli_fetch_assoc($result1);
  $empid = $row1['d_id'];
    $password=$fname.$empid;
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE `employee` SET e_password='$hashed_pwd' WHERE d_id=$empid;";
    $result = mysqli_query($con, $query);
    echo "<script type='text/javascript'>
    alert('Delivery Boy Registered');
     window.location='./ownerdash.php';
       </script>";
  // echo "";

}

 ?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sign up</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
<link rel="icon" href="../images/circle.png">
</head>

<body>
  <?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ownerheader.php';
   ?>
  <br><br>
  <div style="margin:auto;width:70%;">
  <p class="languages"><a href="?lang=english">English</a> | <a href="?lang=marathi">मराठी</a> | <a href="?lang=hindi">हिन्दी</a></p>
</div><br><br>
<div class="card regcard">
  <h3 class="cardhead"><?php echo lang('sign_up') ;?></h3>
  <form action="" method="post">
  <br>
  <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="fname" id="firstname" placeholder=<?php echo lang('fname') ;?> required>
             <span id="fnamemsg"></span>
         </div>
      </div>
      <div class="col-sm-6">
         <div class="form-group">
             <input type="text" class="form-control" name="lname" id="lastname" placeholder=<?php echo lang('lname') ;?> required>
             <span id="lnamemsg"></span>
         </div>
      </div>
  </div>
   <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
             <input type="email" class="form-control" name="email" id="email" placeholder=<?php echo lang('email') ;?> required>
              <span id="emmsg"></span>
         </div>
      </div>
       <div class="col-sm-6">
         <div class="form-group">

    <input type="number" class="form-control" name="logmob" id="lognum" placeholder=<?php echo lang('mobile'); ?>>
    <span id="mobmsg">
  </div>
   </div>
  </div>
  <div class="form-group">
    <textarea class="form-control" name="address" placeholder="Address" id="add" rows="2" columns="10" required></textarea>
    <span id="addmsg"></span>
  </div>


  <button class="btn btngreen" type="submit"name="registerd" id="btn"><?php echo lang('REGISTER')?></button>
  </form>
</div><br><br>
<div class="card ownercard">
<h3 style="text-align:center;">Delivery Boys</h3><br>
<table class="table table-hover" style="padding:20px;">
<thead>
<tr>
  <th scope="col">Id</th>
  <th scope="col">Name</th>
  <th scope="col">Delete</th>
</tr>
</thead>
<tbody>
  <?php
  $query = "SELECT * FROM employee;";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0)
  {
      while ($row1 = mysqli_fetch_assoc($result)) {
          echo '
          <tr>
            <td scope="col">'.$row1['d_id'].'</td>
            <td scope="col">'.$row1['f_name'].' '.$row1['l_name'].'</td>
            <th scope="col">
            <form action="" method="post">
              <input type="hidden" name="did" value="'.$row1['d_id'].'">
              <input type="submit"class="btn btnwhite" name="delete" value="Delete">
            </form>
            </th>
          </tr>';
      }
    }

   ?>
</tbody>
</table>
</div>

<br><br>

<?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

<script type="text/javascript">

  $(document).ready(function(){

    $("#btn").prop('disabled', true);

    $("#pass").keyup(function(){

      if(validatePassword()){

        $("#pass").css("border","2px solid #009975");

        $("#passMsg").html("<p class='text-success'>Password validated</p>");
      }else{

        $("#pass").css("border","2px solid red");

        $("#passMsg").html("<p class='text-danger'>Minimum 8 characters<br>One Number <br> One Uppercase letter<br> One Lowercase letter mandatory</p>");
      }
      buttonState();
    });
      $("#pass1").keyup(function(){
      // check
      if(validatePassword1()){

        $("#pass1").css("border","2px solid #009975");

        $("#pass1Msg").html("<p class='text-success'>Password matched</p>");
      }else{

        $("#pass1").css("border","2px solid red");

        $("#pass1Msg").html("<p class='text-danger'>Password not matched</p>");
      }
      buttonState();
    });
      $("#firstname").keyup(function(){
      // check
      if(valFirstname()){

        $("#fname").css("border","2px solid #009975");

        $("#fnamemsg").html("<p class='text-success'>Good to Go</p>");
      }else{

        $("#fname").css("border","2px solid red");

        $("#fnamemsg").html("<p class='text-danger'>Name required</p>");
      }
      buttonState();
    });
       $("#lastname").keyup(function(){
      // check
      if(valLastname()){

        $("#lname").css("border","2px solid #009975");

        $("#lnamemsg").html("<p class='text-success'>Good to Go</p>");
      }else{

        $("#lname").css("border","2px solid red");

        $("#lnamemsg").html("<p class='text-danger'>Name required</p>");
      }
      buttonState();
    });
       $("#lognum").keyup(function(){
  // check
     if(valMobile()){

       $("#lognum").css("border","2px solid #009975");

       $("#mobmsg").html("<p class='text-success'>Validated</p>");
      }else{

       $("#lognum").css("border","2px solid red");

        $("#mobmsg").html("<p class='text-danger'>Must be 10 digits</p>");
       }
       buttonState();
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
           $("#add").keyup(function(){
      // check
      if(valAddress()){

        $("#add").css("border","2px solid #009975");

        $("#addmsg").html("<p class='text-success'>Address validated</p>");
      }else{

        $("#add").css("border","2px solid red");

        $("#addmsg").html("<p class='text-danger'>Enter Address</p>");
      }
      buttonState();
    });
  });

  function buttonState(){
    if(valFirstname() && valLastname() &&  valEmail() && valAddress() && valMobile()){

      $("#btn").prop('disabled', false);
    }else{

      $("#btn").prop('disabled', true);
    }
  }

  function validatePassword(){

    var pass=$("#pass").val();
    var upper_text= new RegExp('[A-Z]');
    var lower_text= new RegExp('[a-z]');
    var number_check=new RegExp('[0-9]');


    if(pass.length > 7 && pass.match(upper_text) && pass.match(lower_text) && pass.match(number_check)){
      return true;
    }else{
      return false;
    }

  }
  function validatePassword1(){

    var pass=$("#pass").val();
    var conpass=$("#pass1").val();

    if(conpass == pass){
      return true;
    }else{
      return false;
    }

  }
  function valFirstname(){

    var fname=$("#firstname").val();
    var number_check=new RegExp('[0-9]');
    var lower_text= new RegExp('[a-z]');
    var upper_text= new RegExp('[A-Z]');

    if(fname.match(lower_text) || fname.match(upper_text)){
      return true;
    }else{
      return false;
    }

  }
   function valLastname(){

    var lname=$("#lastname").val();
    var number_check=new RegExp('[0-9]');
    var lower_text= new RegExp('[a-z]');
    var upper_text= new RegExp('[A-Z]');

    if(lname.match(lower_text) || lname.match(upper_text)){
      return true;
    }else{
      return false;
    }
}

  function valMobile(){
    var number_check=new RegExp('[0-9]');
    var mob=$("#lognum").val();
    if(mob.match(number_check) && mob.length==10){
      return true;
    }  else{
      return false;
    }
  }

   function valPincode(){
    var number_check=new RegExp('[0-9]');
    var pin=$("#pin").val();
    if(pin.match(number_check)){
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
   function valAddress(){
    var number_check=new RegExp('[0-9]');
    var add=$("#add").val();
    var lower_text= new RegExp('[a-z]');
    var upper_text= new RegExp('[A-Z]');
    if(add.match(number_check) || add.match(lower_text) || add.match(upper_text)){
      return true;
    }  else{
      return false;
    }
  }

</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
