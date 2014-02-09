<?php
include 'api/connection.php';
    $tage = array('mo', 'di', 'mi', 'do', 'fr');
		$stunden = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
		$sqlwennvorhanden = "UPDATE klassen SET ";
		for ($count1 = 0; $count1 <= 4; $count1++) {
			for ($count2 = 0; $count2 <= 10; $count2++) {
				$name = $tage[$count1] . $stunden[$count2];
				$sqlwennvorhanden .= $name . '=\''.$_POST[$name].'\', ';
				$name2 = $name . 'r';
				$sqlwennvorhanden .= $name2 . '=\''.$_POST[$name2].'\', ';
				$name3 = $name . 'z';
				$sqlwennvorhanden .= $name3 . '=\''.$_POST[$name3].'\', ';
				$name4 = $name . 'zr';
				$sqlwennvorhanden .= $name4 . '=\''.$_POST[$name4].'\', ';

			}
		}
		$sqlwennvorhanden .= 'time=\''.time().'\', username=\''.$_POST['username'].'\', ';
		$sqlwennvorhanden = substr($sqlwennvorhanden, 0, -2);
		$sqlwennvorhanden .= " WHERE grade=\"" . $_POST['klasse'] . "\";";
		if ($query_run = mysql_query($sqlwennvorhanden)) {
			$ret['Speichern']="Successfull";
			$ret['answercontent']='<p>Die Daten wurden erfolgreich geändert!<p><a href="#frontpage" class="navlink">Zur Startseite</a>';
		} else {
			$ret['answercontent']='<p>Es gab ein Verbindungsproblem!<p><a href="#newtimetable" class="navlink">Nochmal</a>';
		}

	echo json_encode($ret);
?>