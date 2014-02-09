<?php
include 'api/connection.php';
if (($handle = fopen("vplan.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
		$anfang = substr($data[0],0,1);
		if(($anfang=='0' || $anfang=='1' || $anfang=='A') && $anfang != ""){
			unset($klasse2);
			$klasse=$data[0];
			if(strlen($klasse) > 3){
				$klasse2 = substr($klasse,-3,3);
				$klasse = substr($klasse,0,-3);
				if(strlen($klasse) > 5){
					$klasse3 = substr($klasse,-3,3);
					$klasse = substr($klasse,0,3);
				} else {$klasse = substr($klasse,0,-2);}
			}
			$stunde1=$data[1];
			$lehrer1=$data[2];
			$fach1=$data[3];
			if(substr($fach1,0,1)=="["){
				$fach1=substr($fach1,0,-1);
				$fach1=substr($fach1,1);
			}
			$raum1=$data[4];
			if(substr($raum1,0,1)=="["){
				$raum1=substr($raum1,0,-1);
				$raum1=substr($raum1,1);
			}
			$lehrer2=$data[7];
			$fach2=$data[8];
			$raum2=$data[9];
			$infos=$data[10].' '.$data[11].' '.$data[12];
			$sql='INSERT INTO vplan (grade, stunde1, lehrer1, fach1, raum1, lehrer2, fach2, raum2, infos) ';
			$sql .= 'VALUES ("'.$klasse.'", "'.$stunde1.'", "'.$lehrer1.'", "'.$fach1.'", "'.$raum1.'", "'.$lehrer2.'", "'.$fach2.'", "'.$raum2.'", "'.$infos.'");';
			if ($query_run = mysql_query($sql)) {
				echo $anfang."successfull";}
			else {echo "fail";}
			if($klasse2){
				$sql='INSERT INTO vplan (grade, stunde1, lehrer1, fach1, raum1, lehrer2, fach2, raum2, infos) ';
				$sql .= 'VALUES ("'.$klasse2.'", "'.$stunde1.'", "'.$lehrer1.'", "'.$fach1.'", "'.$raum1.'", "'.$lehrer2.'", "'.$fach2.'", "'.$raum2.'", "'.$infos.'");';
				if ($query_run = mysql_query($sql)) {
					echo $anfang."successfull";}
				else {echo "fail";}
				if($klasse3){
					$sql='INSERT INTO vplan (grade, stunde1, lehrer1, fach1, raum1, lehrer2, fach2, raum2, infos) ';
					$sql .= 'VALUES ("'.$klasse3.'", "'.$stunde1.'", "'.$lehrer1.'", "'.$fach1.'", "'.$raum1.'", "'.$lehrer2.'", "'.$fach2.'", "'.$raum2.'", "'.$infos.'");';
					if ($query_run = mysql_query($sql)) {
						echo $anfang."successfull";}
					else {echo "fail";}
				}
			}
			
		}
    }
    fclose($handle);
}
?>