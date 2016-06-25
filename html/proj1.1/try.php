<?php
$content = "abcdefgh" ;
$myfile=fopen($_SERVER['DOCUMENT_ROOT'] . "/var/www/html/newfile.txt","w");
fwrite($myfile,$content);
echo "write";
fclose($fp);

?>
