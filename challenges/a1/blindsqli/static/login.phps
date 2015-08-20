<?php
include "config.php";
$con = mysqli_connect($MYSQL_HOST, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DB);
$username = mysqli_real_escape_string($con, $_POST["username"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) === 1) {
	$row = mysqli_fetch_array($result);
	echo "<h1>Logged in!</h1>";
	echo "<p>Your flag is: $FLAG</p>";
} else {
	echo "<h1>Login failed.</h1>";
}
?>

