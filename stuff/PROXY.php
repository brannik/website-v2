<?php
	$host = parse_url($_GET['url'], PHP_URL_HOST);
	$dir  = $_SERVER[DOCUMENT_ROOT].'/cache_proxy/'.$host;
	if(!is_dir($dir))
		mkdir($dir);
	$filepath = $dir.'/'.md5($_GET['url']);

	if(is_file($filepath)){
		include($filepath);

	}else{
		$page = file_get_contents($_GET['url']);

		$page = preg_replace('/(a href)=[\'\"](http.*)[\'\"]/', '$1="http://buy/proxy.php?url=$2"', $page);
		$page = preg_replace('/(a href)=[\'"][^http](.*)[\'"]/', '$1="http://buy/proxy.php?url=http://'.$host.'/$2"', $page);
		$page = preg_replace('/(href|src)=[\'"][^http+](.*)[\'"]/', '$1="http://'.$host.'/$2"', $page);

		file_put_contents($filepath, $page);

		echo $page;
	}
?>