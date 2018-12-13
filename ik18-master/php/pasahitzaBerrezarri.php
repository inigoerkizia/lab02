<?php session_start() ?>
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
<form id="berrezarpen" name="berrezarpen" action = "pasahitzaBerrezarri.php" method="post">
			<div>
        		Idatzi berreskurapen e-mail bat(*):<input type="email" id="email" name="email">
    		</div>

			<input type="submit" id="berrezarpen" value="Eskaera bidali"/>
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			<span id="emaitza"></span><br>
			
			<br><a href='layoutErreg.php'>Menura itzuli</a>
		</div>
	<?php
	
	if(isset($_POST['email'])){
		include ("dbkonfiguratu.php");
		$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);
		$email = $_POST['email'];
		$erregistroa=mysqli_query($esteka, "SELECT * FROM users WHERE email='$_POST[email]'");
		if(mysqli_num_rows($erregistroa) == 0)
		{
			echo "<font color='red'>Erabiltzaile hori ez da existitzen.</font>";
			return false;
		}
	
		$to = $email;
		$subject = "Pasahitza berrezarri";
		$kodea = rand(10000, 99999);
		$_SESSION['kodea'] = $kodea;
		$_SESSION['email'] = $email;
		
		$message = "
		<html>
		<head>
		<title> Pasahitz berrezarpena </title>
		</head>
		<body>
		<h3> Pasahitza berrezartzeko pausu hauek jarritu:</h3>
		<o1>
			<li> Sartu emandako estekan.</li>
			<li> Sartu emandako kodea eta pasahitz berria.</li>
			<li> Dena ondo joan bada, zure pasahitza guneratua izango da.</li>
		</ol>
		<h3> Pasahitz berrezarpenerako linka</h3>
		<h2><a href='https://ws18e.000webhostapp.com/Proiektua/php/pasahitzaBerrezarriKodea.php?email=".$email."'> Hemen</a></h2>
		<h3> Berrezarpen kodea: </h3>
		<h2>".$kodea."</h2>
		</body>
		</html>
		";
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html:charset-UTF-8" . "\r\n";
		$headers .= 'From: noreply @ company . com';
		mail($to, $subject, $message, $headers);
		echo "<h1><font color='green'>Mezua bidali da</font></h1>";
	}
	
?>	 
</form>


		
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
			
		$(document).ready(function() {
			$("#berrezarpen").submit(function(){
				var 
				if($("#email").val() == ""){
					alert("Derrigorrezko eremuak bete");
					return false;
				}
			});
		});
		
		
	</script>
</html>

