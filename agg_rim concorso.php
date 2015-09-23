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
			<h1 class="head">Aggiungi/Rimuovi concorso</h1><br>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="agg_rim concorso.php" method="post">
						<p>
						<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo concorso<br><br>
						Codice concorso (4 caratteri):<br>
						<input type="text" name="codc" size="4"><br>
						Descrizione concorso:<br>
						<input type="text" name="desc"><br>
						Data Inizio:<br>
						<input type="date" name="datai"><br>
						Data Fine:<br>
						<input type="date" name="dataf"><br>
						Premio:<br>
						<input type="text" name="premio"><br><br>
						<input type="radio" name="intest" value="interno" CHECKED>Interno<br><br>
						Email centro ippico:<br>
						<input type="text" name="ci"><br><br>
						<input type="radio" name="intest" value="esterno">Esterno<br><br>
						Inserire il nome del centro ippico organizzatore:<br>
						<input type="text" name="org"><br>
						Citt&#224;:<br>
						<select name="citta">
							<?php
								$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
								$r_city=mysqli_query($conn,$city);
								while ($row=mysqli_fetch_array($r_city)){
							?>
							<option value="<?php echo $row['CodCitta'];?>">
							<?php
								echo $row['Nome'].", (".$row['Provincia'].")";
								}
							?>
						</select><br>
						Se la citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.<br>
						Indirizzo:<br>
						<input type="text" name="ind"><br>
						Telefono (non obbligatorio):<br>
						<input type="text" name="tel"><br>
						Email:<br>
						<input type="text" name="email"><br><br>
						<input type="radio" name="scegli" value="rimuovi">Rimuovi un concorso<br><br>
						Codice concorso:<br>
						<input type="text" name="codrim"><br>
						<p>
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
						<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
					</form>
			<?php
					}else{
						$scegli=$_POST['scegli'];
						$intest=$_POST['intest'];
						if ($scegli=="inserisci"){
							$codc=$_POST['codc'];
							$desc=$_POST['desc'];
							$datai=$_POST['datai'];
							$dataf=$_POST['dataf'];
							$premio=$_POST['premio'];
							if ($intest=="interno"){
								$ci=$_POST['ci'];
								if (!$codc or !$desc or !$datai or !$dataf or !$premio or !$ci){
			?>			
									I campi sono obbligatori
									<form action="agg_rim concorso.php" method="post">
										<p>
										<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo allievo<br><br>
										Codice concorso (4 caratteri):<br>
										<input type="text" name="codc" value="<?php echo $codc;?>"><br>
										Descrizione concorso:<br>
										<input type="text" name="desc" value="<?php echo $desc;?>"><br>
										Data Inizio:<br>
										<input type="date" name="datai" value="<?php echo $datai;?>"><br>
										Data Fine:<br>
										<input type="date" name="dataf" value="<?php echo $dataf;?>"><br>
										Premio:<br>
										<input type="text" name="premio" value="<?php echo $premio;?>"><br><br>
										<input type="radio" name="intest" value="interno" CHECKED>Interno<br>
										Email centro ippico:<br>
										<input type="text" name="ci" value="<?php echo $ci;?>"><br>
										<input type="radio" name="intest" value="esterno">Esterno<br><br>
										Inserire il nome del centro ippico organizzatore:<br>
										<input type="text" name="org"><br>
										Citt&#224;:<br>
										<select name="citta">
										<?php
											$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
											$r_city=mysqli_query($conn,$city);
											while ($row=mysqli_fetch_array($r_city)){
										?>
										<option value="<?php echo $row['CodCitta'];?>">
										<?php
											echo $row['Nome'].", (".$row['Provincia'].")";
											}
										?>
										</select><br>
										Se la citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.<br>
										Indirizzo:<br>
										<input type="text" name="ind"><br>
										Telefono (non obbligatorio):<br>
										<input type="text" name="tel"><br>
										Email:<br>
										<input type="text" name="email"><br><br>
										<input type="radio" name="scegli" value="rimuovi">Rimuovi un allievo<br><br>
										Codice concorso:<br>
										<input type="text" name="codrim"><br>
										<p>
										<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
										<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
									</form>
			<?php
								}else{
									$s="INSERT INTO `Concorsi`(`CodConcorso`,`Desc`, `DataInizio`, `DataFine`, `Premio`) VALUES ('".$codc."','".$desc."','".$datai."','".$dataf."','".$premio."');";
									$result=mysqli_query($conn,$s);
									$s1="INSERT INTO `Interni`(`CodConcorso`, `CentroIppico`) VALUES ('".$codc."','".$ci."');";
									$result1=mysqli_query($conn,$s1);
			?>
									Operazione eseguita con successo!! :)
			<?php
								}
							}else if ($intest=="esterno"){
								$org=$_POST['org'];
								$citta=$_POST['citta'];
								$ind=$_POST['ind'];
								$tel=$_POST['tel'];
								$email=$_POST['email'];
								if (!$codc or !$desc or !$datai or !$dataf or !$premio or !$org or !$citta or !$ind or !$email){
			?>			
									I campi sono obbligatori
									<form action="agg_rim concorso.php" method="post">
										<p>
										<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo allievo<br><br>
										Codice concorso (4 caratteri):<br>
										<input type="text" name="codc" value="<?php echo $codc;?>"><br>
										Descrizione concorso:<br>
										<input type="text" name="desc" value="<?php echo $desc;?>"><br>
										Data Inizio:<br>
										<input type="date" name="datai" value="<?php echo $datai;?>"><br>
										Data Fine:<br>
										<input type="date" name="dataf" value="<?php echo $dataf;?>"><br>
										Premio:<br>
										<input type="text" name="premio" value="<?php echo $premio;?>"><br><br>
										<input type="radio" name="intest" value="interno" CHECKED>Interno<br>
										Email centro ippico:<br>
										<input type="text" name="ci"><br>
										<input type="radio" name="intest" value="esterno">Esterno<br><br>
										Inserire il nome del centro ippico organizzatore:<br>
										<input type="text" name="org" value="<?php echo $org;?>"><br>
										Citt&#224;:<br>
										<select name="citta">
										<?php
											$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
											$r_city=mysqli_query($conn,$city);
											while ($row=mysqli_fetch_array($r_city)){
										?>
										<option value="<?php echo $row['CodCitta'];?>">
										<?php
											echo $row['Nome'].", (".$row['Provincia'].")";
											}
										?>
										</select><br>
										Se la citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.<br>
										Indirizzo:<br>
										<input type="text" name="ind"><br>
										Telefono (non obbligatorio):<br>
										<input type="text" name="tel"><br>
										Email:<br>
										<input type="text" name="email"><br><br>
										<input type="radio" name="scegli" value="rimuovi">Rimuovi un allievo<br><br>
										Codice concorso:<br>
										<input type="text" name="codrim"><br>
										<p>
										<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
										<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
									</form>
			<?php
								}else{
									$s="INSERT INTO `Concorsi`(`CodConcorso`,`Desc`, `DataInizio`, `DataFine`, `Premio`) VALUES ('".$codc."','".$desc."','".$datai."','".$dataf."','".$premio."');";
									$result=mysqli_query($conn,$s);
									$s1="INSERT INTO `Esterni`(`CodConcorso`, `Organizzatore`, `CodCitta`, `Indirizzo`, `Telefono`, `Email`) VALUES ('".$codc."','".$org."','".$citta."','".$ind."','".$tel."','".$email."');";
									$result1=mysqli_query($conn,$s1);
			?>
									Operazione eseguita con successo!! :)
			<?php
								}
							}
						}else if ($scegli=="rimuovi"){
							$codc=$_POST['codrim'];
							if (!$codc){
			?>
								I campi sono obbligatori
								<form action="agg_rim concorso.php" method="post">
									<p>
									<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo concorso<br><br>
									Codice concorso (4 caratteri):<br>
									<input type="text" name="codc" size="4"><br>
									Descrizione concorso:<br>
									<input type="text" name="desc"><br>
									Data Inizio:<br>
									<input type="date" name="datai"><br>
									Data Fine:<br>
									<input type="date" name="dataf"><br>
									Premio:<br>
									<input type="text" name="premio"><br><br>
									<input type="radio" name="intest" value="interno" CHECKED>Interno<br><br>
									Email centro ippico:<br>
									<input type="text" name="ci"><br><br>
									<input type="radio" name="intest" value="esterno">Esterno<br><br>
									Inserire il nome del centro ippico organizzatore:<br>
									<input type="text" name="org"><br>
									Citt&#224;:<br>
									<select name="citta">
									<?php
										$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
										$r_city=mysqli_query($conn,$city);
										while ($row=mysqli_fetch_array($r_city)){
									?>
									<option value="<?php echo $row['CodCitta'];?>">
									<?php
										echo $row['Nome'].", (".$row['Provincia'].")";
										}
									?>
									</select><br>
									Se la citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.<br>
									Indirizzo:<br>
									<input type="text" name="ind"><br>
									Telefono (non obbligatorio):<br>
									<input type="text" name="tel"><br>
									Email:<br>
									<input type="text" name="email"><br><br>
									<input type="radio" name="scegli" value="rimuovi">Rimuovi un concorso<br><br>
									Codice concorso:<br>
									<input type="text" name="codrim"><br>
									<p>
									<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
									<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
								</form>
			<?php
							}else{
								$s="DELETE FROM `Concorsi` WHERE CodConcorso='".$codc."';";
								$result=mysqli_query($conn,$s);
			?>
								Operazione eseguita con successo!! :)
			<?php
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
