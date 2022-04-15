$(document).ready(function () {
  buttonState();

  $("#name").keyup(function () {
    // check
    if (valname()) {
      $("#name").css("border", "2px solid #009975");
      $("#namemsg").html("<p class='text-success'>Good to Go</p>");
    } else {
      $("#name").css("border", "2px solid red");
      $("#namemsg").html("<p class='text-danger'>Name required</p>");
    }
    buttonState();
  });

  $("#Hname").keyup(function () {
    // check
    if (valHname()) {
      $("#Hname").css("border", "2px solid #009975");
      $("#hnamemsg").html("<p class='text-success'>Good to Go</p>");
    } else {
      $("#Hname").css("border", "2px solid red");
      $("#hnamemsg").html("<p class='text-danger'>Name required</p>");
    }
    buttonState();
  });

  $("#Mname").keyup(function () {
    // check
    if (valMname()) {
      $("#Mname").css("border", "2px solid #009975");
      $("#mnamemsg").html("<p class='text-success'>Good to Go</p>");
    } else {
      $("#Mname").css("border", "2px solid red");
      $("#mnamemsg").html("<p class='text-danger'>Name required</p>");
    }
    buttonState();
  });

  function buttonState() {
    if (valname() && valHname() && valMname() && valimage()) {
      $("#btn").prop("disabled", false);
    } else {
      $("#btn").prop("disabled", true);
    }
  }

  function valname() {
    var name = $("#name").val();
    if (name.length > 1) {
      return true;
    } else {
      return false;
    }
  }

  function valHname() {
    var name = $("#Hname").val();
    if (name.length > 1) {
      return true;
    } else {
      return false;
    }
  }

  function valMname() {
    var name = $("#Mname").val();
    if (name.length > 1) {
      return true;
    } else {
      return false;
    }
  }

  function valimage() {
    var image = $("#image").val();
    if (image != null) {
      return true;
    } else {
      return false;
    }
  }
});

const form = document.querySelector("#additems");
btn = document.querySelector("#btn");
errortxt = document.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault(); //preventing form from submitting
};

btn.onclick = () => {
  //Ajax
  let xhr = new XMLHttpRequest(); //creating XML object
  xhr.open("POST", "./additemsbackend.php", true);
  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        if (data == "success") {
          alert("Item Added Successfully");
          window.location = "./additems.php";
        } else {
          errortxt.textContent = data;
          errortxt.style.display = "block";
        }
      }
    }
  };
  // Sending data from Ajax to php
  let formData = new FormData(form); //creating new formData
  xhr.send(formData); // sending form data to php
};
