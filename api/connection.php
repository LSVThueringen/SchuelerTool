<?php
include_once 'api/config.php';
$db = mysql_connect($database_host, $database_user, $database_pass) or die ("Fehler im System");
mysql_select_db($database_name, $db) or die ("Verbindung zur Datenbank war nicht m�glich...");

?>