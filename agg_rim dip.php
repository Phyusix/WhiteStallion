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
		</style>
		<div id="centrale">
			<h1 class="head">Aggiungi/Rimuovi dipendente</h1><br>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
					$s1="SELECT CentroIppico FROM Dipendenti WHERE CodDip='".$codfiscale."';";
					$r= mysqli_query($conn, $s1);
					$row = mysqli_fetch_array($r);
					$centroippico= $row['CentroIppico'];
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="agg_rim dip.php" method="post">
							<p>
							<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo dipendente<br><br>
							<input type="radio" name="tdip" value="stal" CHECKED>Stalliere<br>
							<input type="radio" name="tdip" value="istr">Istruttore<br><br>
							Codice fiscale dipendente:<br>
							<input type="text" name="coddipendente"><br>
							Stipendio:<br>
							<input type="double" name="stipendio"><br>
							<input type="radio" name="scegli" value="rimuovi">Rimuovi un dipendente<br><br>
							Codice fiscale dipendente:<br>
							<input type="text" name="codrim"><br>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php
					}else{
					$scegli=$_POST['scegli'];
						if ($scegli=="inserisci"){
							$codf=$_POST['coddipendente'];
							$stipendio=$_POST['stipendio'];
							if (!$codf || !$stipendio){
			?>
						I campi sono obbligatori
						<form action="agg_rim dip.php" method="post">
							<p>
							<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo dipendente<br><br>
							Codice fiscale dipendente:<br>
							<input type="text" name="coddipendente" value="<?php echo $codf;?>"><br>
							Stipendio:<br>
							<input type="double" name="stipendio" value="<?php echo $stipendio;?>"><br>
							<input type="radio" name="scegli" value="rimuovi">Rimuovi un dipendente<br><br>
							Codice fiscale dipendente:<br>
							<input type="text" name="codrim"><br>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php				
							}else{
								$tdip=$_POST['tdip'];
								$s="INSERT INTO `Dipendenti`(`CodDip`, `CentroIppico`, `Stipendio`) VALUES ('".$codf."', '".$centroippico."','".$stipendio."');";
								$result=mysqli_query($conn,$s);
								if($tdip=='istr')
								{
									$s1="INSERT INTO `Istruttori` (`CodIstr`) VALUES('".$codf."');";
									$r=mysqli_query($conn,$s1);
								}
								if (mysqli_affected_rows($conn)>0){
			?>
									L'operazione &#232; andata a buon fine!
			<?php					
								}else{
			?>
									L'operazione non &#232; andata a buon fine :( Si prega di riprovare più tardi!
			<?php					
								}
							}
						}else if ($scegli=="rimuovi"){
							$codf=$_POST['codrim'];
							if (!$codf){
			?>
						I campi sono obbligatori
						<form action="agg_rim dip.php" method="post">
							<p>
							<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo dipendente<br><br>
							Codice fiscale dipendente:<br>
							<input type="text" name="coddipendente"><br>
							Stipendio:<br>
							<input type="double" name="stipendio"><br>
							<input type="radio" name="scegli" value="rimuovi">Rimuovi un dipendente<br><br>
							Codice fiscale dipendente:<br>
							<input type="text" name="codrim"><br>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php	
							}else{						
								$s="DELETE FROM `Dipendenti` WHERE CodDip='".$codf."';";
								$result=mysqli_query($conn,$s);
								if (mysqli_affected_rows($conn)==1){
			?>
									L'operazione &#232; andata a buon fine!
			<?php
								}else{
			?>
									L'operazione non &#232; andata a buon fine :( Si prega di riprovare più tardi!
			<?php					
								}
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
