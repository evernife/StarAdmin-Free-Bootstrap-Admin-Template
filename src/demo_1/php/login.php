<!DOCTYPE html>
<?php
session_start();
function validateOrError($post_var){
    if (!isset($_POST[$post_var])){
        header("Location: ../errors/error-500.html");
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
            $_SESSION['username'] = $account->username;
            $_SESSION['password'] = $account->password;
            $_SESSION['email'] = $account->email;
            $_SESSION['fullname'] = $account->fullname;
            return true;
        }
    }
    return false;
}

if (onUserLogin($username, $password) == true){
    header('Location: ../dashboard.php');
}else{
    header('Location: ../login.html?error=Generic');
}
?>



