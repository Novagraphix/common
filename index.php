<?php
	require_once 'inc/Twig/Autoloader.php';
	Twig_Autoloader::register();

	$loader = new Twig_Loader_Filesystem('templates');
	$twig = new Twig_Environment($loader, array(
		'cache' => 'cache',
		'auto_reload' => true
	));

	$base = 'http://172.31.1.61/testumgebung/an_ihrer_stelle/';
	if ($_SERVER["SERVER_NAME"]=='localhost'||$_SERVER["SERVER_NAME"]=='127.0.0.1') {
		$base = 'http://'.$_SERVER["SERVER_NAME"].'/repositories/common/';
	}

	$page = "index";
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
		if ($page == '') {
			$page = 'index';
		}
	}

	$tplfile = '/pages/index.html';
	if (isset($_GET["page"])) {
		$tplfile = '/pages/'.$page.'.html';
	}

	echo $twig->render($tplfile, array(
		'page' => $page,
		'base' => $base
	));

?>