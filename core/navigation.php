
<?php
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	include $_SERVER['DOCUMENT_ROOT']."/core/login.php";
	echo '<link rel="stylesheet" type="text/css" href="../core/styles/navigation/navigation.css">';
	//$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DB);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$Username = "Guest";
	$IsLoggedIn = false;
	$GMLevel = -1;
	$Mails = 0;
	$VP =0;
	$DP=0;
	if(isset($_SESSION['login_user'])){
			$IsLoggedIn = true;
			$Username = $_SESSION['login_user'];
			$SQL_INFO = "SELECT * FROM account WHERE username='" . $Username . "'";
			$Username = ucfirst($_SESSION['login_user']);
			$INFO = $conn->query($SQL_INFO);
			if($INFO){
				foreach($INFO as $row_info){
					$DP = $row_info['donate_points'];
					$VP = $row_info['vote_points'];
					$GMLevel = $row_info['permission'];
					$SQL_MAIL = "SELECT * FROM mail WHERE reciever_id='" . $row_info['id'] . "' and readen='0'" ;
					$MAILBOX = $conn->query($SQL_MAIL);
					if($MAILBOX){
						$Mails = $MAILBOX->num_rows;
					}else{
						$Mails = 0;
					}
				}
			}
	}else{
			$IsLoggedIn = false;
	}
	
	 
	$QUERY = "SELECT text,permission,link,target FROM menu ORDER BY permission ASC";
	$RESOULT = $conn->query($QUERY);
	echo '<div id="menu">';
	echo '<div id="mainMenuDiv"><ul id="MenuList">';
	if($RESOULT){
		foreach($RESOULT as $row){
			if($GMLevel >= $row['permission']){
				echo '<li><a href="'. $DOMAIN .''. $row["link"] .'" target="'. $row["target"] .'">'. $row["text"] .'</a></li>';
			}
		}
	}else{
		echo 'Wrong resoults';
	}
	echo '</ul></div>';
	if($IsLoggedIn){
		echo '<div id="statusDiv"><ul id="stUL">';
			echo'<li><a href="'.$DOMAIN.'core/logout.php">Logout</a></li>';
			if($Mails!= 0){
				echo'<li><a href="'.$DOMAIN.'core/mailbox/index.html" target="MainFrame"><text class="waitingForConnection">Mailbox('. $Mails .')</text></a></li>';
			}else{
				echo'<li><a href="'.$DOMAIN.'core/mailbox/index.html" target="MainFrame">Mailbox('. $Mails .')</a></li>';
			}
			echo'<li><a href="'.$DOMAIN.'core/shop/shop_index.html" target="MainFrame"><img src="../resources/icons/money-gold.gif" height="13" width="13">('. $DP .')&nbsp;<img src="../resources/icons/money-silver.gif" height="13" width="13">('. $VP .')</a></li>';
			$SQL_PERM = "SELECT permission FROM account WHERE username='" . $_SESSION['login_user'] . "'";
			$GET_PERM = $conn->query($SQL_PERM);
			if($GET_PERM){
				foreach($GET_PERM as $permission_level){
					$GMLevel = $permission_level['permission'];
				}
			}
			if($GMLevel == 0){
				echo'<li><a href="'.$DOMAIN.'core/account/index.html" target="MainFrame"><strong>'. $Username .'</strong></a></li>';
			}
			if($GMLevel == 1){
				echo'<li><a href="'.$DOMAIN.'core/account/index.html" target="MainFrame" class="donor"><strong>'. $Username .'</strong></a></li>';
			}
			if($GMLevel == 2){
				echo'<li><a href="'.$DOMAIN.'core/account/index.html" target="MainFrame" class="gm"><strong>'. $Username .'</strong></a></li>';
			}
			if($GMLevel == 3){
				echo'<li><a href="'.$DOMAIN.'core/account/index.html" target="MainFrame" class="admin"><strong>'. $Username .'</strong></a></li>';
			}
		echo '</ul></div>';
	}else{
		echo '<div id="statusDiv"><ul id="stUL">';
			echo'<li><a href="../core/loginUI.php" target="MainFrame">Login</a></li>';
			echo'<li><a href="../core/register.php" target="MainFrame">Register</a></li>';
		echo '</ul></div>';
	}
	echo '</div>'; // menu
	$conn->close();
?>