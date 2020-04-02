class UserData {
    constructor() {
        this.username = getCookieOrDefault('username','Erro');
        this.email = getCookieOrDefault('email','Erro');
        this.fullname = getCookieOrDefault('fullname','Erro');
        this.image = ''
    }
}

function getCookieOrDefault(cname, def) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return def;
}
function getCookie(cname) {
    return getCookieOrDefault(cname,def)
}

function getUserData() {
    return getCookieOrDefault(cname,def)
}

function getQueryValue(key) {
    value = (window.location.search.match(new RegExp('[?&]' + key + '=([^&]+)')) || [, null])[1];
    return value != null ? decodeURIComponent(value) : null;
}