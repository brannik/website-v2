<?php
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	echo '<link rel="stylesheet" type="text/css" href="../core/styles/core.css">';
	$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DB);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$QUERY = "SELECT title,text,date,autor FROM news ORDER BY id DESC";
		$RESOULT = $conn->query($QUERY);
		if($RESOULT){
			foreach($RESOULT as $row){
				echo '<form>';
					echo '<table id="tableNews">';
						echo '<tr><td id="titleData" colspan="2"><h1 id="custom">'. $row["title"] .'</h1></tr>';
						echo '<tr><td id="textData" colspan="2">'. $row["text"] .'</td></tr>';
						echo '<tr><td id="dateData">'. $row["date"] .'</td><td id="autorData">by: '. $row["autor"] .'</td></tr>';
					echo '</table>';
				echo '</form>';
			}
		}else{
			echo 'Wrong resoults';
		}
	} 
?>