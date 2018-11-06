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
		$erab = $_GET['erab'];
		echo "<p><b>$erab</b></a>";
	?>
      <span class="right"><a href="../layout.html">LogOut</a> </span>
	  
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span>
		<?php
		echo " <a href='layoutErreg.php?erab=$erab'>Home</a>";
		?>
		</span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span>
		<?php
		echo " <a href='addQuestion.php?erab=$erab'>Add Question</a>";
		?>
		
		</span>
		<span>
		<?php
		echo " <a href='showQuestions.php?erab=$erab'>Show Questions</a>";
		?>
		</span>
		
		<span><a href='../xml/questions.xml'>XML Questions</a></span>

		<span>
		<?php
		echo " <a href='showXMLQuestions.php?erab=$erab'>Show XML Questions</a>";
		?>
		</span>
		
		<span>
		<?php
		echo " <a href='credits.php?erab=$erab&&var1=1'>Credits</a>";
		?>
		</span>
		
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


