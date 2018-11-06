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
        		Email-a(*):<input type="email" id="email" name="email">
    		</div>
    		<div>
        		Deitura(Izen eta abizenak)(*):<input type="text" id="deitura" name="deitura" >
    		</div>
		<div>
			Pasahitza(*):<input type="password" id="pasahitza" name="pasahitza"><br><br>
			Pasahitza errepikatu(*):<input type="password" id="pasahitzaErr" name="pasahitzaErr"><br><br>
			 
		</div>
			<input type="submit" id="Erregistratu" value="Erregistratu"/>
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			
			<?php
if(isset($_POST['email'])){
	include ("dbkonfiguratu.php");

	$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);

	$email_berria=mysqli_query($esteka, "SELECT email FROM users WHERE email='$_POST[email]'");
	if(mysqli_num_rows($email_berria)>0)
	{
		echo "Email hori erregistratuta dago";
		echo "<p> <a href='../layout.html'> Menura itzuli</a>";
		return false;
	}

	
 	mysqli_query($esteka, "INSERT INTO users(email, deitura, pasahitza) VALUES ('$_POST[email]', '$_POST[deitura]', '$_POST[pasahitza]')");
	
	 

	echo "<font color='green'><h1> Erregistroa gauzatu da!</h1></font>";
	
	mysqli_close($esteka);
}
?>
			
			
			<br><a href='../layout.html'>Menura itzuli</a>
		</div>
	
</form>
	 
		
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#Erregistro").submit(function(){
			
				if($("#email").val() == "" || $("#deitura").val() == "" || $("#pasahitza").val() == "" || $("#pasahitzaErr").val() == "" ){
					alert("Derrigorrezko eremuak bete");
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

