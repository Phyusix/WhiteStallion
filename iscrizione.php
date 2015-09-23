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
			<h1 class="head">Iscrizione a centri ippici</h1>
			<?php
                session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="utentiregistrati"){
					require("connect.php");
					$sql = "SELECT Email, Nome FROM CentriIppici";
					$resultsql=mysqli_query($conn,$sql);
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="iscrizione.php" method="post">
							Seleziona il centro ippico a cui desideri iscriverti:<br>
							<select name="select">
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
						  $centroippico=$_POST['select'];
						  $s="INSERT INTO Richieste (`TipoRichiesta`, `Descrizione`, `CodUtente`, `CodAmm`, `DataConvalida`) VALUES ('Iscrizione','".$centroippico."','".$codfiscale."', NULL, NULL);";
						  $result= mysqli_query($conn, $s);
						  echo "La richiesta di iscrizione &egrave; andata a buon fine.";
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
