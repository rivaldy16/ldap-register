var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Password tidak sama");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;


  function disableSubmit() {
    document.getElementById("submit").disabled = true;
   }

    function activateButton(element) {

        if(element.checked) {
          document.getElementById("submit").disabled = false;
          
         }
         else  {
          document.getElementById("submit").disabled = true;
        }

    }

  function myOnClickFn(){
    document.location.href="verfication/vervication.html";
  }