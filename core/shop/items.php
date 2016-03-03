<script type="text/javascript" src="//wow.zamimg.com/widgets/power.js"></script><script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript" language="javascript">

function buttonClicked(ITEM_ID,PRICE,COST_TYPE,ITEM_NAME){
	var txt;
	var price_text;
	var char_opt = document.getElementById("SelChar")
	if( char_opt.options[char_opt.selectedIndex].text != "Select char"){
		var t = document.getElementById("SelChar");
		var RECIEVER = t.options[t.selectedIndex].text;	
		if(COST_TYPE == 1){
			price_text = "Vote Points";
		}
		if(COST_TYPE == 2){
			price_text = "Donor Points";
		}
		if(COST_TYPE != 3){
			var r = confirm("About to buy " + ITEM_NAME + " - " + ITEM_ID + " for " + PRICE + " " + price_text + " to " + RECIEVER);
			if (r == true) {
				command = 'send items ' + RECIEVER + ' "Congratz" "This is your pruchased item from frostmourne-wow webpage" ' + ITEM_ID;
				$.ajax({ 
					url: 'items.php',
					data: {
						action: command,
						discount: PRICE,
						disc_type: COST_TYPE
						},
					type: 'POST',
					success: function(output) {
						alert(output);
					}
				});
			
			} else {
				txt = "Item is not send!";
				alert(txt);
				//var prep_command = "error";
			}
		}else{
			alert("Item " + ITEM_NAME + " is not aviable!!!");
		}
	}else{
		alert("Pleace select character!");
	}
}

</script>

