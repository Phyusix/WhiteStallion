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
			<h1 class="head">Cambio abbonamento</h1>
			<?php
                session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="allievi" || $permessi=="mezzafida" || $permessi=="agonistici"){
					require("connect.php");
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="caab.php" method="post">
							Seleziona l'abbonamento desiderato:<br>
							<select name="select">
								<option value="allievi">Senza fida
								<option value="mezzafida">Mezza fida
								<option value="agonistici">Agonistici
							</select>
							<input type="submit" value="Invio" name="invio">
						</form>	
            <?php 
					}else{
						$abbonamento=$_POST['select'];
						$s="INSERT INTO Richieste (`TipoRichiesta`, `Descrizione`, `CodUtente`, `CodAmm`, `DataConvalida`) VALUES ('Cambio abbonamento','".$abbonamento."','".$codfiscale."', NULL, NULL);";
						$result= mysqli_query($conn, $s);
						echo "L'operazione &egrave; andata a buon fine.";
			?>
						<br><a href="richieste.php">Torna alla Homepage</a>
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
