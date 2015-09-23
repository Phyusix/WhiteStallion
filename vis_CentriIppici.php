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
			<h1 class="head">I nostri centri ippici</h1>
			<?php
				require("connect.php");
				$s = "SELECT c.Nome, ci.Nome AS Citta, c.Indirizzo, c.Tel, c.Email\n"
				."FROM CentriIppici c JOIN Citta ci ON(c.CodCitta=ci.CodCitta)";
				$result = mysqli_query($conn,$s);
			?>
			<table border="1" align="center">
				<tr>
					<td style="color: #FF9900;"><center>Nome</center></td>
					<td style="color: #FF9900;"><center>Citt&#224;</center></td>
					<td style="color: #FF9900;"><center>Indirizzo</center></td>
					<td style="color: #FF9900;"><center>Telefono</center></td>
					<td style="color: #FF9900;"><center>E-mail</center></td>
				</tr>
				<?php
					while($row=mysqli_fetch_array($result)){
						echo "<tr>";
							echo "<td><center>".$row['Nome']."</center></td>";
							echo "<td><center>".$row['Citta']."</center></td>";
							echo "<td><center>".$row['Indirizzo']."</center></td>";
							echo "<td><center>".$row['Tel']."</center></td>";
							echo "<td><center>".$row['Email']."</center></td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</body>
</html>
