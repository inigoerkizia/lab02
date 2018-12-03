<?php session_start(); ?>
<?php
	include ("dbkonfiguratu.php");    
//konexioa ireki
	$esteka = mysqli_connect($zerbitzaria, $erabiltzaile, $gakoa, $db);
	
	$ema = mysqli_query($esteka, "SELECT * FROM quiz");
	
	echo '<table border=1> <tr> <th> email </th> <th> Galdera </th><th> Erantzun zuzena </th><th> Erantzun okerra </th><th> Erantzun okerra </th><th> Erantzun okerra </th><th> Zailtasun maila </th><th> Arloa </th> </tr>';
	
	while($fila = mysqli_fetch_array($ema, MYSQLI_ASSOC)){
		echo"<tr>
       <td>".$fila["email"]."</td>
       <td>".$fila["galdera"]."</td>
       <td>".$fila["erzu"]."</td>
       <td>".$fila["erok1"]."</td>
       <td>".$fila["erok2"]."</td>
       <td>".$fila["erok3"]."</td>
	   <td>".$fila["gz1"]."</td>
       <td>".$fila["arloa"]."</td>
      </tr>\n";
	}
	echo '</table>';
	mysqli_free_result($ema);
		
	echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";

	// Konexioa itxi
	mysqli_close($esteka);
?>