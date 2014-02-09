<?php
$ret = Array("klasse" => $_POST['klasse']);
if (!empty($_POST['klasse']) and !empty($_POST['time'])) {
		include_once 'api/connection.php';
		$sql = "SELECT time FROM klassen WHERE grade='" . $_POST['klasse'] . "';";
		if ($query_run = mysql_query($sql)) {
			while ($query_row = mysql_fetch_assoc($query_run)) {
				$zeit = $query_row['time'];
			}
		$ret['first'] = 'working';
		} else {$ret['first'] = 'not working';}
/*$ret = Array("klasse" => $_POST['klasse'], "zeit" => $_POST['time'], "zeit2" => $zeit);*/

if ($zeit > $_POST['time'] || $_POST['time']='1') {
		$ret['time'] = $zeit;

		$tage = array('mo', 'di', 'mi', 'do', 'fr');
		$stunden = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
		$sqlwennvorhanden = "SELECT ";
		for ($count1 = 0; $count1 <= 4; $count1++) {
			for ($count2 = 0; $count2 <= 10; $count2++) {
				$name = $tage[$count1] . $stunden[$count2];
				$sqlwennvorhanden .= $name . ', ';
				$name2 = $name . 'r';
				$sqlwennvorhanden .= $name2 . ', ';
				$name3 = $name . 'z';
				$sqlwennvorhanden .= $name3 . ', ';
				$name4 = $name . 'zr';
				$sqlwennvorhanden .= $name4 . ', ';

			}
		}
		$sqlwennvorhanden = substr($sqlwennvorhanden, 0, -2);
		$sqlwennvorhanden .= " FROM klassen WHERE grade=\"" . $_POST['klasse'] . "\";";
		if ($query_run2 = mysql_query($sqlwennvorhanden)) {
			while ($query_row2 = mysql_fetch_assoc($query_run2)) {
				for ($count1 = 0; $count1 <= 4; $count1++) {
					for ($count2 = 0; $count2 <= 10; $count2++) {
						$name = $tage[$count1] . $stunden[$count2];
						$$name = $query_row2[$name];
						$ret[$name] = $$name;
						$name2 = $name . 'r';
						$$name2 = $query_row2[$name2];
						$ret[$name2] = $$name2;
						$name3 = $name . 'z';
						$$name3 = $query_row2[$name3];
						$ret[$name3] = $$name3;
						$name4 = $name . 'zr';
						$$name4 = $query_row2[$name4];
						$ret[$name4] = $$name4;

					}
				}
			}
		} else {echo "Fehler" . $sqlwennvorhanden;
		$ret['Fehler']="true";
		}

	} 
}
echo json_encode($ret);
?>