<?php
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	include $_SERVER['DOCUMENT_ROOT']."/core/login.php";
	$GMLEVEL = 3;
	$E_MAIL = "some_mail@gmail.com";
	$CUR_IP = "127.0.0.1";
	$LAST_IP = "127.0.0.1";
	$CHAR_COUNT = 2;
	$MONEY = "100g 23s 78c";
	$ACC_STATUS = "Active";
	$FORUM_TOPICS = 3;
	$FORUM_REPLYS = 0;
	$ACHIEVE_POINTS = 1200;
	$DATE_REG = "12.12.2015";
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo '<img src="profile.jpg"></img>';	
	echo '<table id="profileLayout">';
		echo '<tr><td>Username: </td><td>'. $_SESSION['login_user'] .'</td></tr>';
		echo '<tr><td>Rank: </td><td>'. $GMLEVEL .'</td></tr>';
		echo '<tr><td>e-mail: </td><td>'. $E_MAIL .'</td></tr>';
		echo '<tr><td>IP: </td><td>' . $CUR_IP . '</td></tr>';
		echo '<tr><td>last ip: </td><td>'. $LAST_IP .'</td></tr>';
		echo '<tr><td>count characters: </td><td>'. $CHAR_COUNT .'</td></tr>';
		echo '<tr><td>money: </td><td>'. $MONEY .'</td></tr>';
		echo '<tr><td>Status: </td><td>'. $ACC_STATUS .'</td></tr>';
		echo '<tr><td>Forum topics: </td><td>'. $FORUM_TOPICS .'</td></tr>';
		echo '<tr><td>Forum replys: </td><td>'. $FORUM_REPLYS .'</td></tr>';
		echo '<tr><td>Achievement points: </td><td>'. $ACHIEVE_POINTS .'</td></tr>';
		echo '<tr><td>registered on: </td><td>'. $DATE_REG .'</td></tr>';
	echo '</table>';
?>