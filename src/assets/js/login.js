function getQueryValue(key) {
    value = (window.location.search.match(new RegExp('[?&]' + key + '=([^&]+)')) || [, null])[1];
    return value != null ? decodeURIComponent(value) : null;
}

errorMessage = getQueryValue("error");
if (errorMessage != null){
    if (errorMessage == "Generic"){
        alert("Usuário ou Senha Incorretos!")
    }
}



