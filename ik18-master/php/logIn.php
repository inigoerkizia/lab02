<?php session_start(); ?>
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
<form id="login" name="login" action = "logIn.php" method="post">
			<div>
        		Email-a(*):<input type="email" id="email" name="email">
    		</div>
    		
		<div>
			Pasahitza(*):<input type="password" id="pasahitza" name="pasahitza"><br><br>
			
			 
		</div>
			<input type="submit" id="login" value="login"/>
			<input type="reset" id="reset" value="Reset"/><br><br>
			*Derrigorrezkoa da informazio hori ematea <br><br>
			
<?php

if(isset($_POST['email'])){
	include ("dbkonfiguratu.php");
	
	$irakasle = "admin000@ehu.eus";
	
	
	$esteka = mysqli_connect($zerbitzaria,$erabiltzaile,$gakoa,$db);

	$erregistroa=mysqli_query($esteka, "SELECT * FROM users WHERE email='$_POST[email]' AND pasahitza='$_POST[pasahitza]'");
	if(mysqli_num_rows($erregistroa) == 0)
	{
		echo "<font color='red'>Erabiltzaile edo pasahitz okerra.</font>";
		//echo "<p> <a href='../logIn.html'> Atzera</a>";
		echo "<p> <a href='layoutErreg.php'> Menura itzuli</a>";
		return false;
	}
	
	$erabil = mysqli_fetch_array($erregistroa, MYSQLI_ASSOC);
	if($erabil["egoera"] == "blokeatuta"){
		echo "<font color='red'>Erabiltzaile hori blokeatuta dago</font>";
		echo "<p> <a href='layoutErreg.php'> Menura itzuli</a>";
		return false;
	}
	
	if ($_POST['email'] == $irakasle){
		$_SESSION['rola'] = "IRAKASLEA";
		$_SESSION['email'] = $_POST['email'];
		echo "<font color='green'>ONGI ETORRI IRAKASLE</font>";

		echo "<p> <a href='handlingAccounts.php'>Kontuak kudeatu</a>";
		//header('Location:handlingAccounts.php');
	}else{
		$_SESSION['rola'] = "IKASLEA";
		$_SESSION['email'] = $_POST['email'];
		echo "<font color='green'>ONGI ETORRI IKASLE</font>";

		echo "<p> <a href='handlingQuizesAJAX.php'>Galderak kudeatu</a>";
		//header('Location:handlingQuizesAJAX.php');
	}
	//echo "<font color='green'><h1> Saioa ireki duzu!</h1></font>";
	//echo "<p> <a href='layoutErreg.php'> Menura joan</a>";
	
	return true;
	mysqli_close($esteka);
}


?>
			
			
			<a href='layoutErreg.php'>Hasierako menua</a>
		</div>
	
</form>
	 
		
	</body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#login").submit(function(){
			
				if($("#email").val() == "" ||  $("#pasahitza").val() == "" ){
					alert("Derrigorrezko eremuak bete");
					return false;
				}
				return true;
			});
		});
	</script>
</html>

