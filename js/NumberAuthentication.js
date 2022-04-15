window.onload=function () {
  render();
};
function render() {
    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}
function phoneAuth() {

    var number=document.getElementById('number').value;
    // var str1 = document.getElementById('number').value;
    // var str2 = "+91";
    // var number = str1.concat(str2);

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
    coderesult.confirm(code).then(function (result) {


      var myform = document.getElementById("add_name");
      var fd = new FormData(myform );
      console.log(fd);


     $.ajax({
         url: '../php/data.php',
         type: 'POST',
         dataType: 'text',
         processData: false,
         contentType: false,
         data: fd
      })
      .done(function(res) {
       // var element = document.getElementById("hello");
       // element.classList.add("noload");
         console.log("success");
         console.log(res);

       // document.getElementById("add_name").reset();
       // alert("Submitted Saved Successfully");
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



        alert("AJAX Not Executed");

        var user=result.user;
        console.log("User",user);
    }).catch(function (error) {
        alert(error.message);
    });
}
