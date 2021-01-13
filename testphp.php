<?php
$date = "9";
$date = "0" . $date;
$command = "pscp -P 22 -pw user paswword@192.168.168.57:/home/user/Downloads/files/202010" . $date . 
'/*Z* C:\xampp\htdocs\projectname\sourcefolder';
$output = exec($command,$output,$return);




$command='C:\Program Files\WinSCP\WinSCP.exe /ini=nul /script=C:\xampp\htdocs\seek\wintest.txt';
// exec('C:\Program Files\WinSCP\WinSCP.exe /ini=nul /script=C:\xampp\htdocs\seek\wintest.txt');
exec($command);









?>