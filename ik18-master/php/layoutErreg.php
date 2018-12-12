<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
	<?php	
		if(empty($_SESSION['rola'])){
			echo "<span class='left' >Anonymous </span>";
			echo "<span class='right' ><a href='signUp.php'>Erregistratu</a> </span>";
			echo "<span class='right'><a href='logIn.php'>LogIn</a> </span>";
			echo "<span class='right'><a href='pasahitzaBerrezarri.php'>Pasahitza berrezarri</a> </span>";
		}else{
			echo $_SESSION['email'];
			echo "<span class='right'><a href='logOut.php'>LogOut</a> </span>";
		}
	?>
      
	<h2>Quiz: crazy questions</h2>
    </header>
	
	<nav class='main' id='n1' role='navigation'>
		<?php
		if(empty($_SESSION['rola'])){
			echo "<span><a href='layoutErreg.php'>Home</a></span>";
			echo "<span><a href='playQuiz.php'>Play Quizzes</a></span>";
			echo "<span><a href='credits.php'>Credits</a></span>";
		}else if($_SESSION['rola'] == "IKASLEA"){
			echo " <span><a href='layoutErreg.php'>Home</a></span>";
			echo " <span><a href='handlingQuizesAJAX.php'>Quizes AJAX</a></span>";
			echo " <span><a href='credits.php'>Credits</a></span>";
		}else if($_SESSION['rola'] == "IRAKASLEA"){
			echo " <span><a href='layoutErreg.php'>Home</a></span>";
			echo " <span><a href='handlingAccounts.php'>Handling Accounts</a></span>";
			echo " <span><a href='credits.php'>Credits</a></span>";
		
		}
			
		?>
	
		
		
	</nav>
    <section class="main" id="s1">
    
	
	<div>
	
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/inigoerkizia/lab02'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>


