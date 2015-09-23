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
				if ($permessi=="agonistici" or $permessi="mezzafida" or $permessi=="allievi" or $permessi=="stallieri" or $permessi=="istruttori"){
					$s="SELECT TipoRichiesta,Descrizione, CodAmm, DataConvalida FROM Richieste WHERE CodUtente='".$codfiscale."';";
					$result=mysqli_query($conn,$s);
					if (mysqli_num_rows($result)==0){
						echo "Non hai nessuna richiesta!";
					}else{
			?>
						<p>
						<table border="1" align="center">
						<tr>
							<td style="color: #FF9900;"><center>Tipo</center></td>
							<td style="color: #FF9900;"><center>Descrizione</center></td>
							<td style="color: #FF9900;"><center>Data convalida</center></td>
						</tr>
			<?php
						while($row=mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td><center>".$row['TipoRichiesta']."</center></td>";
								echo "<td><center>".$row['Descrizione']."</center></td>";
								if ($row['DataConvalida']!=""){
									echo "<td><center>".$row['DataConvalida']."</center></td>";
								}else if($row['DataConvalida']=="" && $row['CodAmm']==""){
									echo "<td><center>In attesa</center></td>";
								}else if($row['DataConvalida']=="" && $row['CodAmm']!=""){
									echo "<td><center>Rifiutata</center></td>";
								}
							echo "</tr>";
						}
						echo "</table>";
					}
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="richieste.php" method="post">
							<p>
							<h2>Richiesta di<br>
							<select name="richiesta">
								<option value="iscr">Iscrizione corso equitazione
								<option value="caor">Cambio orario
								<option value="caab">Cambio abbonamento
								<option value="agpa">Aggiorna Patente
								<option value="iscs">Richiesta colloquio
							</select>
							</p>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php
				
					}else{
						$richiesta=$_POST['richiesta'];
						if ($richiesta=="iscr"){
			?>
							<meta http-equiv=refresh content="0; url=iscrizione.php">
			<?php
						}else if($richiesta=="caor"){
			?>
							<meta http-equiv=refresh content="0; url=cambioorario.php">
			<?php
						
						}else if($richiesta=="caab"){
			?>	
							<meta http-equiv=refresh content="0; url=caab.php">
			<?php
						}else if ($richiesta=="agpa"){
			?>	
							<meta http-equiv=refresh content="0; url=aggiornapatente.php">
			<?php				
						}else{
			?>	
							<meta http-equiv=refresh content="0; url=colloquio.php">
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
