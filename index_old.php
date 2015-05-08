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
function getCurrentUrlDir($full = true) {
	$dev = ($_SERVER["SERVER_NAME"]=='localhost' || $_SERVER["SERVER_NAME"]=='127.0.0.1' || $_SERVER["SERVER_NAME"]=='172.31.1.62') ? '' : '_dev/';
	$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$url .= $_SERVER['SERVER_NAME'];
	$url .= htmlspecialchars($_SERVER['REQUEST_URI']);
	return (($url)) . "/" .$dev;
}
function isLocalhost(){
	if(stristr($_SERVER["SERVER_ADDR"], 'localhost')) {
		return true;
	}
	return false;
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

/**
 * PDF-Linker
 */

function findLatest($type='', $ext='pdf') {
	
$log = new Logger('Novagraphix');
$log->pushHandler(new BrowserConsoleHandler());
	$latest_ctime = 0;
	$latest_filename = '';
	foreach (glob('media/pdf/'.$type.'/*.'.$ext) as $filename) {
		if(filectime($filename) > $latest_ctime){
			$latest_ctime = filectime ( $filename );
			$latest_filename = $filename;
		}
	}
	$log->addInfo('PDF-Linker ('.$type .'): ' .$latest_filename);
	return $latest_filename;
}
/**
 * -- PDF-Linker - END
 */


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

$tplfile = '/pages/home.html';
if (isset($_GET["page"])) {
	$tplfile = '/pages/'.$page.'.html';
}

$releasedate = '2015-10-27';
$release = '';
if (strftime("%Y-%m-%d")>=$releasedate) {
	$release = '<span>Jetzt im Kino!</span>';
} else {
	$release = 'Ab <span>27.10.2015</span> im Kino';
}
$log->addInfo('Kinostart: '.$release);
/**
 * [$config description]
 * @var array
 */
$config = array(
	'page' => $page,
	'base' => $base,	
	// 'mobile_nav' => 'scotchpanel',
	'mobile_nav' => 'skel-layers',
	'release' => $release,
	'pdf_buttons' => array(
		'startkinos' => findLatest('startkinos', 'pdf')
	),
	/**
	 * Facebook-Opengraph
	 */
	'fb_img' => '', // pfad zu einem quadratischem Bild mit mindestens 250x250px Ausmaß
	'fb_description' => '' // max 140 zeichen
);
echo $twig->render($tplfile, $config);
// 
$log->addInfo('Mobile-Nav: '.$config['mobile_nav']);

?>