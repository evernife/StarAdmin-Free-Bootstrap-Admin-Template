<?php
$page = $_SESSION["page"];
switch ($page){
    case "new_arima":
        echo file_get_contents('dashboard/html/main/new_arima.html');
        break;
    case "accounts":
        echo file_get_contents('dashboard/html/main/accounts.html');
        break;
    case "hardcoded":
        echo file_get_contents('dashboard/html/main/hardcoded.html');
        break;
    default:
        echo "<div class=\"content-wrapper\"> </div>";
}
?>