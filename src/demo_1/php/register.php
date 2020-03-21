<!DOCTYPE html>
<?php

function redirectTo($new_page){
    header('Location: '.$new_page);
}

function validateOrError($post_var){
    if (!isset($_POST[$post_var])){
        redirectTo("../register.html?fail=true");
    }
    return $_POST[$post_var];
}

$email = validateOrError("email");
$username = validateOrError("username");
$password = validateOrError("password");
$fullname = validateOrError("fullname");

// ----------------------------------------------------------
function onUserRegister($email, $username, $password, $fullname){
    $new_account = array(
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'fullname' => $fullname
    );
    //$passwords_file = file_get_contents('/var/www/tccdocs/accounts.json');
    $passwords_file = file_get_contents('accounts.json');
    $tempArray = json_decode($passwords_file);
    if ($tempArray == null){
        $tempArray = $new_account;
    }else{
        if (!is_array($tempArray)){
            $tempArray = array($tempArray);
        }
        array_push($tempArray, $new_account);
    }

    $jsonData = json_encode($tempArray);
    //file_put_contents('/var/www/tccdocs/accounts.json', $jsonData);
    file_put_contents('accounts.json', $jsonData);
    header('Location: ../login.html?username='.$username);
    exit();
}
onUserRegister($username,$username, $password, $fullname);
?>