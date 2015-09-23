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
		<div id="centrale">
			<h1 class="head">I miei orari</h1>
			<?php
				require("connect.php");
				session_start();
				$codfiscale=$_SESSION['utente'];
				$permessi=$_SESSION['permessi'];
				if ($permessi=="istruttori"){
					$s="SELECT DISTINCT a.Orario FROM Allievi a JOIN Istruttori i ON (a.CodIstr=i.CodIstr) WHERE a.CodIstr='".$codfiscale."';";
					$result=mysqli_query($conn,$s);
			?>
					<p>
					<table border="1" align="center">
					<tr>
						<td style="color: #FF9900;"><center>Orario di lavoro</center></td>
					</tr>
			<?php
					while ($row=mysqli_fetch_array($result)){
						echo "<tr>";
							echo "<td><center>".$row['Orario']."</center></td>";
						echo "</tr>";
					}
					echo "</table></p>";
				}else{
			?>
					<h1 class="head"> Non hai i permessi per visualizzare questa pagina</h1>
			<?php		
				}
			?>
		</div>
	</body>
</html>

