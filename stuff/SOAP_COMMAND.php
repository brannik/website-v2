
<?php	
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	define('SOAP_IP', $HOST);
	define('SOAP_PORT', $SOAP_PORT);
	define('SOAP_USER', $SOAP_USER);
	define('SOAP_PASS', $SOAP_PASS);
	if(ISSET($_POST['action'])){
		SOAPCommand($_POST['action']);
	}	
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
	function SOAPCommand($string){
		try{
			$result = executeSoapCommand($string);
			$msg = $result;
		}catch (Exception $e){
			$msg = $e->getMessage();
		}
		echo $msg;
	}
	
?>