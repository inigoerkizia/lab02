<?php session_start(); ?>
<?php  
	if(empty($_SESSION['kodea'])){
		echo "<a>EZIN DUZU ORRI HONTAN SARTU</a>";
		echo "<p> <a href='layoutErreg.php'>Menura itzuli</a>";
		echo "<img src= '../images\prohibido.jpg'>";
		return false;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

	<style>
	form {
    
   	margin: 0 auto;
   	width: 400px;
	background-color: white;
    
    	padding: 1em;
   	border: 1px solid #CCC;
    	border-radius: 1em;
	}
	form div + div {
    	margin-top: 1em;
	}
	
	</style>
	</head>
	
	<body background ="../images\letras-de-modelo-37111940.jpg">
<form id="berrezarpen" name="berrezarpen" action = "pasahitzaBerrezarriKodea.php" method="post">
			<div>
        		Email-a(*):<input type="email" id="email" name="email" value= "<?php echo $_SESSION['email'] ?>">
    		</div>

		<div>
			Pasahitz berria(*):<input type="password" id="pasahitza" name="pasahitza" onchange="egiaztatuPasahitza()"><br><br>
			Pasahitz berria errepikatu(*):<input type="password" id="pasahitzaErr" name="pasahitzaErr"><br><br>
			Berreskurapen kodea(*):<input type="text" id="kodea" name="kodea"><br><br>
		</div>
			<input type="submit" id="berrezarpen" value="Berrezarri"/>
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			<span id="pasahitza2"></span><br>
			
			
<?php
	if(isset($_POST['pasahitza'])){
		if($_POST['kodea'] != $_SESSION['kodea']){
			echo "<font color='red'>Sartu duzun kodea ez da zuzena!</font>";
			echo "<p> <a href='layoutErreg.php'> Menura itzuli</a>";
			return false;
		}
	include ("dbkonfiguratu.php");

	$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);

	$email_berria=mysqli_query($esteka, "SELECT email FROM users WHERE email='$_POST[email]'");
	if(mysqli_num_rows($email_berria) == 0)
	{
		echo "Email hori ez dago erregistratuta";
		echo "<p> <a href='layoutErreg.php'> Menura itzuli</a>";
		return false;
	}
	$pasahitza_hash = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);

 	mysqli_query($esteka, "UPDATE users SET pasahitza='$pasahitza_hash' WHERE email='$_POST[email]'");
	
	 

	echo "<font color='green'><h1> Pasahitza eguneratu da!</h1></font>";
	
	mysqli_close($esteka);
}
?>
			
			
			<br><a href='layoutErreg.php'>Menura itzuli</a>
		</div>
	
</form>
	 
		
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	var xhro2 = new XMLHttpRequest();
	
	xhro2.onreadystatechange = function(){ //Pasahitza
				if((xhro2.readyState==4)&&(xhro2.status==200)){
					var result2 = xhro2.responseText;
					
					if(result2 == "BALIOZKOA"){
						document.getElementById("pasahitza2").innerHTML = "Sartu duzun pasahitza egokia da."
						document.getElementById("pasahitza2").style.color = "green";
						document.getElementById("pasahitza").style.color = "green";
					}else if (result2 =="BALIOGABEA"){
						document.getElementById("pasahitza2").innerHTML = "Sartu duzun pasahitza ez da egokia."
						document.getElementById("pasahitza2").style.color = "red";
						document.getElementById("pasahitza").style.color = "red";
					}else{
						document.getElementById("pasahitza2").innerHTML = "Tiket okerra."
						document.getElementById("pasahitza2").style.color = "red";
					}
				}
	}
	
			function egiaztatuPasahitza(){
				var pasahitza = $("#pasahitza").val();
				xhro2.open("POST","egiaztatuPasahitzaBezero.php", true);
				xhro2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhro2.send("pasahitza="+pasahitza);
			}
			
			
		$(document).ready(function() {
			$("#berrezarpen").submit(function(){
			
				var baldintza2 = xhro2.responseText;

				
				if($("#email").val() == "" || $("#pasahitza").val() == "" || $("#pasahitzaErr").val() == "" || $("#kodea").val() == ""){
					alert("Derrigorrezko eremuak bete");
					return false;
				}
				
				if(baldintza2 != "BALIOZKOA"){
					alert("Ezin duzu pasahitza aldatu!");
					return false;
				}
				
				pasahitz = $("#pasahitza").val();
				if(pasahitz.trim().length<8){
					alert("Pasahitzak 8 karaktere minimo eduki behar ditu");
					return false;
				}
				pasahitzerr = $("#pasahitzaErr").val();
				if($("#pasahitza").val()== $("#pasahitzaErr").val()){
					//alert("Pasahitz egokia");
				}else{
					alert("Pasahitzak berdinak izan behar dute");
					return false;
				}	
				return true;
			});
		});
	</script>
</html>

