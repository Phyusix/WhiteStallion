<html>
	<body>
		<link rel="stylesheet" href="s_sheet.css" type="text/css">
		<style>
			body{
				font-family: georgia, verdana;
				text-align: center;
			}
			h1.head{
				color: #FF9900;
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
			<?php
				require("connect.php");
				$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
				$r_city=mysqli_query($conn,$city);
				if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
			<h1 class="head">Registrati</h1>
			<form name="reg" action="registration.php" method="post">
				<p><h4>Codice Fiscale <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="codfisc"></p>
				<p><h4>Nome <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="nome"></p>
				<p><h4>Cognome <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="cognome"></p>
				<p><h4>Nato il <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="date" name="datan"></p>
				<p><h4>Risiedo a <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<select name="risiede">
					<?php
						while ($row=mysqli_fetch_array($r_city)){
					?>
					<option value="<?php echo $row['CodCitta'];?>">
					<?php
						echo $row['Nome'].", (".$row['Provincia'].")";
						}
					?>
				</select><br>
				Se la tua citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.
				<p><h4>Indirizzo <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="ind"></p>
				<p><h4>CAP <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="CAP"></p>
				<p><h4>E-mail <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="email"></p>
				<p><h4>Telefono</h4>
				<input type="text" name="tel"></p>
				<p><h4>Password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="password" name="psw"></p>
				<p><h4>Conferma password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="password" name="psw2"></p>
				<p>
				<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
				<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
			</form>
			<?php
				} else {
					$codfisc=$_POST['codfisc'];
					$nome=$_POST['nome'];
					$cogn=$_POST['cognome'];
					$datan=$_POST['datan'];
					$risiede=$_POST['risiede'];
					$ind=$_POST['ind'];
					$cap=$_POST['CAP'];
					$email=$_POST['email'];
					$tel=$_POST['tel'];
					$psw=$_POST['psw'];
					$psw2=$_POST['psw2'];
					if(!$codfisc or !$nome or !$cogn or !$datan or !$risiede or !$ind or !$cap or !$email or !$psw or !$psw2 or ($psw!=$psw2)){
			?>
			<h1 class="head">Registrati</h1>
			<form action="registration.php" method="post">
				Controlla di aver inserito i dati obbligatori e di averli inseriti corretti!
				<p><h4>Codice Fiscale <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="codfisc" value="<?php echo $codfisc;?>"</p>
				<p><h4>Nome <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="nome" value="<?php echo $nome;?>"></p>
				<p><h4>Cognome <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="cognome" value="<?php echo $cogn;?>"></p>
				<p><h4>Nato il <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="date" name="datan" value="<?php echo $datan;?>"></p>
				<p><h4>Risiedo a <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<select name="risiede">
					<?php
						$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
						$r_city=mysqli_query($conn,$city);
						while ($row=mysqli_fetch_array($r_city)){
					?>
					<option value="<?php echo $row['CodCitta'];?>">
					<?php
						echo $row['Nome'].", (".$row['Provincia'].")";
						}
					?>
					<option value="altro">Altro
				</select><br>
				Se la tua citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.
				<p><h4>Indirizzo <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="ind" value="<?php echo $ind;?>"></p>
				<p><h4>CAP <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="CAP" value="<?php echo $cap;?>"></p>
				<p><h4>E-mail <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
				<input type="text" name="email" value="<?php echo $email;?>"></p>
				<p><h4>Telefono</h4>
				<input type="text" name="tel" value="<?php echo $tel;?>"></p>
			<?php
						if ($psw!=$psw2){
							echo "Le password inserite devono essere uguali!";
			?>
							<p><h4>Password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
							<input type="password" name="psw" value="<?php echo $psw;?>"></p>
							<p><h4>Conferma password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
							<input type="password" name="psw2" value="<?php echo $psw2;?>	"></p>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
			<?php
						} else {
			?>
							<p><h4>Password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
							<input type="password" name="psw" value="<?php echo $psw;?>"></p>
							<p><h4>Conferma password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
							<input type="password" name="psw2" value="<?php echo $psw2;?>"></p>
							<p>
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
							<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
			<?php
						}
			?>
			</form>
			<?php
					} else {
						$etrovato=false;
                        $ctrovato=false;
                        $query="SELECT CodiceFiscale, Email FROM UtentiRegistrati;";
                        $r_query=mysqli_query($conn,$query);
                        while ($row=mysqli_fetch_array($r_query)){
							if($row['Email']==$email){
                                $etrovato=true;
							}
                            if($row['CodiceFiscale']==$codfisc){
                                $ctrovato=true;
                            }
                        }
                        if ($etrovato or $ctrovato){
							if($etrovato){
								echo "L'indirizzo e-mail inserito &#232 gi&#224 utilizzato. Inserisci nuovamente anche la citt&#224 di nascita e di residenza";
							}
							if($ctrovato){
								echo "Codice Fiscale gi&#224 utilizzato. Inserisci nuovamente anche la citt&#224 di nascita e di residenza";
							}
			?>
							<form name="reg" action="registration.php" method="post">
								<p><h4>Codice Fiscale <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="text" name="codfisc" value="<?php echo $codfisc;?>"</p>
								<p><h4>Nome <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="text" name="nome" value="<?php echo $nome;?>"></p>
								<p><h4>Cognome <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="text" name="cognome" value="<?php echo $cogn;?>"></p>
								<p><h4>Nato il <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="date" name="datan" value="<?php echo $datan;?>"></p>
								<p><h4>Risiedo a <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<select name="risiede">
									<?php
										$city="SELECT CodCitta, Nome, Provincia FROM Citta;";
										$r_city=mysqli_query($conn,$city);
										while ($row=mysqli_fetch_array($r_city)){
									?>
									<option value="<?php echo $row['CodCitta'];?>">
									<?php
										echo $row['Nome'].", (".$row['Provincia'].")";
										}
									?>
									<option value="altro">Altro
								</select><br>
								Se la tua citt&#224; non compare in questa lista, inseriscila <a href="creacitta.php" >qui</a>.
								<p><h4>Indirizzo <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="text" name="ind" value="<?php echo $ind;?>"></p>
								<p><h4>CAP <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="text" name="CAP" value="<?php echo $cap;?>"></p>
								<p><h4>E-mail <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="text" name="email" value="<?php echo $email;?>"></p>
								<p><h4>Telefono</h4>
								<input type="text" name="tel" value="<?php echo $tel;?>"></p>
								<p><h4>Password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="password" name="psw" value="<?php echo $psw;?>"></p>
								<p><h4>Conferma password <span style="color:#FF0000; font-size:10px">(campo obbligatorio)</span></h4>
								<input type="password" name="psw2" value="<?php echo $psw2;?>"></p>
								<p>
								<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
								<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
							</form>
			<?php	
						}else{
							$s1="INSERT INTO UtentiRegistrati (`CodiceFiscale`,`Nome`,`Cognome`,`DataNascita`,`Risiede`,`CAP`,`Indirizzo`,`Email`,`NumTel`,`Password`)\n"
							."VALUES ('".$codfisc."','".$nome."','".$cogn."','".$datan."','".$risiede."','".$cap."','".$ind."','".$email."',NULL,MD5('$psw'));";
							$s2="INSERT INTO UtentiRegistrati (`CodiceFiscale`,`Nome`,`Cognome`,`DataNascita`,`Risiede`,`CAP`,`Indirizzo`,`Email`,`NumTel`,`Password`)\n"
							."VALUES ('".$codfisc."','".$nome."','".$cogn."','".$datan."','".$risiede."','".$cap."','".$ind."','".$email."','".$tel."',MD5('$psw'));";
							if ($tel){
								$result=mysqli_query($conn,$s2);
							}else{
								$result=mysqli_query($conn,$s1);
							}
							if (mysqli_affected_rows($conn)>0){
								echo "La registrazione &egrave; andata a buon fine. I dati sono stati inseriti correttamente.";
							}else{
								echo "Hai meno di 7 anni e quindi non puoi registrarti!";
							}
						}
					}
				}
			?>
		</div>
	</body>
</html>
