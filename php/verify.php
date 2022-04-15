<?php
session_start();

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
  if (isset($_POST['register'])) {
    $password=mysqli_real_escape_string($con,$_POST['repassword']);
    $fname=mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pin=mysqli_real_escape_string($con,$_POST['pincode']);
    $address=mysqli_real_escape_string($con,$_POST['address']);
    $latitude=mysqli_real_escape_string($con,$_POST['lat']);
    $longitude=mysqli_real_escape_string($con,$_POST['long']);
    $lat1=$latitude;
    $lon1=$longitude;
    $lat2=$latitude;
    $lon2=$longitude;
    $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;

      $distance=$miles * 1.609344;
    if ($distance>=6){
      echo "<script type='text/javascript'>
      alert('Your Distance From Shop is ".ceil($distance)." Km.We cannot provied delivery.');
       window.location='./cart.php';
         </script>";

    }
  }

 ?>
<html>
<head>
    <title>Verify</title>
    <link rel="icon" href="../images/circle.png">
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/cards.css">
</head>
<body>
    <?php
      include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
     ?>
     <div class="card logcard">
  <h3 class="cardhead"><?php echo lang('enter_mob')?></h3>

<form>
<div class="form-group">
<input type="text" class="form-control" id="phoneid" name="phone" value="+91" placeholder="" required>
  <span id="nummsg"></span>
         </div>
  <br/>
    <div id="recaptcha-container" class="g-recaptcha"></div><br>
    <button type="button" id='btn1' class="btn btngreen" name="verify" onclick="phoneAuth();"><?php echo lang('send')?></button>
</form><br/>
<h3  class="cardhead"><?php echo lang('verify_code')?></h3>
<br/>
<form id="add_name" method="POST" >

    <input type="hidden" name="password" value="<?php echo "$password"; ?>">
    <input type="hidden" name="fname" value="<?php echo "$fname"; ?>">
    <input type="hidden" name="lname" value="<?php echo "$lname"; ?>">
    <input type="hidden" name="email" value="<?php echo "$email"; ?>">
    <input type="hidden" name="pincode" value="<?php echo "$pin"; ?>">
    <input type="hidden" name="address" value="<?php echo "$address"; ?>">
  <input type="hidden" name="phone" value=<?php echo "$phone"; ?>>
  <input type="hidden" name="latitude" value="<?php echo "$latitude"; ?>">
<input type="hidden" name="longitude" value=<?php echo "$longitude"; ?>>
    <input type="text" id="verificationCode" class="form-control" placeholder=<?php echo lang('verify_code')?> >
    <span id="vermsg"></span><br>
    <button type="button" id='btn2' class="btn btngreen" onclick="codeverify();"><?php echo lang('verify_button')?></button>

</form>




<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>


<script>
    var firebaseConfig = {
        apiKey: "AIzaSyBK-juZ6krPJCHHELQgOW9sFUXsS9h3wHI",
        authDomain: "fir-web-b823f.firebaseapp.com",
        databaseURL: "https://fir-web-b823f.firebaseio.com",
        projectId: "fir-web-b823f",
        storageBucket: "fir-web-b823f.appspot.com",
        messagingSenderId: "463332404757",
        appId: "1:463332404757:web:68d04d3fdeeb333f"
    };

    firebase.initializeApp(firebaseConfig);
</script>
<script>

window.onload=function () {
  render();

function valPhone(){

  var number_check=new RegExp('[0-9]{12}');
  var pin=$("#phoneid").val();
  if(pin.match(number_check)){
    return true;
  }  else{
    return true;
  }
}

function verMsg(){

  var number_check=new RegExp('^[0-9]*$');
  var pin=$("#verificationCode").val();
  if(pin.match(number_check)){
    return true;
  }  else{
    return false;
  }
}

$("#btn1").prop('disabled', true);
$("#btn2").prop('disabled', true);
$("#phoneid").keyup(function(){
    // check
    if(valPhone()){
      $("#phoneid").css("border","2px solid #009975");
      $("#nummsg").html("<p class='text-success'>Phone Number Validated</p>");
    }else{
      $("#phoneid").css("border","2px solid red");
      $("#nummsg").html("<p class='text-danger'>Enter Valid Phone Number</p>");
    }
    buttonState();
  });

  $("#verificationCode").keyup(function(){

  if(!verMsg()){
      $("#verificationCode").css("border","2px solid red");
      $("#vermsg").html("<p class='text-danger'>Enter Valid Code</p>");

    }
    else{
      $("#verificationCode").css("border","2px solid #009975");
      $("#vermsg").html("<p class='text-success'>Proceed Verification.</p>");
      $("#btn2").prop('disabled', false);
    }

  });



  function buttonState(){
    if(valPhone()){

      $("#btn1").prop('disabled', false);
    }else{

      $("#btn1").prop('disabled', true);
    }
  }
};
function render() {
    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}


// window.onbeforeunload = function() {
//         return "Changes you made may not be saved.";
//     }

function phoneAuth() {

   if (grecaptcha.getResponse() == ""){
    alert("Don't Forget the reCAPTCHA.");
      }

    var number=document.getElementById('phoneid').value;
    // var str1 = document.getElementById('number').value;
    // var str2 = "+91";
    // var number = str1.concat(str2);

        // coderesult='12345';
        // console.log(number);

    firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {

        window.confirmationResult=confirmationResult;
        coderesult=confirmationResult;
        console.log(coderesult);
        alert("Message sent");
    }).catch(function (error) {
       alert(error.message);
    });
}
function codeverify() {
    var code=document.getElementById('verificationCode').value;
    var number=document.getElementById('phoneid').value;
    coderesult.confirm(code).then(function (result) {

      var myform = document.getElementById("add_name");
      var fd = new FormData(myform);
      fd.append("number",number);
      console.log(number);


     $.ajax({
         url: '../php/data.php',
         type: 'POST',
         dataType: 'text',
         processData: false,
         contentType: false,
         data: fd
      })
      .done(function(res) {

         console.log("success");
         console.log(res);
          alert(res);
      })
      .fail(function() {
       var element = document.getElementById("hello");
       element.classList.add("noload");
       alert("Network Issue. Please Try Again.");
       console.log("error");
      })
      .always(function() {


         console.log("complete");
      });//ajaxend


      console.log("Result",result);
      var user=result.user;
      console.log("User",user);


    }).catch(function (error) {
        alert(error.message);
    });

        // alert("AJAX Not Executed");


    // coderesult.confirm(code).then(function (result) {


    //   var myform = document.getElementById("add_name");
    //   var fd = new FormData(myform );
    //   console.log(fd);


    //  $.ajax({
    //      url: '../php/data.php',
    //      type: 'POST',
    //      dataType: 'text',
    //      processData: false,
    //      contentType: false,
    //      data: fd
    //   })
    //   .done(function(res) {
    //    // var element = document.getElementById("hello");
    //    // element.classList.add("noload");
    //      console.log("success");
    //      console.log(res);

    //    // document.getElementById("add_name").reset();
    //    // alert("Submitted Saved Successfully");
    //   })
    //   .fail(function() {
    //    var element = document.getElementById("hello");
    //    element.classList.add("noload");
    //    alert("Network Issue. Please Try Again.");
    //      console.log("error");
    //   })
    //   .always(function() {
    //      console.log("complete");
    //   });//ajaxend



    //     alert("AJAX Not Executed");

    //     var user=result.user;
    //     console.log("User",user);


    // }).catch(function (error) {
    //     alert(error.message);
    // });
}


</script>
</div>
       <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>
</html>
