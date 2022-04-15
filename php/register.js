var x = document.getElementById("demo");
const btn = document.querySelector("#btn");
const form = document.querySelector("#form");
errortxt = document.querySelector('.error-text');


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    document.getElementById("getloc").innerHTML = "";
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
    document.getElementById("getloc").innerHTML = "";
  }
}
function showPosition(position) {
  x.innerHTML =
    "Latitude: " +
    position.coords.latitude +
    "<br>Longitude: " +
    position.coords.longitude;
  document.getElementById("lat").value = position.coords.latitude;
  document.getElementById("long").value = position.coords.longitude;
  document.getElementById("getloc").innerHTML = "";
}
$(document).ready(function () {
  buttonState();
  $("#pass").keyup(function () {
    if (validatePassword()) {
      $("#pass").css("border", "2px solid #009975");
      $("#passMsg").html("<p class='text-success'>Password validated</p>");
    } else {
      $("#pass").css("border", "2px solid red");
      $("#passMsg").html(
        "<p class='text-danger'>Minimum 8 characters<br>One Number <br> One Uppercase letter<br> One Lowercase letter mandatory</p>"
      );
    }
    buttonState();
  });
  $("#pass1").keyup(function () {
    // check
    if (validatePassword1()) {
      $("#pass1").css("border", "2px solid #009975");
      $("#pass1Msg").html("<p class='text-success'>Password matched</p>");
    } else {
      $("#pass1").css("border", "2px solid red");
      $("#pass1Msg").html("<p class='text-danger'>Password not matched</p>");
    }
    buttonState();
  });
  $("#firstname").keyup(function () {
    // check
    if (valFirstname()) {
      $("#fname").css("border", "2px solid #009975");
      $("#fnamemsg").html("<p class='text-success'>Good to Go</p>");
    } else {
      $("#fname").css("border", "2px solid red");
      $("#fnamemsg").html("<p class='text-danger'>Name required</p>");
    }
    buttonState();
  });
  $("#lastname").keyup(function () {
    // check
    if (valLastname()) {
      $("#lname").css("border", "2px solid #009975");
      $("#lnamemsg").html("<p class='text-success'>Good to Go</p>");
    } else {
      $("#lname").css("border", "2px solid red");
      $("#lnamemsg").html("<p class='text-danger'>Name required</p>");
    }
    buttonState();
  });
  $("#mobile").keyup(function () {
    // check
    if (valMobile()) {
      $("#mobile").css("border", "2px solid #009975");
      $("#mobilemsg").html("<p class='text-success'>Validated</p>");
    } else {
      $("#mobile").css("border", "2px solid red");
      $("#mobilemsg").html("<p class='text-danger'>Must be 10 digits</p>");
    }
    buttonState();
  });
  $("#email").keyup(function () {
    // check
    if (valEmail()) {
      $("#email").css("border", "2px solid #009975");
      $("#emmsg").html("<p class='text-success'>Email Validated</p>");
    } else {
      $("#email").css("border", "2px solid red");
      $("#emmsg").html("<p class='text-danger'>Not in email format</p>");
    }
    buttonState();
  });
  $("#add").keyup(function () {
    // check
    if (valAddress()) {
      $("#add").css("border", "2px solid #009975");
      $("#addmsg").html("<p class='text-success'>Address validated</p>");
    } else {
      $("#add").css("border", "2px solid red");
      $("#addmsg").html("<p class='text-danger'>Enter Address Properly With Pincode</p>");
    }
    buttonState();
  });
  $("#pin").keyup(function () {
    // check
    if (valPincode()) {
      $("#pin").css("border", "2px solid #009975");
      $("#pinMsg").html("<p class='text-success'>Pincode validated</p>");
    } else {
      $("#pin").css("border", "2px solid red");
      $("#pinMsg").html("<p class='text-danger'>Enter Proper Pincode</p>");
    }
    buttonState();
  });
});
function buttonState() {
  if (
    validatePassword() &&
    validatePassword1() &&
    valFirstname() &&
    valLastname() &&
    valMobile() &&
    valEmail() &&
    valAddress() &&
    valPincode()
  ) {
    $("#btn").prop("disabled", false);
  } else {
    $("#btn").prop("disabled", true);
  }
}
function validatePassword() {
  var pass = $("#pass").val();
  var upper_text = new RegExp("[A-Z]");
  var lower_text = new RegExp("[a-z]");
  var number_check = new RegExp("[0-9]");

  if (
    pass.length > 7 &&
    pass.match(upper_text) &&
    pass.match(lower_text) &&
    pass.match(number_check)
  ) {
    return true;
  } else {
    return false;
  }
}
function validatePassword1() {
  var pass = $("#pass").val();
  var conpass = $("#pass1").val();

  if (conpass == pass) {
    return true;
  } else {
    return false;
  }
}
function valFirstname() {
  var fname = $("#firstname").val();
  var number_check = new RegExp("[0-9]");
  var lower_text = new RegExp("[a-z]");
  var upper_text = new RegExp("[A-Z]");

  if (fname.match(lower_text) || fname.match(upper_text)) {
    return true;
  } else {
    return false;
  }
}
function valLastname() {
  var lname = $("#lastname").val();
  var number_check = new RegExp("[0-9]");
  var lower_text = new RegExp("[a-z]");
  var upper_text = new RegExp("[A-Z]");

  if (lname.match(lower_text) || lname.match(upper_text)) {
    return true;
  } else {
    return false;
  }
}
function valMobile() {
  var number_check = new RegExp("[0-9]");
  var mob = $("#mobile").val();
  if (mob.match(number_check) && mob.length == 10) {
    return true;
  } else {
    return false;
  }
}
function valEmail() {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  var em = $("#email").val();
  if (em.match(regex)) {
    return true;
  } else {
    return false;
  }
}
function valAddress() {
  var add = $("#add").val().toLowerCase();
  var lower_text = new RegExp("[a-z]");
  if (add.match(lower_text)){
    return true;
  } else {
    console.log("hello");
    return false;
  }
}
function valPincode() {
  var number_check = new RegExp("[0-9]");
  var pin = $("#pin").val();
  if (pin.match(number_check) && pin.length == 6){
    return true;
  } else {
    return false;
  }
}
form.onsubmit = (e)=>{
    e.preventDefault();//preventing form from submitting
}
btn.onclick = ()=>{
    //Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "./registerbackend.php", true);
    xhr.onload = ()=>{
     if(xhr.readyState == XMLHttpRequest.DONE){
         if(xhr.status == 200){
             let data = xhr.response;
            if(data == "success"){
                alert('Customer Registered Successfully');
                window.location='./login.php';
            }else{
                errortxt.textContent = data;
                errortxt.style.display = "block";
            }
            }
        }
    }
    // Sending data from Ajax to php
    let formData = new FormData(form); //creating new formData
    xhr.send(formData); // sending form data to php
}
