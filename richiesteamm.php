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
			<h1 class="head">Le mie richieste</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
					$s1="SELECT CentroIppico FROM Dipendenti WHERE CodDip='".$codfiscale."';";
					$result1=mysqli_query($conn,$s1);
					$row1=mysqli_fetch_array($result1);
					$s="SELECT r.CodRichiesta, r.TipoRichiesta, r.Descrizione, u.CodiceFiscale\n"
					."FROM Richieste r JOIN UtentiRegistrati u ON (r.CodUtente=u.CodiceFiscale) JOIN Allievi a ON (u.CodiceFiscale=a.CodAllievo)\n"
					."WHERE a.CentroIppico='".$row1['CentroIppico']."' AND r.CodAmm is NULL\n"
					."UNION\n"
					."SELECT r.CodRichiesta, r.TipoRichiesta, r.Descrizione, u.CodiceFiscale\n"
					."FROM Richieste r JOIN UtentiRegistrati u ON (r.CodUtente=u.CodiceFiscale) JOIN Dipendenti d ON (u.CodiceFiscale=d.CodDip)\n"
					."WHERE d.CentroIppico='".$row1['CentroIppico']."' AND r.CodAmm is NULL\n"
					."UNION\n"
					."SELECT r.CodRichiesta, r.TipoRichiesta, r.Descrizione, u.CodiceFiscale\n"
					."FROM Richieste r JOIN UtentiRegistrati u ON (r.CodUtente=u.CodiceFiscale)\n"
					."WHERE r.Descrizione='".$row1['CentroIppico']."' AND r.CodAmm is NULL;";
					$result=mysqli_query($conn,$s);
					if (mysqli_num_rows($result)==0){
						echo "Non ci sono richieste in attesa di conferma!";
					}else{
			?>
						<p>
						<table border="1" align="center">
						<tr>
							<td style="color: #FF9900;"><center>Codice richiesta</center></td>
							<td style="color: #FF9900;"><center>Tipo richiesta</center></td>
							<td style="color: #FF9900;"><center>Descrizione</center></td>
							<td style="color: #FF9900;"><center>Codice allievo</center></td>
						</tr>
			<?php
						while($row=mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td><center>".$row['CodRichiesta']."</center></td>";
								echo "<td><center>".$row['TipoRichiesta']."</center></td>";
								echo "<td><center>".$row['Descrizione']."</center></td>";
								echo "<td><center>".$row['CodiceFiscale']."</center></td>";
							echo "</tr>";
						}
			?>
					</table>
					</p>
			<?php
					}
					if ($_SERVER['REQUEST_METHOD']!='POST' && (mysqli_num_rows($result)!=0)){
			?>
						<form action="richiesteamm.php" method="post">
							<p><h2>Inserisci il codice della richiesta da confermare</h2>
							<input type="text" name="codice"></p>
							<h2>Inserisci il codice della richiesta da rifiutare</h2>
							<input type="text" name="ncodice"></p>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php
					}else if ($_SERVER['REQUEST_METHOD']=='POST'){
						$codice=$_POST['codice'];
						$ncodice=$_POST['ncodice'];
						if (!$codice and !$ncodice){
			?>
							Almeno un campo &egrave; obbligatorio!
							<form action="richiesteamm.php" method="post">
								<p><h2>Inserisci il codice della richiesta da confermare</h2>
								<input type="text" name="codice"></p>
								<p><h2>Inserisci il codice della richiesta da rifiutare</h2>
								<input type="text" name="ncodice"></p>
								<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
								<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
							</form>
			<?php	
						}else{
							if ($codice){
								$query="UPDATE `Richieste` SET `CodAmm`='".$codfiscale."', DataConvalida=CURDATE()\n"
								."WHERE CodRichiesta=".$codice.";";
								$resultquery=mysqli_query($conn,$query);
							}
							if ($ncodice){
								$query="UPDATE `Richieste` SET `CodAmm`='".$codfiscale."', DataConvalida=NULL\n"
								."WHERE CodRichiesta=".$ncodice.";";
								$resultquery=mysqli_query($conn,$query);
							}
			?>
							<meta http-equiv=refresh content="0; url=richiesteamm.php">
			<?php
						}
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

