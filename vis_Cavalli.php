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
			<h1 class="head">I nostri cavalli</h1>
			<?php
				require("connect.php");
				$sql = "SELECT Nome\n"
				."FROM CentriIppici";
				$resultsql=mysqli_query($conn,$sql);
				if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
			<form action="vis_Cavalli.php" method="post">
				Seleziona il centro ippico <br>
				<select name="select">
					<option value="tutti">Tutti
					<?php
						while ($row1=mysqli_fetch_array($resultsql)){
					?>
					<option>
					<?php
						echo $row1['Nome'];
						}
					?>
				</select>
				<input type="submit" value="Invio" name="invio">
			</form>
			<?php
				} else {
					$select=$_POST['select'];
					$s = "";
					if ($select=="tutti"){
						$s = "SELECT c.Nome, c.Razza, c.AnnoNascita, c.Tipo\n"
						."FROM Cavalli c JOIN CentriIppici ci ON (c.CentroIppico=ci.Email);";}
					else{
						$s = "SELECT c.Nome, c.Razza, c.AnnoNascita, c.Tipo\n"
						."FROM Cavalli c JOIN CentriIppici ci ON (c.CentroIppico=ci.Email)\n"
						."WHERE ci.Nome='".$select."';";}
					$result = mysqli_query($conn,$s);
			?>
					<table border="1" align="center">
						<tr>
							<td style="color: #FF9900;"><center>Nome</center></td>
							<td style="color: #FF9900;"><center>Razza</center></td>
							<td style="color: #FF9900;"><center>Et&#224;</center></td>
							<td style="color: #FF9900;"><center>Specialit&#224; in gara</center></td>
						</tr>
			<?php
					$annocor=Date("Y");
					while($row=mysqli_fetch_array($result)){
						echo "<tr>";
							echo "<td><center>".$row['Nome']."</center></td>";
							echo "<td><center>".$row['Razza']."</center></td>";
							echo "<td><center>".$eta=$annocor-$row['AnnoNascita']."</center></td>";
							echo "<td><center>".$row['Tipo']."</center></td>";
						echo "</tr>";}
					echo "</table>";
			?>
			<br><a href="vis_Cavalli.php">Indietro</a>
			<?php
			}
			?>
		</div>
	</body>
</html>
