<?php
	include '../core/login.php';
	echo '<link rel="stylesheet" type="text/css" href="../core/styles/login.css">';
	echo'<div id="login">';
	echo'<form id="loginDeign" action="" method="post">';
	echo'<table>';
	echo'<tr><td><text>Username:&nbsp;</text></td>';
	echo'<td><input type="text" name="username" id="username"></td></tr>';
	echo'<tr><td><text>Pasword:&nbsp</text></td>';
	echo'<td><input type="password" name="password" id="password"></td></tr>';
	echo'<tr><td></td><td><input id="Btn" name="submit" type="submit" value="Login">';
	echo'<input type="submit" id="Btn" name="regBtn" value="Register"></td></tr>';
	echo'</table>';
	echo'</form>';
	echo'</div>';
?>