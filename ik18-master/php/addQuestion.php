
<?php
	include ("dbkonfiguratu.php");

	$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);

	mysqli_query($esteka, "INSERT INTO quiz(email, galdera, erzu, erok1, erok2, erok3, gz1, arloa) VALUES ('$_POST[email]', '$_POST[galdera]', '$_POST[erzu]', '$_POST[erok1]', '$_POST[erok2]', '$_POST[erok3]', '$_POST[gz1]', '$_POST[arloa]')");

	
	echo 'Galdera gehitu da!';
	echo "<p> <a href='../addQuestion.html'> Galdera berri bat gehitu</a>";
	echo "<p> <a href='showQuestions.php'> Erregistroak ikusi</a>";
	mysqli_close($esteka);
?>