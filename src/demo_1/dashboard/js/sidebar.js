var username        = document.getElementById('sidebar-username');
var role            = document.getElementById('sidebar-role');

username.innerHTML  = userData.username;
role.innerHTML      = userData.username == "EverNife" ? "Admin" : "User";
