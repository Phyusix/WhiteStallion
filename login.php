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
			a.centrale:link{
				font-size: 10px;
				color: #000000;
			}
			a.centrale:visited{
				font-size: 10px;
				color: #000000;
			}
		</style>
		<div id="central">
			<h1 class="head">Accedi</h1>
			<?php
				require("connect.php");
				if ($_SERVER['REQUEST_METHOD'] != 'POST'){
			?>
			<form action="login.php" method="post">
				<p><h3>Email</h3>
				<input type="text" name="Email"></p>
				<p><h3>Password</h3>
				<input type="password" name="Password"></p>
				<p>
				<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="submit" name="Invio" value="Invio">
				<input style="width:70px; height:35px; background: #FFCC99; font: italic georgia;" type="reset" name="Cancella" value="Cancella"></p>
			</form>
			<?php
				} else {
					$email=$_POST['Email'];
					$psw=$_POST['Password'];
					$enc_password=md5($psw);
					$s="SELECT CodiceFiscale, Email, Password FROM UtentiRegistrati WHERE Email='".$email."' AND Password='".$enc_password."';";
					$result=mysqli_query($conn,$s);
					$row=mysqli_fetch_array($result);
					if ($row){
						$codfiscale=$row['CodiceFiscale'];
						$s1="SELECT CodAg FROM Agonistici WHERE CodAg="."'$codfiscale'".";";
                        $result1=mysqli_query($conn,$s1);
						if(mysqli_num_rows($result1)!=0){
							$permessi="agonistici";
							session_start();
							$_SESSION['utente']=$codfiscale;
							$_SESSION['permessi']=$permessi;
							
			?>
									<a class="centrale" href="agonistici.php" target="_top">Accedi alla tua area riservata</a>
			<?php
						}else{
							$s1="SELECT CodMF FROM MezzaFida WHERE CodMF="."'$codfiscale'".";";
							$result1=mysqli_query($conn,$s1);
							if(mysqli_num_rows($result1)!=0){
								$permessi="mezzafida";
								session_start();
								$_SESSION['utente']=$codfiscale;
								$_SESSION['permessi']=$permessi;
								
			?>
									<a class="centrale" href="mezzafida.php" target="_top">Accedi alla tua area riservata</a>
			<?php
							}else{
								$s1="SELECT CodAmm FROM Amministratori WHERE CodAmm="."'$codfiscale'".";";
								$result1=mysqli_query($conn,$s1);
								if(mysqli_num_rows($result1)!=0){
									$permessi="amministratori";
									session_start();
									$_SESSION['utente']=$codfiscale;
									$_SESSION['permessi']=$permessi;
									
			?>
									<a class="centrale" href="amministratori.php" target="_top">Accedi alla tua area riservata</a>
			<?php							
								}else{
									$s1="SELECT CodIstr FROM Istruttori WHERE CodIstr="."'$codfiscale'".";";
									$result1=mysqli_query($conn,$s1);
									if(mysqli_num_rows($result1)!=0){
										$permessi="istruttori";
										session_start();
										$_SESSION['utente']=$codfiscale;
										$_SESSION['permessi']=$permessi;
										
			?>
									<a class="centrale" href="istruttori.php" target="_top">Accedi alla tua area riservata</a>
			<?php
									}else{
										$s1="SELECT CodAllievo FROM Allievi WHERE CodAllievo="."'$codfiscale'".";";
										$result1=mysqli_query($conn,$s1);
										if(mysqli_num_rows($result1)!=0){
											$permessi="allievi";
										}else{
											$s1="SELECT CodDip FROM Dipendenti WHERE CodDip="."'$codfiscale'".";";
											$result1=mysqli_query($conn,$s1);
											if(mysqli_num_rows($result1)!=0){
												$permessi="stallieri";
											}else{
												$permessi="utentiregistrati";
											}
										}
										session_start();
										$_SESSION['utente']=$codfiscale;
										$_SESSION['permessi']=$permessi;
			?>
									<a class="centrale" href="utentiregistrati.php" target="_top">Accedi alla tua area riservata</a>
			<?php
									}
								}
							}
						}
					}else{
			?>
					<h5>Username e/o password errati!</h5>
					<a class="centrale" href="login.php">Torna alla pagina di login</a>
			<?php	
					}
				}
			?>
		</div>
	</body>
</html>
