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
			p.c{
				font: georgia, verdana;
				font-size: 20px;
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
			<h1 class="head">I miei orari</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="mezzafida" or $permessi=="agonistici" or $permessi=="allievi"){
					$s="SELECT Orario\n"
					."FROM Allievi\n"
					."WHERE CodAllievo='".$codfiscale."';";
					$result=mysqli_query($conn,$s);
					$row=mysqli_fetch_array($result);
			?>
					<table border="1" align="center">
						<tr>
							<?php echo "<td><center>".$row['Orario']."</center></td>"; ?>
						</tr>
					</table>
					<p class="c">
					Se vuoi cambiare orario compila il modulo delle richieste disponibile nel menu di sinistra!
					</p>
			<?php
				}else{
			?>
					<h1 class="head"> Non hai i permessi per visualizzare questa pagina</h1>
			<?php		
				}
			?>
		</div>
	</body>
</html>

