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
<form id="Erregistro" name="Erregistro" action = "signUp.php" method="post">
			<div>
        		Email-a(*):<input type="email" id="email" name="email" onchange="egiaztatuMatrikula()">
    		</div>
    		<div>
        		Deitura(Izen eta abizenak)(*):<input type="text" id="deitura" name="deitura" >
    		</div>
		<div>
			Pasahitza(*):<input type="password" id="pasahitza" name="pasahitza" onchange="egiaztatuPasahitza()"><br><br>
			Pasahitza errepikatu(*):<input type="password" id="pasahitzaErr" name="pasahitzaErr"><br><br>
			 
		</div>
			<input type="submit" id="Erregistratu" value="Erregistratu"/>
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			<span id="matrikulatua"></span><br>
			<span id="pasahitza2"></span>
			

			
			
			
<?php
if(isset($_POST['email'])){
	include ("dbkonfiguratu.php");

	$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);

	$email_berria=mysqli_query($esteka, "SELECT email FROM users WHERE email='$_POST[email]'");
	if(mysqli_num_rows($email_berria)>0)
	{
		echo "Email hori erregistratuta dago";
		echo "<p> <a href='layoutErreg.php'> Menura itzuli</a>";
		return false;
	}

	
 	mysqli_query($esteka, "INSERT INTO users(email, deitura, pasahitza, egoera) VALUES ('$_POST[email]', '$_POST[deitura]', '$_POST[pasahitza]', 'aktibo')");
	
	 

	echo "<font color='green'><h1> Erregistroa gauzatu da!</h1></font>";
	
	mysqli_close($esteka);
}
?>
			
			
			<br><a href='layoutErreg.php'>Menura itzuli</a>
		</div>
	
</form>
	 
		
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	
	var xhro = new XMLHttpRequest();

	xhro.onreadystatechange = function(){ //Matrikula
				if((xhro.readyState==4)&&(xhro.status==200)){
					var result = xhro.responseText;
					
					if(result == "BAI"){
						document.getElementById("matrikulatua").innerHTML = "Email hori WS irakasgaian matrikulatuta dago."
						document.getElementById("matrikulatua").style.color = "green";
					}else{
						document.getElementById("matrikulatua").innerHTML = "Email hori ez dago WS irakasgaian matrikulatuta."
						document.getElementById("matrikulatua").style.color = "red";
					}
				}
				
	}
	var xhro2 = new XMLHttpRequest();
	
	xhro2.onreadystatechange = function(){ //Pasahitza
				if((xhro2.readyState==4)&&(xhro.status==200)){
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
	
			function egiaztatuMatrikula(){
				var email = $("#email").val();
				console.log(email);
				xhro.open("GET","egiaztaMatrikula.php?email="+ email, true);
				xhro.send();
			}
	
			function egiaztatuPasahitza(){
				var pasahitza = $("#pasahitza").val();
				xhro2.open("POST","egiaztatuPasahitzaBezero.php", true);
				xhro2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhro2.send("pasahitza="+pasahitza);
			}
	
		$(document).ready(function() {
			$("#Erregistro").submit(function(){
			
				var baldintza1 = xhro.responseText;
				var baldintza2 = xhro2.responseText;

				
				if($("#email").val() == "" || $("#deitura").val() == "" || $("#pasahitza").val() == "" || $("#pasahitzaErr").val() == "" ){
					alert("Derrigorrezko eremuak bete");
					return false;
				}
				
				if(baldintza1 != "BAI" || baldintza2 != "BALIOZKOA"){
					alert("Ezin zara erregistratu!");
					return false;
				}
				
				var rege2 = /^[A-Z]([a-zA-Z]+) [A-Z]([a-zA-Z]+)( [a-zA-Z]*)*/;
				if(!rege2.test($("#deitura").val())){
					alert("Sartu izen eta abizen bat gutxienez letra larriz hasita");
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
				
				var rege = /^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/;
				if(!rege.test($("#email").val())){
					alert("Hizkiak + 3 digitu + “@ikasle.ehu.eus” (EHU ikasleen eposta)");
					return false;
				}
				
				
				return true;
			});
		});
	</script>
</html>

