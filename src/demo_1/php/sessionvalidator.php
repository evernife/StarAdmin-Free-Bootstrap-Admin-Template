<!DOCTYPE html>
<?php
session_start();
if( !isset($_SESSION['username']) ){
    session_destroy();
    header('Location:../../login.html');
    exit();
}
if ($_SESSION['username'] == 'EverNife'){
    $_SESSION['ADMIN'] = true;
}
?>



