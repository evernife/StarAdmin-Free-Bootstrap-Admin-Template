//Declaração
var email           = document.getElementById('email');
var email_checkmark = document.getElementById('email_checkmark');

var fullname        = document.getElementById('fullname');
var username        = document.getElementById('username');
var password        = document.getElementById('password');
var confirmpassword = document.getElementById('confirmpassword');
var submit_button   = document.getElementById('submit_button');

//Funções
function validateEmail(){
    console.log("validateEmail")
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
        email_checkmark.style = "color:blue";
        return true;
    }else {
        email_checkmark.style = "color:red";
        return false;
    }
}

function validateName(){
    console.log("validateEmail")
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
        email_checkmark.style = "color:blue";
        return true;
    }else {
        email_checkmark.style = "color:red";
        return false;
    }
}

//Listeners

email.addEventListener("keypress", function(event) {validateEmail(event);});
email.addEventListener("focusin", function(event) {validateEmail(event);});
email.addEventListener("focusout", function(event) {validateEmail(event);});



submit_button.addEventListener("click", function (event) {
    if (!validateEmail()){
        event.preventDefault();
        alert("O email inserido não é valido!")
        return;
    }
    console.log('do another something');
})



