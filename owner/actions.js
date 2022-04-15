errortxt = document.querySelector(".del-error-text");
error = errortxt.textContent;
console.log(errortxt);

if(error != ''){
  errortxt.style.display = "block";
}
