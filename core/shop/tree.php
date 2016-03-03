<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(function () {
    $('.toggle').click(function() {
        $(this).children('.sub').slideToggle();
    });
	$('.toggle a').click(function(event) {
        event.stopPropagation();
    });
	
	$('.toggleSub').click(function() {
        $(this).children('.subSub').slideToggle();
    });
	$('.toggleSub a').click(function(event) {
        event.stopPropagation();
    });
	
	$('.toggle .toggleSub').click(function(event) {
        event.stopPropagation();
    });	
});
</script>
<?php
	include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
	echo '<link rel="stylesheet" type="text/css" href="tree_style.css">';
	$QueryGetMainList = "SELECT * FROM tree_main";
	$MainMenu = $conn->query($QueryGetMainList);
	if($MainMenu){
		echo '<br><ul>';
		foreach($MainMenu as $MainItem){
			echo '<li class="toggle">'.$MainItem["text"];
			if($MainItem["submenu"] == 1){ // ako ima pod-menu
				$QuerySubMenu = "SELECT * FROM tree_sub WHERE child_of='". $MainItem["id"] ."'";
				$SubMenu = $conn->query($QuerySubMenu);
				if($SubMenu){
					echo '<ul class="sub">';
					foreach($SubMenu as $SubItem){
						if($SubItem["sub_id"]){ // ako ima pod-pod-menu
							echo '<li class="toggleSub">'.$SubItem["text"];
							$QueryGetSubSubMenu = "SELECT * FROM tree_sub_sub WHERE id='". $SubItem["sub_id"] ."'";
							$ThirdLevel = $conn->query($QueryGetSubSubMenu);
							if($ThirdLevel){
								echo '<ul class="subSub">';
								foreach($ThirdLevel as $ThirdLevelItem){
									echo '<li><a href="'.$DOMAIN.'core/shop/items.php?itemtype='. $SubItem["param"]. '' . $ThirdLevelItem["param"] .'" target="ItemsFrame">'.$ThirdLevelItem["text"].'</a></li>';
								}
								echo '</ul>';
							}
						}else{
							echo '<li><a href="'.$DOMAIN.'core/shop/items.php?itemtype='. $SubItem["param"] .'" target="ItemsFrame">'.$SubItem["text"].'</a></li>';
						}
					}
					echo '</li></ul>';
				}
			}
		}
		echo '</li></ul>';
	}
	
	//

?>