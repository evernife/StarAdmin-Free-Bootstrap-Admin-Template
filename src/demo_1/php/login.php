<!DOCTYPE html>
<?php

function validateOrError($post_var){
    if (!isset($_POST[$post_var])){
        redirectTo("../login.html?fail=true");
    }
    return $_POST[$post_var];
}

$username = validateOrError("username");
$password = validateOrError("password");

// ----------------------------------------------------------
function onUserLogin($username, $password){
    //$passwords_file = file_get_contents('/var/www/tccdocs/accounts.json');
    $passwords_file = file_get_contents('accounts.json');
    $tempArray = json_decode($passwords_file);

    if ($tempArray == null) return false;
    if (!is_array($tempArray)){
        $tempArray = array($tempArray);
    }
    foreach ($tempArray as $account) {
        if ($account->username == $username && $account->password == $password){
            return true;
        }
    }
    return false;
}

if (onUserLogin($username,$password) == true){
    header('Location: ../blank-page.html');
}else{
    header('Location: ../register.html');
}
?>



