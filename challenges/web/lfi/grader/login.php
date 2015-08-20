<?php
$login=@$_POST['login'];
$password=@$_POST['password'];
if(@$login=="admin" && sha1(@$password)==$pwhash){
	//don't bother logging in
	//try something else
}else if (@$login&&@$password&&@$_GET['debug']) {
	echo "Login error, login credentials has been saved to ./".htmlentities($login).".log";
	$logfile = "./".$login.".log";
	file_put_contents($logfile, $login."\n".$password);
} 
?>
	<center>
		login<br/><br/>
		<form action="" method="POST">
			<input name="login" placeholder="login"><br/>
			<input name="password" placeholder="password"><br/><br/>
			<input type="submit" value="Go!">
		</form>
	</center>

