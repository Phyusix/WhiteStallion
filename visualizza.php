
<html>
	<body>
		<style>
			body{
				font-family: georgia, verdana;
				text-align: center;
			}
			h1.head{
				color: #FF9900;
			}
			table{
				border: 0px;
				padding: 10px;		
			}
			td, tr{
				border: 0px;
				padding: 10px;
			}
			a:link{
				text-decoration: none;
				color: #000000;
				font-size: 20px;
				font-style: bold;
			}
			a:visited{
				text-decoration: none;
				color: #000000;
				font-style: bold;
			}
		</style>
		<div id="central">
			<h1 class="head">Visualizza gli utenti o i cavalli</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
					$s1="SELECT CentroIppico FROM Dipendenti WHERE CodDip='".$codfiscale."'";
					$result1=mysqli_query($conn,$s1);
					$row1=mysqli_fetch_array($result1);
					$s="";
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="visualizza.php" method="post">
							Seleziona la classe da visualizzare <br>
							<select name="select">
								<option value="istruttori">Istruttori
								<option value="stallieri">Stallieri
								<option value="agonisti">Agonisti
								<option value="mf">Mezza fida
								<option value="normali">Senza fida
								<option value="cavalli">Cavalli
							</select>
							<input type="submit" value="Invio" name="invio">
						</form>
			<?php
					} else {
						$select=$_POST['select'];
						$s = "";
						if ($select=="istruttori"){
							$s = "SELECT u.CodiceFiscale, u.Nome, u.Cognome, u.Email\n"
							."FROM UtentiRegistrati u JOIN Dipendenti d ON (u.CodiceFiscale=d.CodDip) JOIN Istruttori i ON (d.CodDip=i.CodIstr)\n"
							."WHERE d.CentroIppico='".$row1['CentroIppico']."';";
						}else if ($select=="agonisti"){
							$s = "SELECT u.CodiceFiscale, u.Nome, a.Orario, ag.CodCavallo, u.Cognome, u.Email\n"
							."FROM UtentiRegistrati u JOIN Allievi a ON (u.CodiceFiscale=a.CodAllievo) JOIN Agonistici ag ON (a.CodAllievo=ag.CodAg)\n"
							."WHERE a.CentroIppico='".$row1['CentroIppico']."';";
						}else if ($select=="mf"){
							$s = "SELECT u.CodiceFiscale, u.Nome, u.Cognome, a.Orario, mf.CodCavallo, u.Email\n"
							."FROM UtentiRegistrati u JOIN Allievi a ON (u.CodiceFiscale=a.CodAllievo) JOIN MezzaFida mf ON (a.CodAllievo=mf.CodMF)\n"
							."WHERE a.CentroIppico='".$row1['CentroIppico']."';";
						}else if ($select=="stallieri"){
							$s = "SELECT u.CodiceFiscale, u.Nome, u.Cognome, u.Email\n"
							."FROM UtentiRegistrati u JOIN Dipendenti d ON (u.CodiceFiscale=d.CodDip)\n"
							."WHERE d.CodDip NOT IN (SELECT CodIstr AS Cod FROM Istruttori UNION SELECT CodAmm AS Cod FROM Amministratori)\n"
							."AND d.CentroIppico='".$row1['CentroIppico']."';";
						}else if ($select=="normali"){
							$s = "SELECT u.CodiceFiscale, u.Nome, a.Orario, u.Cognome, u.Email\n"
							."FROM UtentiRegistrati u JOIN Allievi a ON (u.CodiceFiscale=a.CodAllievo)\n"
							."WHERE a.CodAllievo NOT IN (SELECT CodAg AS Cod FROM Agonistici UNION SELECT CodMF AS Cod FROM MezzaFida)\n"
							."AND a.CentroIppico='".$row1['CentroIppico']."';";
						}else if ($select=="cavalli"){
							$s = "SELECT CodPassaporto, Nome, Razza, Tipo\n"
							."FROM Cavalli\n"
							."WHERE CentroIppico='".$row1['CentroIppico']."';";
						}
						$result = mysqli_query($conn,$s);
			?>
						<table border="1" align="center">
						<tr>
			<?php
						if ($select=="cavalli"){
			?>
							<td style="color: #FF9900;"><center>Passaporto</center></td>
							<td style="color: #FF9900;"><center>Nome</center></td>
							<td style="color: #FF9900;"><center>Razza</center></td>
							<td style="color: #FF9900;"><center>Tipo</center></td>
			<?php
						}else if ($select=="mf" || $select=="agonisti"){
			?>
							<td style="color: #FF9900;"><center>Codice fiscale</center></td>
							<td style="color: #FF9900;"><center>Nome</center></td>
							<td style="color: #FF9900;"><center>Cognome</center></td>
							<td style="color: #FF9900;"><center>Orario</center></td>
							<td style="color: #FF9900;"><center>Cavallo</center></td>
							<td style="color: #FF9900;"><center>Email</center></td>
			<?php
						}else if ($select=="normali"){
			?>
							<td style="color: #FF9900;"><center>Codice fiscale</center></td>
							<td style="color: #FF9900;"><center>Nome</center></td>
							<td style="color: #FF9900;"><center>Cognome</center></td>
							<td style="color: #FF9900;"><center>Orario</center></td>
							<td style="color: #FF9900;"><center>Email</center></td>
			<?php				
						}else{
			?>
							<td style="color: #FF9900;"><center>Codice fiscale</center></td>
							<td style="color: #FF9900;"><center>Nome</center></td>
							<td style="color: #FF9900;"><center>Cognome</center></td>
							<td style="color: #FF9900;"><center>Email</center></td>
			<?php		
						}
			?>
						</tr>
			<?php
						while($row=mysqli_fetch_array($result)){
							echo "<tr>";
							if ($select=="cavalli"){
								echo "<td><center>".$row['CodPassaporto']."</center></td>";
								echo "<td><center>".$row['Nome']."</center></td>";
								echo "<td><center>".$row['Razza']."</center></td>";
								echo "<td><center>".$row['Tipo']."</center></td>";
							}else if ($select=="mf" || $select=="agonisti"){
								echo "<td><center>".$row['CodiceFiscale']."</center></td>";
								echo "<td><center>".$row['Nome']."</center></td>";
								echo "<td><center>".$row['Cognome']."</center></td>";
								echo "<td><center>".$row['Orario']."</center></td>";
								echo "<td><center>".$row['CodCavallo']."</center></td>";
								echo "<td><center>".$row['Email']."</center></td>";
							}else if ($select=="normali"){
								echo "<td><center>".$row['CodiceFiscale']."</center></td>";
								echo "<td><center>".$row['Nome']."</center></td>";
								echo "<td><center>".$row['Cognome']."</center></td>";
								echo "<td><center>".$row['Orario']."</center></td>";
								echo "<td><center>".$row['Email']."</center></td>";
							}else{
								echo "<td><center>".$row['CodiceFiscale']."</center></td>";
								echo "<td><center>".$row['Nome']."</center></td>";
								echo "<td><center>".$row['Cognome']."</center></td>";
								echo "<td><center>".$row['Email']."</center></td>";
							}
							echo "</tr>";}
						echo "</table>";
			?>
						<br><a href="visualizza.php">Indietro</a>
			<?php
					}
				}else{
			?>
					<h1 class="head"> Non hai i permessi per visualizzare questa pagina</h1>
			<?php
				}
			?>
		</div>
	</body>
</html>
