<?php
function getFilesIn($path) {
    return array_diff(scandir($path), array('..', '.'));
}

function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}


function getExportCretionDate($file_name){
    $split = explode("_",$file_name);
    return $split[2] / 1000;
}

?>