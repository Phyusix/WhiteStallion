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
			<h1 class="head">Aggiungi/Rimuovi cavallo</h1><br>
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
						<form action="agg_rim cavallo.php" method="post">
							<p>
							<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo cavallo<br><br>
													Codice passaporto del cavallo:<br>
							<input type="text" name="codcav"><br>
													Nome:<br>
							<input type="text" name="nome"><br>
													Razza:<br>
							<input type="text" name="razza"><br>
													Anno di nascita del cavallo:<br>
							<input type="int" name="anascita"><br>
													Tipo:<br>
							<input type="text" name="tipo"><br><br><br>
							<input type="radio" name="scegli" value="rimuovi">Rimuovi un cavallo<br><br>
							Codice passaporto del cavallo:<br>
							<input type="text" name="codrim"><br>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php
					}else{
					$scegli=$_POST['scegli'];
						if ($scegli=="inserisci"){
							$codc=$_POST['codcav'];
							$nome=$_POST['nome'];
							$razza=$_POST['razza'];
							$annon=$_POST['anascita'];
							$tipo=$_POST['tipo'];
							if (!$codc || !$nome || !$razza || !$annon || !$tipo){
			?>
						I campi sono obbligatori
						<form action="agg_rim cavallo.php" method="post">
							<p>
							<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo cavallo<br><br>
							Codice passaporto del cavallo:<br>
							<input type="text" name="codcav" value="<?php echo $codc;?>"><br>
							Nome:<br>
							<input type="text" name="nome" value="<?php echo $nome;?>"><br>
							Razza:<br>
							<input type="text" name="razza" value="<?php echo $razza;?>"><br>
							Anno di nascita del cavallo:<br>
							<input type="int" name="anascita" value="<?php echo $annon;?>"><br>
							Tipo:<br>
							<input type="text" name="tipo" "<?php echo $tipo;?>"><br>
							<input type="radio" name="scegli" value="rimuovi">Rimuovi un cavallo<br><br>
							Codice passaporto del cavallo:<br>
							<input type="text" name="codrim"><br>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php				
							}else{
								$s="INSERT INTO `Cavalli`(`CodPassaporto`, `Nome`, `Razza`, `AnnoNascita`, `Tipo`, `CentroIppico`) VALUES ('".$codc."', '".$nome."', '".$razza."', '".$annon."', '".$tipo."','".$centroippico."');";
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
						}else if ($scegli=="rimuovi"){
							$codrim=$_POST['codrim'];
							if (!$codrim){
			?>
						I campi sono obbligatori
						<form action="agg_rim cavallo.php" method="post">
							<p>
							<input type="radio" name="scegli" value="inserisci" CHECKED>Inserisci un nuovo cavallo<br><br>
							Codice passaporto del cavallo:<br>
							<input type="text" name="codcav"><br>
							Nome:<br>
							<input type="text" name="nome"><br>
													Razza:<br>
							<input type="text" name="razza"><br>
													Anno di nascita del cavallo:<br>
							<input type="int" name="anascita"><br>
													Tipo:<br>
							<input type="text" name="tipo"><br>
							<input type="radio" name="scegli" value="rimuovi">Rimuovi un cavallo<br><br>
							Codice passaporto del cavallo:<br>
							<input type="text" name="codrim"><br>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
						</form>
			<?php	
							}else{						
								$s="DELETE FROM `Cavalli` WHERE CodPassaporto='".$codrim."';";
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
