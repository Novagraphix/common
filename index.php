<?php

/**
 * Variablen
 */

$base = ""; //http://www.film.de
$is_base = false;
$is_skel = true;

/**
 * Ende
 */

/**
 * findLatest: Methode um immer den letzten Stand einer Datei bei 
 * fortlaufender Nummerierung zu bekommen (beisp. PDFs)
 * 
 */
function findLatest($begin='', $ext='pdf') {
	$latest_ctime = 0;
	$latest_filename = '';
	$files = glob($begin.'*.'.$ext);
	// 
	foreach ( (array) $files as $filename ) {
		if(filectime($filename) > $latest_ctime){
			$latest_ctime = filectime ( $filename );
			$latest_filename = $filename;
		}
	}
	return $latest_filename;
}
/**
 * NEUE VERSION MIT TWIG, MONOLOG
 */
require 'vendor/autoload.php';

/**
 * ALTE VERSION NUR TWIG...MONOLOG EINTRÄGE IN DER INDEX.PHP ENTFERNEN
 */
//require 'inc/Twig/Autoloader.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
	'cache' => 'cache',
	'auto_reload' => true
));

use Monolog\Logger;
use Monolog\Handler\BrowserConsoleHandler;

// create a log channel
$log = new Logger('Novagraphix');
$log->pushHandler(new BrowserConsoleHandler());


if($is_base) {
	if ($_SERVER["SERVER_NAME"]=='localhost'||$_SERVER["SERVER_NAME"]=='127.0.0.1') {
		$base = 'http://'.$_SERVER["SERVER_NAME"].'/repositories/common/';
	}
}

$page = "index";
if (isset($_GET["page"])) {
	$page = $_GET["page"];
	if ($page == '') {
		$page = 'index';
	}
}

$log->addInfo('Aufgerufene Seite: '.$page);

$tplfile = '/pages/index.html';
if (isset($_GET["page"])) {
	$tplfile = '/pages/'.$page.'.html';
}

$releasedate = '2014-10-27';
$release = '';
if (strftime("%Y-%m-%d")>=$releasedate) {
	$release = '<span>Jetzt im Kino!</span>';
} else {
	$release = 'Ab <span>27.10.2014</span> im Kino';
}
$log->addInfo('Kinostart: '.$release);

echo $twig->render($tplfile, array(
	'page' => $page,
	'base' => $base,
	'is_skel' => $is_skel,
	'release' => $release,
	'startkinos' => findLatest('COMMON', 'pdf')
));

?>