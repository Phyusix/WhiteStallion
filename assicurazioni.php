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
			<h1 class="head">Visualizza le assicurazioni in scadenza</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
					$s1="SELECT CentroIppico FROM Dipendenti WHERE CodDip='".$codfiscale."'";
					$result1=mysqli_query($conn,$s1);
					$row1=mysqli_fetch_array($result1);
					$s="SELECT a.CodAllievo, u.Nome, u.Cognome, u.Email, a.Quota, a.Scadenza\n"
					."FROM Assicurazioni a JOIN Allievi al ON (a.CodAllievo=al.CodAllievo) JOIN UtentiRegistrati u ON (al.CodAllievo=u.CodiceFiscale)\n"
					."WHERE al.CentroIppico='".$row1['CentroIppico']."' AND a.Scadenza<=CURDATE()+14;";					
					$result=mysqli_query($conn,$s);
					if (mysqli_num_rows($result)>0){
			?>
						<table border="1" align="center">
						<tr>
							<td style="color: #FF9900;"><center>Codice allievo</center></td>
							<td style="color: #FF9900;"><center>Nome</center></td>
							<td style="color: #FF9900;"><center>Cognome</center></td>
							<td style="color: #FF9900;"><center>Email</center></td>
							<td style="color: #FF9900;"><center>Quota</center></td>
							<td style="color: #FF9900;"><center>Scadenza</center></td>
						</tr>
			<?php
							while($row=mysqli_fetch_array($result)){
								echo "<tr>";
									echo "<td><center>".$row['CodAllievo']."</center></td>";
									echo "<td><center>".$row['Nome']."</center></td>";
									echo "<td><center>".$row['Cognome']."</center></td>";
									echo "<td><center>".$row['Email']."</center></td>";
									echo "<td><center>".$row['Quota']."</center></td>";
									echo "<td><center>".$row['Scadenza']."</center></td>";
								echo "</tr>";
							}
							echo "</table>";
					}else{
							echo "Non ci sono assicurazioni in scadenza!";
					}
					if ($_SERVER['REQUEST_METHOD']!='POST'){
			?>
						<br>
						<form action="assicurazioni.php" method="post">
							Scrivi il codice fiscale dell'allievo:<br>
							<input type="text" name="cf"><br>
							Inserisci la nuova data di scadenza dell'assicurazione:<br>
							<input type="date" name="scad"><br>
							<input type="submit" value="Invio" name="invio">
						</form>	
			<?php 
					}else{
						$cf=$_POST['cf'];
						$scad=$_POST['scad'];
						if (!$cf or !$scad){
			?>
						<br>Controlla di aver inserito i dati obbligatori e di averli inseriti corretti!<br>
						<form action="assicurazioni.php" method="post">
							Scrivi il codice fiscale dell'allievo:<br>
							<input type="text" name="cf"><br>
							Inserisci la nuova data di scadenza dell'assicurazione:<br>
							<input type="date" name="scad"><br>
							<input type="submit" value="Invio" name="invio">
						</form>	
			<?php
						}else{
							$s3="UPDATE `Assicurazioni` SET Scadenza='".$scad."' WHERE CodAllievo='".$cf."';";
							$result3=mysqli_query($conn,$s3);
							if (mysqli_affected_rows($conn)>0){
			?>
								<meta http-equiv=refresh content="0; url=assicurazioni.php">
			<?php					
							}else{
								echo "L'operazione non &egrave; andata a buon fine.";
							}
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
