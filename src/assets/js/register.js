
//Declaração
var email           = document.getElementById('email');
var fullname        = document.getElementById('fullname');
var username        = document.getElementById('username');
var password        = document.getElementById('password');
var confirmpassword = document.getElementById('confirmpassword');

var email_checkmark = document.getElementById('email_checkmark');
var fullname_checkmark = document.getElementById('fullname_checkmark');
var username_checkmark = document.getElementById('username_checkmark');
var password_checkmark = document.getElementById('password_checkmark');
var confirmpassword_checkmark = document.getElementById('confirmpassword_checkmark');

var submit_button   = document.getElementById('submit_button');



//Funções
function validateEmail(){
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
        email_checkmark.style = "color:blue";
        return true;
    }else {
        email_checkmark.style = "color:red";
        return false;
    }
}

function validateName(){
    if (/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/.test(fullname.value)){
        fullname_checkmark.style = "color:blue";
        return true;
    }else {
        fullname_checkmark.style = "color:red";
        return false;
    }
}

function validateUsername(){
    if (/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,20}$/.test(username.value)){
        username_checkmark.style = "color:blue";
        return true;
    }else {
        username_checkmark.style = "color:red";
        return false;
    }
}

function validatePassword(){
    if (password.value.length >= 3){
        password_checkmark.style = "color:blue";
        return true;
    }
    password_checkmark.style = "color:red";
    return false;
}

function validateConfirmPassword(){
    if (password.value != confirmpassword.value){
        confirmpassword_checkmark.style = "color:blue";
        return false;
    }
    confirmpassword_checkmark.style = "color:red";
    return true;
}

function addMultipleEventListeners(listener, strings, customFunction){
    strings.forEach(function (name, index) {
        listener.addEventListener(name, function(event){customFunction(event);});
    });
}

//Listeners

addMultipleEventListeners(email, ["keypress","focusin","focusout"], validateEmail);
addMultipleEventListeners(fullname, ["keypress","focusin","focusout"], validateName);
addMultipleEventListeners(username, ["keypress","focusin","focusout"], validateUsername);
addMultipleEventListeners(password, ["keypress","focusin","focusout"], validatePassword);
addMultipleEventListeners(confirmpassword, ["keypress","focusin","focusout"], validateConfirmPassword);

submit_button.addEventListener("click", function (event) {
    function preventActionAndWarn(e,message) {
        e.preventDefault();
        alert(message)
    }

    if (!validateEmail()){
        event.preventDefault();
        alert("O email inserido não é valido!")
        return;
    }

    if (!validateEmail()) preventActionAndWarn(event,"Email Inválido!");
    if (!validateName()) preventActionAndWarn(event,"Nome Pessoal Inválido!");
    if (!validateUsername()) preventActionAndWarn(event,"NickName Inválido!");
    if (!validatePassword()) preventActionAndWarn(event,"Senha inválida!");
    if (!validateConfirmPassword()) preventActionAndWarn(event,"A confirmação da senha precisa ser igual a senha!");
})

function getQueryValue(key) {
    value = (window.location.search.match(new RegExp('[?&]' + key + '=([^&]+)')) || [, null])[1];
    return value != null ? decodeURIComponent(value) : null;
}

errorMessage = getQueryValue("error");
if (errorMessage != null){
    alert(errorMessage);
}



