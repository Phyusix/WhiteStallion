<!DOCTYPE HTML>
<html>
<body  background="image05.png">
	<link rel="stylesheet" href="s_sheet.css" type="text/css">
	<style>
		head{
			left: 300px;
		}
		p.pos{
			position: absolute;
			top: 0px;
			right: 130px;
			font-size: 20px;
			
		}
		a.top_right:link{
			text-decoration: none;
			color: #FF9900;
		}
		a.top_right:visited{
			text-decoration: none;
			color: #FF9900;
			font-size: 20px;
		}
		a.menu:link{
			text-decoration: none;
			color: #000000;
			font-size: 20px;
			font-style: bold;
		}
		a.menu:visited{
			text-decoration: none;
			color: #000000;
			font-style: bold;
		}
		body{
			margin: 70px 70px;
			background-attachment: fixed;
		}
	</style>
	<title>
		White Stallion
	</title>
	<div id="container">
		<div id="header">
			<head> White Stallion </head>
			<p class="pos"><a class="top_right" href="visualizzaprofilo.php" target="centrale">Profilo</a> <a class="top_right" href="logout.php">Disconnetti</a></p>
 		</div>
		<div id="main">
			<div id="menu">
				<div id="dataora">
					<iframe src="dataora.php" width="300px" height="40px" frameborder="0"></iframe>
				</div>
				<font color="#FF9900"><h4>Menu</h4></font>
					<a class="menu" href="vis_CentriIppici.php" target="centrale">I nostri centri ippici</a><br>
					<a class="menu" href="vis_Cavalli.php" target="centrale">I nostri cavalli</a><br>
					<a class="menu" href="iconcorsi.php" target="centrale">I concorsi</a><br>
					<a class="menu" href="richieste.php" target="centrale">Le richieste</a><br>
					<a class="menu" href="orarimiei.php" target="centrale">I miei orari di allenamento</a>
			</div>
			<div id="central">
				<iframe src="richieste.php" name="centrale" width="992px" height="1240px" frameborder="0"></iframe>
				<?php
					session_start();
					$codfiscale=$_SESSION['utente'];
					$permessi=$_SESSION['permessi'];
				?>
			</div>
		</div>
	</div>
</body>
</html>
