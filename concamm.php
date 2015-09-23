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
				border: 0px;
				padding: 10px;		
			}
			td, tr{
				border: 0px;
				padding: 10px;
			}
			a:link{
			text-decoration: none;
			color: #000000;
			font-size: 20px;
			font-style: bold;
			}
			a:visited{
			text-decoration: none;
			color: #000000;
			font-style: bold;
			}
		</style>
		<div id="central">
			<h1 class="head">I nostri concorsi</h1>
			<?php
				require("connect.php");
				$s = "SELECT c.CodConcorso, c.Desc, c.DataInizio, c.DataFine, c.Premio, ci.Nome AS CentroIppico, ct.Nome AS Citta\n"
				."FROM Concorsi c JOIN Interni i ON (c.CodConcorso=i.CodConcorso) JOIN CentriIppici ci ON (i.CentroIppico=ci.Email) JOIN Citta ct ON (ci.CodCitta=ct.CodCitta)\n"
				."UNION\n"
				."SELECT c.CodConcorso, c.Desc, c.DataInizio, c.DataFine, c.Premio, e.Organizzatore AS CentroIppico, ct.Nome AS Citta\n"
				."FROM Concorsi c JOIN Esterni e ON (c.CodConcorso=e.CodConcorso) JOIN Citta ct ON (e.CodCitta=ct.CodCitta);";
				$result=mysqli_query($conn,$s);
				if (mysqli_num_rows($result)){
			?>
					<table border="1" align="center">
						<tr>
							<td style="color: #FF9900;"><center>Codice concorso</center></td>
							<td style="color: #FF9900;"><center>Descrizione</center></td>
							<td style="color: #FF9900;"><center>Data inizio</center></td>
							<td style="color: #FF9900;"><center>Data fine</center></td>
							<td style="color: #FF9900;"><center>Premio</center></td>
							<td style="color: #FF9900;"><center>Centro ippico</center></td>
							<td style="color: #FF9900;"><center>Citt&#224;</center></td>
						</tr>
			<?php
						while($row=mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td><center>".$row['CodConcorso']."</center></td>";
								echo "<td><center>".$row['Desc']."</center></td>";
								echo "<td><center>".$row['DataInizio']."</center></td>";
								echo "<td><center>".$row['DataFine']."</center></td>";
								echo "<td><center>".$row['Premio']."</center></td>";
								echo "<td><center>".$row['CentroIppico']."</center></td>";
								echo "<td><center>".$row['Citta']."</center></td>";
							echo "</tr>";
						}
					echo "</table>";
				}
				?>
		</div>
	</body>
</html>
