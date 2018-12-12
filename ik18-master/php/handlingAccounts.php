<?php session_start(); ?>
<?php
if(isset($_SESSION['email'])){
	echo "Kautotutako erabiltzailea: $_SESSION[email]";
}
?>
<?php 
				if(empty($_SESSION['rola'])){
					echo "<a>EZIN DUZU ORRI HONTAN SARTU</a>";
					echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";
					echo "<img src= '../images\prohibido.jpg'>";
					return false;
				}
				if($_SESSION['rola'] == "IKASLEA"){
					echo "<a>EZIN DUZU ORRI HONTAN SARTU</a>";
					echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";
					echo "<img src= '../images\prohibido.jpg'>";
					return false;
				}
			?>
<?php
	include ("dbkonfiguratu.php");    
//konexioa ireki
	$esteka = mysqli_connect($zerbitzaria, $erabiltzaile, $gakoa, $db);
	
	$ema = mysqli_query($esteka, "SELECT * FROM users");
	
	echo '<table border=1> <tr> <th> Emaila </th> <th> Pasahitza </th><th> Egoera </th></tr>';
	
	while($fila = mysqli_fetch_array($ema, MYSQLI_ASSOC)){
		$email=$fila["email"];
		echo"<tr>
       <td>".$fila["email"]."</td>
       <td>".$fila["pasahitza"]."</td>
	   <td>".$fila["egoera"]."</td>
	   <td> <input type='button' name='Konmutatu' value='Konmutatu' onclick =bilatu('$email') /> </td>
	   <td> <input type='button' name='Ezabatu' value='Ezabatu' onclick = bilatuUser('$email') /> </td>
      </tr>\n";
	}
	echo '</table>';
	mysqli_free_result($ema);
		
	echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";

	// Konexioa itxi
	mysqli_close($esteka);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		var xhro3 = new XMLHttpRequest();
		var xhro2 = new XMLHttpRequest();
		
		//Useraren egoera aldatzeko
		xhro3.onreadystatechange= function (){
			if (this.readyState == 4 && this.status == 200){
				alert(xhro3.responseText);
			}
		};
		function bilatu(id){
			xhro3.open("POST","egoeraKonmutatu.php", true);
			xhro3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro3.send("email="+id);
			
		}
		
		//User bat ezabatzeko
		
		xhro2.onreadystatechange= function (){
			if (this.readyState == 4 && this.status == 200){
				alert(xhro2.responseText);
			}
		};
		function bilatuUser(id){
			xhro2.open("POST","ezabatuUser.php", true);
			xhro2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro2.send("email="+id);
			
		}
	
	</script>
