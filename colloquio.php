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
		<div id="central">
			<h1 class="head">Prenota colloquio</h1>
			<?php
                session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="stallieri" or $permessi=="utentiregistrati"){
					require("connect.php");
					$sql = "SELECT Email, Nome\n"
					."FROM CentriIppici";
					$resultsql=mysqli_query($conn,$sql);
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="colloquio.php" method="post">
							Seleziona il giorno in cui fare il colloquio:<br><br>
							<input type="radio" value="LU" name="giorno" CHECKED>Luned&#236;
							<input type="radio" value="MA" name="giorno">Marted&#236;
							<input type="radio" value="ME" name="giorno">Mercoled&#236;
							<input type="radio" value="GI" name="giorno">Gioved&#236;
							<input type="radio" value="VE" name="giorno">Venerd&#236;
							<input type="radio" value="SA" name="giorno">Sabato
							<br><br>
							Seleziona l'ora:<br><br>
							<input type="radio" value="14:00-15:00" name="ora" CHECKED>14:00-15:00
							<input type="radio" value="15:00-16:00" name="ora">15:00-16:00
							<input type="radio" value="16:00-17:00" name="ora">16:00-17:00
							<input type="radio" value="17:00-18:00" name="ora">17:00-18:00
							<input type="radio" value="18:00-19:00" name="ora">18:00-19:00
							<br>
							Inserisci il centro ippico in cui vuoi avere il colloquio:<br>
							<select name="select">
								<option value="tutti">Tutti
									<?php
										while ($row1=mysqli_fetch_array($resultsql)){
									?>
								<option value="<?php echo $row1['Email'];?>">
								<?php
									echo $row1['Nome'];
								}
								?>
							</select>
							<input type="submit" value="Invio" name="invio">
						</form>	
            <?php 
					}else{
						$giorno=$_POST['giorno'];
						$ora=$_POST['ora'];
						$centroi=$_POST['select'];
						if ($centroi=="tutti"){
				?>
							Scegli un centro ippico!!!<br>
							<form action="colloquio.php" method="post">
							Seleziona il giorno in cui fare il colloquio:<br><br>
							<input type="radio" value="LU" name="giorno" CHECKED>Luned&#236;
							<input type="radio" value="MA" name="giorno">Marted&#236;
							<input type="radio" value="ME" name="giorno">Mercoled&#236;
							<input type="radio" value="GI" name="giorno">Gioved&#236;
							<input type="radio" value="VE" name="giorno">Venerd&#236;
							<input type="radio" value="SA" name="giorno">Sabato
							<br><br>
							Seleziona l'ora:<br><br>
							<input type="radio" value="14:00-15:00" name="ora" CHECKED>14:00-15:00
							<input type="radio" value="15:00-16:00" name="ora">15:00-16:00
							<input type="radio" value="16:00-17:00" name="ora">16:00-17:00
							<input type="radio" value="17:00-18:00" name="ora">17:00-18:00
							<input type="radio" value="18:00-19:00" name="ora">18:00-19:00
							<br>
							Inserisci il centro ippico in cui vuoi avere il colloquio:<br>
							<input type="text" name="centroi"><br>
							<input type="submit" value="Invio" name="invio">
						</form>	
				<?php
						}else{
							$s="INSERT INTO Richieste (`TipoRichiesta`,`Descrizione`, `CodUtente`, `CodAmm`, `DataConvalida`) VALUES ('Colloquio ".$giorno." ".$ora."','".$centroi."','".$codfiscale."', NULL, NULL);";
							$result=mysqli_query($conn, $s);
							echo "L'operazione &egrave; andata a buon fine.";
				?>
							<br><a href="richieste.php">Torna alla Homepage</a>
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
