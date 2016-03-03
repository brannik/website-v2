<?php
	include '../config/connect.php';
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DB);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$BROADCAST_TEXT_QUERY = "SELECT text FROM announce";
	$RESULTS = $conn->query($BROADCAST_TEXT_QUERY);
	if($RESULTS){
		foreach($RESULTS as $BText){
			$TEXT = $BText['text'];
		}
	}
	echo '<link rel="stylesheet" type="text/css" href="../core/styles/brc_scroll_text.css">';
	echo '<div class="scroll-slow">';
	echo '<p>'. $TEXT .'</p>';
	echo '</div>';
	$conn->close();
?>