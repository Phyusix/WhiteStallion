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
			<h1 class="head">Cambio orario</h1>
			<?php
                session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="allievi" || $permessi=="mezzafida" || $permessi=="agonistici"){
					require("connect.php");
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="cambioorario.php" method="post">
							Seleziona i giorni desiderati:<br><br>
							<input type="checkbox" value="LU" name="giorno[]">Luned&#236;
							<input type="checkbox" value="MA" name="giorno[]">Marted&#236;
							<input type="checkbox" value="ME" name="giorno[]">Mercoled&#236;
							<input type="checkbox" value="GI" name="giorno[]">Gioved&#236;
							<input type="checkbox" value="VE" name="giorno[]">Venerd&#236;
							<input type="checkbox" value="SA" name="giorno[]">Sabato
							<br><br>
							Seleziona l'ora:<br><br>
							<input type="radio" value="14:00-15:00" name="ora" CHECKED>14:00-15:00
							<input type="radio" value="15:00-16:00" name="ora">15:00-16:00
							<input type="radio" value="16:00-17:00" name="ora">16:00-17:00
							<input type="radio" value="17:00-18:00" name="ora">17:00-18:00
							<input type="radio" value="18:00-19:00" name="ora">18:00-19:00
							<br>
							<input type="submit" value="Invio" name="invio">
						</form>	
            <?php 
					}else{
						if (isset($_POST['giorno'])){
							$giorni=$_POST['giorno'];
							$ora=$_POST['ora'];
							$giornisel="";
							foreach($giorni as $giorni) {
								$giornisel=$giornisel.$giorni." ";
							}
							$s="INSERT INTO Richieste (`TipoRichiesta`,`Descrizione`, `CodUtente`, `CodAmm`, `DataConvalida`) VALUES ('Cambio orario','".$giornisel.$ora."','".$codfiscale."', NULL, NULL);";
							$result=mysqli_query($conn, $s);
							echo "L'operazione &egrave; andata a buon fine.";
			?>
							<br><a href="richieste.php">Torna alla Homepage</a>
			<?php
						}else{							
							echo "Non hai selezionato nessun giorno della settimana!";
			?>
							<form action="cambioorario.php" method="post">
								Seleziona i giorni desiderati:<br><br>
								<input type="checkbox" value="LU" name="giorno[]">Luned&#236;
								<input type="checkbox" value="MA" name="giorno[]">Marted&#236;
								<input type="checkbox" value="ME" name="giorno[]">Mercoled&#236;
								<input type="checkbox" value="GI" name="giorno[]">Gioved&#236;
								<input type="checkbox" value="VE" name="giorno[]">Venerd&#236;
								<input type="checkbox" value="SA" name="giorno[]">Sabato
								<br><br>
								Seleziona l'ora:<br><br>
								<input type="radio" value="14:00-15:00" name="ora" CHECKED>14:00-15:00
								<input type="radio" value="15:00-16:00" name="ora">15:00-16:00
								<input type="radio" value="16:00-17:00" name="ora">16:00-17:00
								<input type="radio" value="17:00-18:00" name="ora">17:00-18:00
								<input type="radio" value="18:00-19:00" name="ora">18:00-19:00
								<br>
								<input type="submit" value="Invio" name="invio">
							</form>
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
