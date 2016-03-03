<?php
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	echo '<link rel="stylesheet" type="text/css" href="../core/styles/forum.css">';
	//$conn = new mysqli($HOST,$USERNAME,$PASSWORD,$DB);
	$QUERY = "SELECT * FROM forum";
	$RESULT = $conn->query($QUERY);
	$GMLevelAuthor;
	if(ISSET($_GET['forumid'])){
		if(ISSET($_GET['replyto'])){
			echo '<div style="background-color: #333;">Reply to forum with ID:'.$_GET['replyto'];
				echo '<br><input type="text" name="titleTextAns" id="titleTextAns"></input>';
				echo '<br><input type="textarea" name="TextAns" id="TextAns"></input>';
				echo '<br><a href="#">Post</a>';
			echo '</div>';
		}
		
		echo '<a href="'.$DOMAIN.'core/forum.php?back=true" target="MainFrame">&nbsp;Back</a>';
		
		$SQL_GET_POSTS = "SELECT * FROM forum_posts WHERE forum_id='". $_GET['forumid'] ."'";
		$POSTS_RES = $conn->query($SQL_GET_POSTS);
		if($POSTS_RES){
			// count posts
			// max 5-7 posts to page
			// generate array with posts id's => page
			// show posts
			// generate footer with page numbers
			//page numb =>   post_numb => post_id 
			$posts_num = $POSTS_RES->num_rows;
			if($posts_num > 7){
				if($posts_num%7 == 0){
					$pages_num = $posts_num/7;
				}else{
					$pages_num = $posts_num/7;
					$pages_num = $pages_num + 1;
				}
			}else{
				$pages_num = 1;
			}
			
			
			/*
			$pages = array(
				'1' => array('1' => 'id','2' => 'id','3' => 'id','4' => 'id','5' => 'id','6' => 'id','7' => 'id'),
				'2' => array()
			);
			*/
			$POSTS_RES_ID = "SELECT id FROM forum_posts WHERE forum_id='". $_GET['forumid'] ."'";
			$ID_RESULT = $conn->query($POSTS_RES_ID);
			$pages = array();
			for($i=0;$i<$pages_num;$i++){
				$new_arr = array();
				for($y=0;$y<7;$y++){
					// get_row()
					$row = $ID_RESULT->fetch_assoc();
					array_push($new_arr,$row['id']);					
				}
				array_push($pages, $new_arr);
			}
			if(ISSET($_GET['page'])){
				
				echo '&nbsp;<a href="'.$DOMAIN.'core/forum.php?forumid='.$_GET['forumid'].'&replyto='.$_GET['forumid'].'">Answer</a><br>';
				
				$FindPage = $_GET['page'];
				$FindPage = $FindPage - 1;
				foreach($pages[$FindPage] as $post_id){
					if($post_id){
						$GET_POST = "SELECT * FROM forum_posts WHERE id='". $post_id ."'";
						$RETURN_POST = $conn->query($GET_POST);
						$post_data = $RETURN_POST->fetch_assoc();
						echo '<div class="replyForum"><table class="replyTable">';
						echo '<tr id="replyTitle"><td><text>'.$post_data['title'].'</text></td></tr>';
						echo '<tr id="replyText"><td><txet>'.$post_data['text'].'</text></td></tr>';
						echo '<tr id="replyAutor"><td>by:&nbsp;'. $post_data['autor'].'&nbsp;posted on:&nbsp;'.$post_data['date'].'</td></tr>';
						echo '</table></div><br>';
					}
				}				
			}else{
				// display 1-st page
				
				echo '&nbsp;<a href="'.$DOMAIN.'core/forum.php?forumid='.$_GET['forumid'].'&replyto='.$_GET['forumid'].'">Answer</a><br>';
				
				foreach($pages[0] as $post_id){
					if($post_id){
						$GET_POST = "SELECT * FROM forum_posts WHERE id='". $post_id ."'";
						$RETURN_POST = $conn->query($GET_POST);
						$post_data = $RETURN_POST->fetch_assoc();
						echo '<div class="replyForum"><table class="replyTable">';
						echo '<tr id="replyTitle"><td><text>'.$post_data['title'].'</text></td></tr>';
						echo '<tr id="replyText"><td><text>'.$post_data['text'].'</text></td></tr>';
						echo '<tr id="replyAutor"><td>by:&nbsp;'. $post_data['autor'].'&nbsp;posted on:&nbsp;'.$post_data['date'].'</td></tr>';
						echo '</table></div><br>';
					}
				}
			}
			// pages numbers + links
			echo '<br>';
			for($u=0;$u<$pages_num-1;$u++){
				$NUMB = $u+1;
				echo '<a href="'.$DOMAIN.'core/forum.php?forumid='.$_GET['forumid'].'&page='.$NUMB.'">&nbsp;'.$NUMB.'&nbsp;</a>';
			}
		}
	}else{
		if($RESULT){
			foreach($RESULT as $row){
				$CHECK = "SELECT permission FROM account WHERE username='" . $row["autor"] ."'";
				$RESULT2 = $conn->query($CHECK);
				if($RESULT2){
					foreach($RESULT2 as $row2){
						$GMLevelAuthor = $row2["permission"];
					}
				}
				echo '<form id="ForumForm">';
				echo '<table>';
					echo '<tr>';
						if($GMLevelAuthor != 3){
							echo '<td rowspan="3"><img class="noAdmin" src="'. $row["image_url"] .'"/></td>';
						}
						if($GMLevelAuthor == 3){
							echo '<td rowspan="3"><img class="admin" src="'. $row["image_url"] .'"/></td>';
						}
						echo '<td id="TitleRow"><a href="'.$DOMAIN.'core/forum.php?forumid='.$row['id'].'" target="MainFrame">'. $row["title"] .'&nbsp;(Click to read)</a></td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td id="DescrCell">' . $row["description"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td id="BottomCell">'. $row["autor"] . '&nbsp;&nbsp;'. $row["date"] . '&nbsp;&nbsp;&nbsp;&nbsp;'. $row["posts"] .' posts</td>';
					echo '</tr>';
				echo '</table>';
				echo '</form>';
			}
		}
	}
	$conn->close();
?>