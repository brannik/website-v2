<?php
	$DOMAIN = "http://www.localhost/";
	$HOST = "localhost";
	$USERNAME = "root";
	$PASSWORD = "ascent";
	$DB = "website";
	// server info
	$DB_AUTH = "auth";
	$DB_CHAR = "characters";
	$DB_WORLD = "world";
	// SOAP
	$SOAP_PORT = "7878";
	$SOAP_USER = "brannik";
	$SOAP_PASS = "123brannik456";
	// connections
	$conn = new mysqli($HOST,$USERNAME,$PASSWORD,$DB);
	$conn_auth = new mysqli ($HOST,$USERNAME,$PASSWORD,$DB_AUTH);
	$conn_world = new mysqli ($HOST,$USERNAME,$PASSWORD,$DB_WORLD);
	$conn_char = new mysqli ($HOST,$USERNAME,$PASSWORD,$DB_CHAR);
	// disconnect function
	/*
	function CONN_DESTRY_ALL($p){
		if($p == true){
			// close all connections
			if($conn){
				$conn->close();
			}
			if($conn_auth){
				$conn_auth->close();
			}
			if($conn_char){
				$conn_char->close();
			}
			if($conn_world){
				$conn_world->close();
			}
		}else{
			// some error
		}
	}
	*/
?>