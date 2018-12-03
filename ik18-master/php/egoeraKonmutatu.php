<?php
	include ("dbkonfiguratu.php");

	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$esteka = mysqli_connect($zerbitzaria, $erabiltzaile, $gakoa, $db);
	
		$ema = mysqli_query($esteka, "SELECT * FROM users WHERE email='$email'");
		while($fila = mysqli_fetch_array($ema, MYSQLI_ASSOC)){
			if ($fila["egoera"] == "aktibo"){
				$blokeatuta = "blokeatuta";
				mysqli_query($esteka, "UPDATE users SET egoera='$blokeatuta' WHERE email='$email'");
				echo "$email -ren kontua blokeatu egin da.  ";
				echo "Freskatu aldaketak ikusteko.";
			}else{
				$aktibo = "aktibo";
				mysqli_query($esteka, "UPDATE users  SET egoera='$aktibo' WHERE email='$email'");
				echo "$email -ren kontua aktibatu egin da.  ";
				echo "Freskatu aldaketak ikusteko.";
			}
		}
	
		mysqli_free_result($ema);
			
		// Konexioa itxi
		mysqli_close($esteka);
	}
?>