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
			<h1 class="head">Vincitore del concorso</h1>
			<?php
                session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="amministratori"){
					require("connect.php");
					if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
						<form action="vittoriaconcorso.php" method="post">
							Scrivi il codice del concorso:<br>
							<input type="text" name="codice"><br>
							Scrivi il vincitore del concorso:<br>
							<input type="text" name="vinc"><br>
							<input type="submit" value="Invio" name="invio">
						</form>	
            <?php 
					}else{
						$codice=$_POST['codice'];
						$vinc=$_POST['vinc'];
						if (!$codice or !$vinc){
			?>
							<form action="vittoriaconcorso.php" method="post">
								Non hai inserito tutti i campi!
								Scrivi il codice del concorso:<br>
								<input type="text" name="codice"><br>
								Scrivi il vincitore del concorso:<br>
								<input type="text" name="vinc"><br>
								<input type="submit" value="Invio" name="invio">
							</form>
			<?php							
						}else{						
							$s="UPDATE `Partecipazioni` SET Vincitore='".$vinc."' WHERE CodConcorso='".$codice."';";
							$result=mysqli_query($conn, $s);
							if (mysqli_affected_rows($conn)!=0){
								echo "L'operazione &egrave; andata a buon fine.";
							}else{
								echo "L'operazione non &egrave; andata a buon fine.";
							}
			?>
							<br><a href="amministra.php">Torna alla Homepage</a>
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
