<?php
	include ("dbkonfiguratu.php");

	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$esteka = mysqli_connect($zerbitzaria, $erabiltzaile, $gakoa, $db);

		mysqli_query($esteka, "DELETE FROM users WHERE email = '$email'");
		echo "$email -ren kontua ezabatu egin da.  ";
		echo "Freskatu aldaketak ikusteko.";
			
		// Konexioa itxi
		mysqli_close($esteka);
	}
?>