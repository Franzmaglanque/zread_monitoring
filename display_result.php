<?php
require 'includes/seeker.php';
require 'includes/spreadsheetwriter.php';


if(isset($_POST['dateFrom'])){
    $timestamp = $seek->get_timestamp($_POST['dateFrom']);
    // $seek->getReading($timestamp['selected_date'],$timestamp['selected_month']); 
    for($i=1;$i<=12;$i++){
    // for($i=1;$i<=10;$i++){
        $trimmed = $seek->get_lowest_fileName($i);
        $CPG = $seek->getsales($i,'Current Positive GT');
        $CNG = $seek->getsales($i,'Current Negative GT');
        $PPG = $seek->getsales($i,'Previous Positive GT');
        $PNG = $seek->getsales($i,'Previous Negative GT');
        $CPG['sales'] = trim($CPG['sales']);
        $CNG['sales'] = trim($CNG['sales']);
        $PPG['sales'] = trim($PPG['sales']);
        $PNG['sales'] = trim($PNG['sales']);
        echo "Lane " . $i;
        echo "<br>";
        echo $trimmed[$CPG['filename']];
        echo "<br>";
        echo 'Current Positive GT = ' . $CPG['sales'];
        echo "<br>";
        echo 'Current Negative GT = ' . $CNG['sales'];
        echo "<br>";
        echo 'Previous Positive GT = ' . $PPG['sales'];
        echo "<br>";
        echo 'Previous Negative GT = ' . $PNG['sales'];
        echo "<hr>";
        $spreadwriter->populate($CPG['sales'],$CNG['sales'],$PPG['sales'],$PNG['sales'],$i,$timestamp['selected_date']);
    }
$seek->removeFiles();
}
?>