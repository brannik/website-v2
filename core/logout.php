<?php
 include '../core/login.php';
if(session_destroy()) // Destroying All Sessions
{
	?>
	<script>
		top.frames['MainFrame'].location.href = '../core/core.php';
		top.frames['navFrame'].location.href = '../core/navigation.php';
	</script>
	<?php
}
?>