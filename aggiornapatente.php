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
			<h1 class="head">Aggiorna patente</h1>
			<?php
                session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="agonistici"){
					require("connect.php");
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="aggiornapatente.php" method="post">
							Scrivi il codice della tua patente ippica:<br>
							<input type="text" name="patente">
							<input type="submit" value="Invio" name="invio">
						</form>	
            <?php 
					}else{
						$patente=$_POST['patente'];
						if (!$patente){
			?>
							<form action="aggiornapatente.php" method="post">
								Scrivi il codice della tua patente ippica:<br>
								<input type="text" name="patente">
								<input type="submit" value="Invio" name="invio">
							</form>
			<?php							
						}else{						
							$s="INSERT INTO Richieste (`TipoRichiesta`, `Descrizione`, `CodUtente`, `CodAmm`, `DataConvalida`) VALUES ('Aggiorna patente','".$patente."','".$codfiscale."', NULL, NULL);";
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

