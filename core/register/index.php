<?php
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	$msg = "Error: ";
	if(ISSET($_POST['register'])){
		$field_username = strtolower($_POST['username']);
		$field_password = strtolower($_POST['password']);
		$field_password_check = strtolower($_POST['password_check']);
		$USERNAME_UPPER = strtoupper($field_username);
		$SHA_PASS_HASH = SHA1(strtoupper($field_username).':'.strtoupper($field_password));
		
		if($field_username != "" && $field_password != "" && $field_password_check != ""){
			// registraciq
			if($field_password == $field_password_check){
				$sql_check_exsisting = "SELECT * FROM account WHERE username='" . $USERNAME_UPPER . "'";
				$result = mysqli_query($conn_auth,$sql_check_exsisting);
				if($result){
					if(mysqli_num_rows($result) != 0){
						$msg = $msg . " That account exsist \n" . $conn_auth->error;
					}
					else{
						// nqma nameren takuv account -> continue				
						// SOAP registration
						
						define('SOAP_IP', $HOST);
						define('SOAP_PORT', $SOAP_PORT);
						define('SOAP_USER', $SOAP_USER);
						define('SOAP_PASS', $SOAP_PASS);
						function executeSoapCommand($command){
							$soap = new SoapClient(NULL, Array(
								'location'   => 'http://'. SOAP_IP .':'. SOAP_PORT .'/',
								'uri'        => 'urn:TC',
								'style'      => SOAP_RPC,
								'login'      => SOAP_USER,
								'password'   => SOAP_PASS,
								'keep_alive' => false //keep_alive only works in php 5.4, but meh...
							));
    
							$result = $soap->executeCommand(new SoapParam($command, 'command'));
							return $result;
						}

						function createTcAccount($name, $password){
							if (!preg_match('/^[a-z0-9]{5,20}$/i', $name))
								throw new Exception('Invalid account name');
    
							if (!preg_match('/^[a-z0-9!"#$%]{8,16}$/i', $password))
								throw new Exception('Invalid password');
							return executeSoapCommand('account create '.$name.' '.$password);
						}

						try{
							$result = createTcAccount($field_username, $field_password);
							$result2 = executeSoapCommand('account set gmlevel '.$field_username. ' 0 -1');
							executeSoapCommand('saveall');
							$msg = $result . " " . $result2;
							/*
							$sql_get_info = "SELECT id FROM account WHERE username='" . $USERNAME_UPPER . "'";
							$info_result = $conn_auth->query($sql_get_info);
								foreach($info_result as $row_result){
									$ID = $row_result['id'];
									$conn->query("INSERT INTO account (id,username,permission,email,image,vote_points,donate_points) VALUES ('". $ID ."','". $field_username ."','0','','','','')");
								}
							*/
						}catch (Exception $e){
							$msg = $e->getMessage();
						}
						
					}
				}else{
					$msg = $msg . " Wrong confirmation password \n";
				}
			}else{
				$msg = $msg . "Connection error.";
			}
		}else{
			if($field_username == ""){
				$msg = $msg . " Username can't be empty \n";
			}
			if($field_password == ""){
				$msg = $msg . " Password can't be empty \n";
			}
			if($field_password_check == ""){
				$msg = $msg . " Password confirmation can't be empty \n";
			}
		}
	}
	if(ISSET($_POST['cancel'])){
		echo 'Cancelled!!!';
	}
	echo '<div id="container">';
		echo '<form method="post" action="">';
			echo '<table>';
				echo '<tr><td colspan="2">Resgistration</td></tr>';
				echo '<tr><td>Username:</td><td><input type="text" name="username"></input></td></tr>';
				echo '<tr><td>Password:</td><td><input type="password" name="password"></input></td></tr>';
				echo '<tr><td>Confirm password:</td><td><input type="password" name="password_check"></input></td></tr>';
				echo '<tr><td><input type="submit" value="Register" name="register"></td><td><input type="submit" value="Cancel" name="cancel"></td></tr>';
			echo '</table>';
			echo $msg;
		echo '</form>';
	echo '</div>';
?>