<?php
	echo '<link rel="stylesheet" type="text/css" href="itemsTable.css">';
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	include $_SERVER['DOCUMENT_ROOT']."/core/login.php";
	define('SOAP_IP', $HOST);
	define('SOAP_PORT', $SOAP_PORT);
	define('SOAP_USER', $SOAP_USER);
	define('SOAP_PASS', $SOAP_PASS);
	if(ISSET($_POST['action'])){
		$PRICE_TO_REMOVE = $_POST['discount'];
		$PRICE_TO_REMOVE_TYPE = $_POST['disc_type'];
		$SQL_GET_POINTS = "SELECT vote_points,donate_points FROM account WHERE username='". strtolower($_SESSION['login_user']) ."'";
		$GOT_POINTS = $conn->query($SQL_GET_POINTS);
		if($GOT_POINTS){
			if($PRICE_TO_REMOVE_TYPE == 1){
				// votepoints
				foreach($GOT_POINTS as $VPOINTS){
					if($VPOINTS['vote_points'] >= $PRICE_TO_REMOVE){
						$DISCO = $VPOINTS['vote_points'] - $PRICE_TO_REMOVE;
						$SQL_UPDATE = "UPDATE account SET vote_points='".$DISCO."' WHERE username='".strtolower($_SESSION['login_user'])."'";
						$conn->query($SQL_UPDATE);
						SOAPCommand($_POST['action']);
					}
				}
				
			}
			if($PRICE_TO_REMOVE_TYPE == 2){
				// donor_points
				foreach($GOT_POINTS as $DPOINTS){
					if($DPOINTS['donate_points'] >= $PRICE_TO_REMOVE){
						$DISCO = $DPOINTS['donate_points'] - $PRICE_TO_REMOVE;
						$SQL_UPDATE = "UPDATE account SET donate_points='".$DISCO."' WHERE username='".strtolower($_SESSION['login_user'])."'";
						$conn->query($SQL_UPDATE);
						SOAPCommand($_POST['action']);
					}
				}
			}
			if($PRICE_TO_REMOVE_TYPE == 3){
				// no price
			}
		}
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
	function SOAPCommand($string,$discount,$disc_type){
		try{
			$result = executeSoapCommand($string);
			$msg = $result;
		}catch (Exception $e){
			$msg = $e->getMessage();
		}
		echo $msg;
	}
	//$conn = new mysqli($HOST,$USERNAME,$PASSWORD,$DB);
	
	$AccountID = 0;
	/*
	$conn_auth = new mysqli($HOST,$USERNAME,$PASSWORD,$DB_AUTH);
	$conn_char = new mysqli($HOST,$USERNAME,$PASSWORD,$DB_CHAR);
	*/
	$UserNameUpper = strtoupper($_SESSION['login_user']);
	
	$query_auth = "SELECT id FROM account WHERE username='" . $UserNameUpper ."'";
	$result = $conn_auth->query($query_auth);
	if($result){
		foreach($result as $AccID){
			$AccountID = $AccID["id"];
		}
	}
	$query_chars = "SELECT name,guid FROM characters WHERE account='" . $AccountID . "'";
	$result_char = $conn_char->query($query_chars);
	
	echo '<link rel="stylesheet" type="text/css" href="shop.css">';
	echo '<ul>';
		echo '<li><text>Select Character:&nbsp;</text>';
			echo '<select id="SelChar" name="SelChar">';
			echo '<option selected="true" style="display:none;">Select char</option>';
				if($result_char){
					foreach($result_char as $row_char){
						echo '<option class="optionS" value="'. $row_char["guid"] .'">'. $row_char["name"] .'</option>';
					}
				}
			echo '</select>';
		echo '</li>';
	echo '</ul>';
	$conn_auth->close();
	$conn_char->close();
	if(ISSET($_GET['itemtype'])){
		$ItemTypeToShow = $_GET['itemtype'];
		$SQL = "SELECT * FROM shop WHERE type='".$ItemTypeToShow."'";
		$RESULT = $conn->query($SQL);	
			if($RESULT){
			echo '<form method="POST">';
			echo '<table id="ItemsTable">';
				echo '<tr id="title"><td id="ItemID">Item ID</td><td id="ItemName">Item Name</td><td id="Price">Price</td><td id="Buttons">Send</td></tr>';
				$iter = 1;
				$CostType = 0;
				foreach($RESULT as $row){
					if($row["price_vp"] == 0 && $row["price_dp"] == 0){
						$PRICE = "None";
						$CostType = 3;
						$PRICE_TO_SEND = "None";
					}
					if($row["price_vp"] == 0 && $row["price_dp"] != 0){
						$PRICE = $row["price_dp"] . " DP";
						$PRICE_TO_SEND = $row["price_dp"];
						$CostType = 2;
					}
					if($row["price_vp"] != 0 && $row["price_dp"] == 0){
						$PRICE = $row["price_vp"] . " VP";
						$PRICE_TO_SEND = $row["price_vp"];
						$CostType = 1;
					}
	
					$StringToSend = "'" . $row["item_id"] . "','" . $PRICE_TO_SEND . "','" . $CostType . "','" . $row["name"] . "'";
					if($iter%2 != 0){
						// RECIEVER,ITEM_ID,PRICE,COST_TYPE,ITEM_NAME
						echo '<tr id="rowN"><td id="ItemID">['.$row["item_id"].']</td><td id="ItemName">
						<a href="//www.wowhead.com/item='. $row["item_id"] .'" class="q'. $row["quality"] .'">'. $row["name"] .'</a>
						</td><td id="Price">'. $PRICE .'</td><td id="Buttons"><input type="submit" class="btn" value="Buy" onclick="buttonClicked('. $StringToSend .'); "></td></tr>';
					}else{
						echo '<tr id="rowC"><td id="ItemID">['.$row["item_id"].']</td><td id="ItemName">
						<a href="//www.wowhead.com/item='. $row["item_id"] .'" class="q'. $row["quality"] .'">'. $row["name"] .'</a>
						</td><td id="Price">'. $PRICE .'</td><td id="Buttons"><input type="submit" class="btn" value="Buy" onclick="buttonClicked('. $StringToSend .'); "></td></tr>';	
					}
					$iter++;
				}
			echo '</table>';
			echo '</form>';
			}
	}else{
		echo '<text style="font-size: 30px; margin-left: 300px; margin-top: 50px;">Select item type</text>';
	}
	$conn->close();
?>

