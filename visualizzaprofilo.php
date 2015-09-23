<html>
	<body>
		<link rel="stylesheet" href="s_sheet.css" type="text/css">
		<style>
			body{
				font-family: georgia, verdana;
				text-align: center;
			}
			h1.head{
				color: #FF9900;
			}
			a:link{
				font-size: 10px;
				color: #000000;
				text-decoration: none;
			}
			a:visited{
				font-size: 10px;
				color: #000000;
				text-decoration: none;
			}
			table{
				border: 1px solid #FF9900;
				padding: 10px;
			}
			td, tr{
				border: 0px;
				padding: 10px;
			}
		</style>
		<div id="central">
			<h1 class="head">Profilo</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				require("connect.php");
				if ($permessi){
					$s="SELECT u.Cognome, u.Nome, u.DataNascita, c.Nome AS C, u.Indirizzo, u.Email, u.NumTel\n"
					."FROM UtentiRegistrati u JOIN Citta c ON (u.Risiede=c.CodCitta)\n"
					."WHERE CodiceFiscale='".$codfiscale."';";
					$result=mysqli_query($conn,$s);
					$row=mysqli_fetch_array($result);
					$s1="SELECT c.Nome FROM Dipendenti d JOIN CentriIppici c ON (c.Email=d.CentroIppico) WHERE d.CodDip='".$codfiscale."';";
					$result1=mysqli_query($conn,$s1);
					$row1=mysqli_fetch_array($result1);
			?>
					<table align="center">
			<?php
						echo "<tr><td>Cognome</td><td><center>".$row['Cognome']."</center></td>";
						echo "<tr><td>Nome</td><td><center>".$row['Nome']."</center></td>";
						echo "<tr><td>Data di nascita</td><td><center>".$row['DataNascita']."</center></td>";
						echo "<tr><td>Citt&agrave;</td><td><center>".$row['C']."</center></td>";
						echo "<tr><td>Indirizzo</td><td><center>".$row['Indirizzo']."</center></td>";
						echo "<tr><td>Email</td><td><center>".$row['Email']."</center></td>";
						if ($row['NumTel']!=""){
							echo "<tr><td>Numero di telefono</td><td><center>".$row['NumTel']."</center></td>";
						}
						if ($permessi=="stallieri" || $permessi=="amministratori" || $permessi=="istruttori"){
							echo "<tr><td>Lavori presso</td><td><center>Centro ippico ".$row1['Nome']."</center></td>";
						}
					echo "</table>";
			?>
					<br><a href="modificaprofilo.php"><font size="5px">Modifica il profilo</font></a>
			<?php
				}else{
			?>
					<h1 class="head"> Non hai i permessi per visualizzare questa pagina</h1>
			<?php 
				}
			?>
		</div>
	</body>
</html>

