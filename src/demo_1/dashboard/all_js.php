<?php
echo "<script>\n" . file_get_contents('dashboard/js/top_nav.js') . "</script>\n";
echo "<script>\n" . file_get_contents('dashboard/js/sidebar.js') . "</script>\n";

$page = $_SESSION["page"];

function getAllAccountsAsJsonAndWithoutPasswords(){
    $accounts_file = file_get_contents('php/accounts.json');
    $tempArray = json_decode($accounts_file);
    if ($tempArray == null) return false;
    if (!is_array($tempArray)){
        $tempArray = array($tempArray);
    }
    foreach ($tempArray as $account) {
        $account->password = null;
    }
    return json_encode($tempArray);
}

function getJsonEncodedFileFrom($file_path){
    return file_get_contents($file_path);
}

switch ($page){
    case "accounts":
        echo "<script>\n";
        echo 'var allAccounts = '.getAllAccountsAsJsonAndWithoutPasswords()."\n";
        echo file_get_contents('dashboard/js/main/accounts.js');
        echo "</script>\n";
        break;
    case "hardcoded":
        echo "<script>\n";
        echo 'var data_input = '.getJsonEncodedFileFrom('data/hardcoded/data_input.json')."\n";
        echo 'var data_predict = '.getJsonEncodedFileFrom('data/hardcoded/data_predict.json')."\n";
        echo file_get_contents('dashboard/js/main/hardcoded.js');
        echo "</script>\n";
        break;
    case "arima_history":
        if (isset($_SESSION["file"])){
            $file = 'data/'.$_SESSION["username"]."/".$_SESSION["file"];
            echo "<script>\n";
            echo 'var json_data = '.getJsonEncodedFileFrom($file)."\n";
            echo file_get_contents('dashboard/js/main/arima_history_view.js');
            echo "</script>\n";
        }
        break;
}
?>
