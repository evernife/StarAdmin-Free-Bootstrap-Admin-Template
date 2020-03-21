<!DOCTYPE html>
<?php
function redirectTo($new_page){
    header('Location: ' + $new_page);
}
function goodBye($message) {
    header('Location: error_page.php?msg='.$message);
    exit();
}
?>