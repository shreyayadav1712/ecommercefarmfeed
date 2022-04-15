<?php
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
session_start();
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
     <p class="languages"><a href="?lang=english">English</a> | <a href="?lang=marathi">मराठी</a> | <a href="?lang=hindi">हिन्दी</a></p>
     <br/><br/>
     <div class="card logcard">
     <div id="forget_pass">
  <h3 class="cardhead"><?php echo lang('forgot_pass')?></h3>

<form id="add_name1" method="post">
<div class="form-group">
<input type="text" class="form-control" id="phoneid" name="phone" value="+91" placeholder="" required>
  <span id="nummsg"></span>
         </div>
  <br/>
    <div id="recaptcha-container" class="g-recaptcha"></div><br>
    <input type="button" id='btn1' class="btn btngreen" name="verify" onclick="phoneAuth();" value=<?php echo lang('send')?>>
</form><br/>
</div>
<div id="verify_div" style="display:none">
<h3  class="cardhead"><?php echo lang('verify_code')?></h3>
<br/>
<form id="add_name" method="POST" >
  <div class="form-group">
    <label for lognum><b><?php echo lang('new_pass')?></b> </label>
    <input type="password" name="pass" class="form-control" id="pass" placeholder=<?php echo lang('new_pass'); ?>>
    <span id="passmsg">
  </div>
  <div class="form-group">
    <label for logpassword><b><?php echo lang('re_enter_new_pass')?></b> </label>
    <input type="password"class="form-control" name="repass" id="repass" placeholder=<?php echo lang('re_enter_new_pass')?>>
     <span id="pass1msg">
  </div>
  <input type="hidden" name="phone" value=<?php echo "$phone"; ?>>
  <input type="hidden" name="cid" value=<?php echo "$cid"; ?>>
  <label><b><?php echo lang('verify_code')?></b> </label>
  <input type="text" id="verificationCode" class="form-control" placeholder=<?php echo lang('verify_code')?>>
  <span id="vermsg"></span><br>
  <button type="button" id='btn2' class="btn btngreen" onclick="codeverify();"><?php echo lang('verify_button')?></button>

</form>
</div>

</div>


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


$("#btn").prop('disabled', true);

$("#pass").keyup(function(){

  if(validatePassword()){

    $("#pass").css("border","2px solid #009975");

    $("#passmsg").html("<p class='text-success'>Password validated</p>");
  }else{

    $("#pass").css("border","2px solid red");

    $("#passmsg").html("<p class='text-danger'>Minimum 8 characters<br>One Number <br> One Uppercase letter<br> One Lowercase letter mandatory</p>");
  }
  buttonState();
});
  $("#repass").keyup(function(){
  // check
  if(validatePassword1()){

    $("#repass").css("border","2px solid #009975");

    $("#pass1msg").html("<p class='text-success'>Password matched</p>");
  }else{

    $("#repass").css("border","2px solid red");

    $("#pass1msg").html("<p class='text-danger'>Password not matched</p>");
  }
  buttonState();
});




   function buttonState(){
if(validatePassword() && validatePassword1()){

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
var conpass=$("#repass").val();

if(conpass == pass){
  return true;
}else{
  return false;
}

}
  // var coderesult;

function valPhone(){

  var number_check=new RegExp('[0-9]{12}');
  var pin=$("#phoneid").val();
  if(pin.match(number_check)){
    return true;
  }  else{
    return false;
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

//   $("#add_name1").submit(function(e) {
//     e.preventDefault();
// });

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
function phoneAuth() {


   if (grecaptcha.getResponse() == ""){
    alert("Don't Forget the reCAPTCHA.");
      }

    var number=document.getElementById('phoneid').value;
    var myform = document.getElementById("add_name1");
      var fd = new FormData(myform);
      fd.append("number",number);
      // console.log(number);

  console.log(number);
    $.ajax({
         url: '../php/accexists.php',
         type: 'POST',
         dataType: 'text',
         processData: false,
         contentType: false,
         data:fd
      })
      .done(function(res) {

         console.log("success");
         console.log(res);


         if(res == 'true'){


          document.getElementById('verify_div').style.display = 'inline';
          document.getElementById('forget_pass').style.display = 'none';


            firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {

        window.confirmationResult=confirmationResult;
        coderesult=confirmationResult;
        console.log(coderesult);
        // alert("Message sent");
    }).catch(function (error) {
       alert(error.message);
    });
            // coderesult=999;
        alert("Code Sent on your Registered Mobile Phone.");


         }
         else{
          alert("No Account found with this phone number.");
         }

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

    // firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {

    //     window.confirmationResult=confirmationResult;
    //     coderesult=confirmationResult;
    //     console.log(coderesult);
    //     alert("Message sent");
    // }).catch(function (error) {
    //    alert(error.message);
    // });


}
function codeverify() {
    var code=document.getElementById('verificationCode').value;
    var number=document.getElementById('phoneid').value;


    // if(coderesult=code){
    //   var myform = document.getElementById("add_name");
    //   var fd = new FormData(myform);
    //   fd.append("number",number);
    //   console.log(number);


    //  $.ajax({
    //      url: '../php/resetpass.php',
    //      type: 'POST',
    //      dataType: 'text',
    //      processData: false,
    //      contentType: false,
    //      data: fd
    //   })
    //   .done(function(res) {

    //      console.log("success");
    //      console.log(res);
    //       alert(res);
    //   })
    //   .fail(function() {
    //    var element = document.getElementById("hello");
    //    element.classList.add("noload");
    //    alert("Network Issue. Please Try Again.");
    //    console.log("error");
    //   })
    //   .always(function() {
    //      console.log("complete");
    //   });//ajaxend


    //   // console.log("Result",result);
    //   // var user=result.user;
    //   // console.log("User",user);




    // }
    coderesult.confirm(code).then(function (result) {

      var myform = document.getElementById("add_name");
      var fd = new FormData(myform);
      fd.append("number",number);
      console.log(number);


     $.ajax({
         url: '../php/resetpass.php',
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
          window.location='./login.php';
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


      // console.log("Result",result);
      // var user=result.user;
      // console.log("User",user);


    }).catch(function (error) {
        alert(error.message);
    });

}


</script>
       <?php include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';   ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>
</html>
