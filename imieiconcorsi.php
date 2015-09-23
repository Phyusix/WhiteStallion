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
				border: solid 3px #FF9900;
				border-collapse:collapse;
				padding: 10px;		
			}
			td, tr{
				border: 0px;
				padding: 10px;
			}
			a:link{
				font-size: 10px;
				color: #000000;
			}
			a:visited{
				font-size: 10px;
				color: #000000;
			}
		</style>
		<div id="centrale">
			<h1 class="head">I concorsi a cui sono iscritto</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="agonistici"){
					$s1="SELECT c.CodConcorso, c.Desc, c.DataInizio, c.DataFine, c.Premio, ci.Nome AS CentroIppico, ct.Nome AS Citta\n"
					."FROM Concorsi c JOIN Interni i ON (c.CodConcorso=i.CodConcorso) JOIN CentriIppici ci ON (i.CentroIppico=ci.Email) JOIN Citta ct ON (ci.CodCitta=ct.CodCitta)\n"
					."WHERE c.DataInizio>CURDATE()\n"
					."UNION\n"
					."SELECT c.CodConcorso, c.Desc, c.DataInizio, c.DataFine, c.Premio, e.Organizzatore AS CentroIppico, ct.Nome AS Citta\n"
					."FROM Concorsi c JOIN Esterni e ON (c.CodConcorso=e.CodConcorso) JOIN Citta ct ON (e.CodCitta=ct.CodCitta)\n"
					."WHERE c.DataInizio>CURDATE();";
					$s="SELECT c.Desc, c.DataInizio, c.DataFine, c.Premio, ci.Nome AS Organizzatore\n"
					."FROM Partecipazioni p JOIN Concorsi c ON (p.CodConcorso=c.CodConcorso) JOIN Interni i ON (c.CodConcorso=i.CodConcorso)\n"
					."JOIN CentriIppici ci ON (i.CentroIppico=ci.Email)\n"
					."WHERE p.CodAg='".$codfiscale."'\n"
					."UNION\n"
					."SELECT c.Desc, c.DataInizio, c.DataFine, c.Premio, e.Organizzatore\n"
					."FROM Partecipazioni p JOIN Concorsi c ON (p.CodConcorso=c.CodConcorso) JOIN Esterni e ON (c.CodConcorso=e.CodConcorso)\n"
					."WHERE p.CodAg='".$codfiscale."';";
					$result=mysqli_query($conn,$s);
					$result1=mysqli_query($conn,$s1);
					if (mysqli_num_rows($result)>0){
			?>
						<table border="1" align="center">
						<tr>
							<td style="color: #FF9900;"><center>Descrizione</center></td>
							<td style="color: #FF9900;"><center>Data inizio</center></td>
							<td style="color: #FF9900;"><center>Data fine</center></td>
							<td style="color: #FF9900;"><center>Premio</center></td>
							<td style="color: #FF9900;"><center>Organizzatore</center></td>
						</tr>
			<?php
						while($row=mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td><center>".$row['Desc']."</center></td>";
								echo "<td><center>".$row['DataInizio']."</center></td>";
								echo "<td><center>".$row['DataFine']."</center></td>";
								echo "<td><center>".$row['Premio']."</center></td>";
								echo "<td><center>".$row['Organizzatore']."</center></td>";
							echo "</tr>";}
						echo "</table>";
					}else{
						echo "Non hai partecipato a nessun concorso fin'ora.<br>";
					}
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<br><form action="imieiconcorsi.php" method="post">
							Seleziona il concorso a cui desideri iscriverti:<br>
								<select name="select">
									<option value="scegli">Scegli concorso
			<?php
									while ($row1=mysqli_fetch_array($result1)){
			?>
										<option value="<?php echo $row1['CodConcorso']; ?>">
			<?php
										echo $row1['Desc']." ".$row1['DataInizio']." ".$row1['DataFine']." ".$row1['CentroIppico'];
									}
			?>
								</select>
								<input type="submit" value="Invio" name="invio">
						</form>
			<?php
					}else{
						$select=$_POST['select'];
						if ($select=="scegli"){
			?>
							<br>Non hai selezionato nessun concorso! <br>
							<form action="imieiconcorsi.php" method="post">
								Seleziona il concorso a cui desideri iscriverti:<br>
									<select name="select">
										<option value="scegli">Scegli concorso
			<?php
										while ($row1=mysqli_fetch_array($result1)){
			?>
											<option value="<?php echo $row1['CodConcorso'];?>">
			<?php
											echo $row1['Desc']." ".$row1['DataInizio']." ".$row1['DataFine']." ".$row1['CentroIppico'];
										}
			?>
									</select>
									<input type="submit" value="Invio" name="invio">
							</form>
			<?php
						}else{
							$s3="SELECT Patente FROM Agonistici WHERE CodAg='".$codfiscale."';";
							$result3=mysqli_query($conn,$s3);
							$row3=mysqli_fetch_array($result3);
							if ($row3['Patente']!="Dadefinire"){
								$s2="INSERT INTO `Partecipazioni`(`CodConcorso`, `CodAg`, `Risultato`) VALUES ('".$select."','".$codfiscale."',NULL);";
								$result2=mysqli_query($conn,$s2);
								if (mysqli_affected_rows($conn)>0){
			?>
									<meta http-equiv=refresh content="0; url=http://localhost/progetto_basi/imieiconcorsi.php">
			<?php
								}else{
									echo "L'operazione non &egrave; andata a buon fine. La preghiamo di riprovare pi&ugrave; tardi!";
								}
							}else{
								echo "Non hai ancora inserito il codice della tua patente.<br>Aggiorna la patente dalla pagina richieste presente nel menu a sinistra!";
							}
			?>
							<br><a href="orarimiei.php">Torna alla Homepage</a>
			<?php
						}
					}
				}else{
			?>
					<h1 class="head">Non hai i permessi per visualizzare questa pagina</h1>
			<?php		
				}
			?>
		</div>
	</body>
</html>
