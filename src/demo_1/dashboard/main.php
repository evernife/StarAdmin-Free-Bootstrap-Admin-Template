<?php
$page = $_SESSION["page"];
switch ($page){
    case "new_arima":
        echo file_get_contents('dashboard/html/main/new_arima.html');
        break;
    case "arima_history":
        if (isset($_SESSION["file"])){
            include 'dashboard/php/main/arima_history_view.php';
        }else{
            include 'dashboard/php/main/arima_history.php';
        }
        break;
    case "accounts":
        if (isset($_SESSION['ADMIN'])){
            echo file_get_contents('dashboard/html/main/accounts.html');
        }
        break;
    case "hardcoded":
        echo file_get_contents('dashboard/html/main/hardcoded.html');
        echo '
<div class=\"content-wrapper\">
   <p>';
       # $command = escapeshellcmd('python C:\Treino9\Treino9\arima_interpreter_mysql.py localhost admin admin analytics EverNife');
      #  $output = shell_exec($command);
       # echo "\nCmd: ";
      #  echo $command;
     #   echo "<br>Output: ";
      #  echo $output;
        echo '</p>
    
</div>
        ';
        break;
    default:
        echo "<div class=\"content-wrapper\"> </div>";
}
?>