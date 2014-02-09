<?php
    include 'api/connection.php';
//wenn login	
if(isset($_GET['m']) && $_GET['m']=='login'){
    $user = $_POST['username'];
	$passwort = md5($_POST['password']);
    $ret = array('works' => "1" );
    $abfrage = "SELECT * FROM schueler WHERE username = '$user' AND password = '$passwort'";
		$ergebnis = mysql_query($abfrage);
		while ($row = mysql_fetch_assoc($ergebnis)) {
			$control++;
			$klasse=$row['grade'];
			$vorname=$row['firstname'];
			$nachname=$row['lastname'];
		}
	if($control != 0){
		$ret['login']="1";
		$ret['klasse']=$klasse;
		$ret['vorname']=$vorname;
		$ret['nachname']=$nachname;
		$ret['username']=$user;
	} else {
		$ret['login']="0";
		$ret['klasse']="";
		$ret['vorname']="";
		$ret['nachname']="";
		$ret['username']="";
	}
	
	echo json_encode($ret);}
// wenn Register
elseif(isset($_GET['m']) && $_GET['m']=='register'){
	
		$pw = md5($_POST["pw"]);
		$pw2 = md5($_POST["pw2"]);
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$grade = $_POST["grade"];
		$gradepass = $_POST["gradepass"];
		$username = $_POST["username"];

		
		if($pw != $pw2 && strlen($pw) > 5) {
			$ret['answer'] = 'Deine Passwörter stimmen nicht überein oder es ist kürzer als 6 Zeichen. Bitte wiederhole deine Eingabe....<a href="/pages/register.html">zurück</a>';
		} else {				
				$control = 0;		
				$abfrage = "SELECT username FROM schueler WHERE username = '$username'";
				$ergebnis = mysql_query($abfrage);
				while($row = mysql_fetch_object($ergebnis))
					{
						$control++;
					}	
				if($control != 0) {
					$ret['answer'] = 'Username schon vergeben. Bitte verwende einen anderen Usernamen....<a href="/pages/register.html">zurück</a>';
				} else {
				$abfrage2 = "SELECT grade FROM klassen WHERE grade='".$grade."' AND password='".$gradepass."';";
					$ergebnis2 = mysql_query($abfrage2);
					while($row = mysql_fetch_object($ergebnis2))
						{
							$control2++;
							
						}	
					if($control2 == 0) {
						//Klassenpasswort ist falsch
						$abfrage3 = "SELECT firstname FROM schueler WHERE grade='".$grade."';";
						$ergebnis3 = mysql_query($abfrage3);
						$names = "";
						while($row = mysql_fetch_assoc($ergebnis3))
						{
							$names .= $row['firstname']." ";						
						}	
						$ret['answer'] = 'Dein Klassenpasswort ist falsch. Frage doch mal:'.$names.' ....<a href="/pages/register.html">zurück</a>'.$control2.$grade.$gradepass;
					} else {
						//Klassenpasswort ist richtig
					$eintrag = "INSERT INTO schueler
					(username, password, firstname, lastname, grade)
					VALUES
					('$username', '$pw', '$firstname', '$lastname', '$grade')";	
					$eintragen = mysql_query($eintrag);
					
					if($eintragen == true) {
						$ret['answer'] = 'Vielen Dank. Du hast dich nun registriert...<a href="/index.html">Jetzt anmelden</a>';
					} else {
						$ret['answer'] = 'Fehler im System. Bitte versuche es sp�ter noch einmal...<a href="/pages/register.html">zurück</a>';
					}
					}
					mysql_close($db);
					}
		}
	echo json_encode($ret);	}
	

?>