<?php
include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
/*
$conn = new mysqli($HOST, $USERNAME, $PASSWORD,$DB_AUTH);
$conn2 = new mysqli($HOST, $USERNAME, $PASSWORD, $DB);
*/
$error=''; // Variable To Store Error Message
session_start(); // Starting Session
$gmlevel = -1;
$EMAIL = "";
if(isset($_POST['regBtn'])){
	session_destroy(); // Destroying All Sessions
	?>
	<script>
		top.frames['MainFrame'].location.href = '../core/register.php';
	</script>
	<?php
}

if(isset($_POST['logout'])){
	session_start();
	session_destroy(); // Destroying All Sessions
}

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
		echo'<text>Username or Password is invalid</text>';
	}else{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter

		// To protect MySQL injection for Security purpose
		// Selecting Database
		// SQL query to fetch information of registerd users and finds user match.
		// password encryption
		$PASSWORDSHA = SHA1(strtoupper($username).':'.strtoupper($password));
		// password encryption
		$query= "select * from account where sha_pass_hash='".$PASSWORDSHA."' AND username='" .$username ."'";
		$results = $conn_auth->query($query);
		$num_rows = mysqli_num_rows($results);
		if ($num_rows == 1) {
			$_SESSION['login_user']=$username; // Initializing Session
			$username_upper = strtoupper($_SESSION['login_user']);
			// check and update accounts
			/*
			$USER_STR_UP = strtoupper(strtolower($username));
			$sql_find = "SELECT id FROM account WHERE username='" . $USER_STR_UP . "'";
			$found = $conn_auth->query($sql_find);
			if($found){
				foreach($found as $founded){
					$ID = $founded['id'];
				}
				echo $ID;
			}
			// update
			// INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE name="A", age=19
			$USER_SRT_LOW = strtolower($username);
			//$SQL = "INSERT INTO account (id, username, permission) VALUES(". $ID . ",'". $USER_SRT_LOW . "', 0) ON DUPLICATE KEY UPDATE username = VALUES('". $USER_SRT_LOW ."'),permission = VALUES(0)";
			*/
			
			$username_upper = strtoupper($_SESSION['login_user']);
			$update_acc = "SELECT id FROM account WHERE username='".$username_upper."'";
			$result = $conn_auth->query($update_acc);
			$id=0;
			$GM = 0;
			$lower = strtolower($_SESSION['login_user']);
			$update_acc_final = "";
			if($result){
				foreach($result as $row){
					$id=$row["id"];
				}	
				$sql = "SELECT gmlevel FROM account_access WHERE id=" . $id;
				$RESULT_GMLEVEL = $conn_auth->query($sql);
				$count = mysqli_num_rows($RESULT_GMLEVEL);
				if($count != 0){
					foreach($RESULT_GMLEVEL as $GMLEVEL_RET){
						$GM = $GMLEVEL_RET["gmlevel"];
					}
				}else{
					$Prepare = "INSERT INTO account_access (id,gmlevel,RealmID) VALUES (". $id .",0,-1)";
					$conn_auth->query($Prepare);
				}
				$update_acc_final2 = "UPDATE account SET id='".$id."',permission='". $GM ."' WHERE username='" . $lower . "'";
				$update_acc_final = "INSERT INTO account (username,id,permission,email,image,vote_points,donate_points)  VALUES ('". $lower ."',". $id .",". $GM .",0,'default',0,0)";
				$conn->query($update_acc_final);
			}
			$conn->query($update_acc_final2);
			
			
			?>
			<script>
				top.frames['MainFrame'].location.href = '../core/core.php';
				top.frames['navFrame'].location.href = '../core/navigation.php';
			</script>
			<?php
			
		} else {
			$error = "Username or Password is invalid";
			?>
			<script>
				top.frames['MainFrame'].location.href = '../core/register.php';
			</script>
			<?php
		}
		

		
		$conn->close();
		$conn_auth->close();
		}
	}
?>