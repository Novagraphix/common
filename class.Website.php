<?php
/**
 * Comment this out when php-error occurs
 */
require 'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\BrowserConsoleHandler;
/**
* <-------------------------------------------------
*/
class Website
{
	private $log;
	private $config;
	private $default_config;
	//
	function __construct($config) {
		if($config['twig'] == 'new') {
			// --> create a log channel
			$this->log = new Logger('Novagraphix');
			$this->log->pushHandler(new BrowserConsoleHandler());
			// <-- end log-channel
		}
		//
		$this->default_config = array(
			'page' => $this->getPagename(),
			'base' => '',
			'mobile_nav' => 'skel-layers', //'scotchpanel','skel-layers'
			'releasedate' => date( 'Y-m-d', strtotime('tomorrow') ),
			'post_releasedate_txt' => 'Jetzt im Kino',
			'pre_releasedate_txt' => array(
				'Ab <span>',
				'</span> im Kino'
			),
			'release' => '',
			'modules' => array(
				'pdfButtons' => array(
					'startkinos' => array(
						'use' => false
					),
					'schulmaterial' => array(
						'use' => false,
						'path' => ''
					),
					'kinotour' => array(
						'use' => false,
						'path' => ''
					)
				),
				'sizzle' => array(
					'use' => false,
					'path' => '',
					'yt' => ''
				),
				'facebookLike' => array(
					'use' => false,
					'url' => '', //
					'og_img' => '', // pfad zu einem quadratischem Bild mit mindestens 250x250px Ausmaß
					'og_description' => '' // max 140 zeichen
				)
			),
			'tplfile' => $this->getTemplateFile(),
		);
		//
		$config['modules']['pdfButtons']['startkinos']['path'] = $this->findLatestPDF('startkinos');
		$config['modules']['pdfButtons']['schulmaterial']['path'] = $this->findLatestPDF('schulmaterial');
		//
		$this->config = array_merge ( $this->default_config, $config );
		$this->config['release'] = $this->getReleaseTxt($config);

		$this->config['config'] = $this->config;
		// --> Twig-config:
		if($config['twig'] == 'new') {
			require 'vendor/autoload.php';
		} else {
			require 'inc/Twig/Autoloader.php';
		}
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem('templates');
		$twig = new Twig_Environment($loader, array(
			'cache' => 'cache',
			'auto_reload' => true
		));
		// <-- end Twig-config
		if($config['twig'] == 'new') {
			$this->log->addInfo('Kinostart: '.$this->config['release']);
			$this->log->addInfo('PDF-Linker (startkinos): ' .$this->config['modules']['pdfButtons']['startkinos']['path']);
			$this->log->addInfo('PDF-Linker (schulmaterial): ' .$this->config['modules']['pdfButtons']['schulmaterial']['path']);
			$this->log->addInfo('Aufgerufene Seite: '.$this->config['page']);
		}
		//
		$this->html = $twig->render($this->config['tplfile'], $this->config);
	}
	/**
	 * PUBLIC Functions ------------------------------------------------>
	 */
	public function isLocalhost() {
		$locals = array(
			'localhost',
			'127.0.0.1',
			'172.31.1.61',
			'172.31.1.62'
		);
		if( in_array( $_SERVER['SERVER_ADDR'], $locals ) ) {
			return true;
		}
		return false;
	}

	public function getBase($full = true) {
		$dev = $this->isLocalhost() ? '' : '';
		//
		$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$url .= $_SERVER['SERVER_NAME'];
		$url .= htmlspecialchars($_SERVER['REQUEST_URI']);
		return (($url)) . "/" .$dev;
	}

	public function getReleaseTxt($config){
		$r = '';
		if (strftime("%Y-%m-%d")>=$config['releasedate']) {
			$r = $this->default_config['post_releasedate_txt'];
		} else {
			// date( 'd.m.Y', strtotime($this->config['releasedate']) )
			$r = $this->default_config['pre_releasedate_txt'][0] .date( 'd.m.Y', strtotime($config['releasedate']) ) .$this->default_config['pre_releasedate_txt'][1];
		}
		return $r;
	}

	public function getPagename(){
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			if ($page == '') {
				$page = 'home';
			}
		} else {
			$page = 'home';
		}
		return $page;
	}

	public function getTemplateFile(){
		if (isset($_GET['page']) && $_GET['page'] != '') {
			if(!file_exists('templates/pages/'.$_GET['page'].'.html'))
				return '/pages/404.html';
			return  '/pages/'.$_GET['page'].'.html';
		}
		return '/pages/'.$this->getPagename().'.html';
	}
	/**
	 * PRIVATE Functions ------------------------------------------------>
	 */
	private function findLatestPDF($folder='') {
		$latest_ctime = 0;
		$latest_filename = '';
		foreach (glob('media/pdf/'.$folder.'/*.pdf') as $filename) {
			if(filectime($filename) > $latest_ctime){
				$latest_ctime = filectime ( $filename );
				$latest_filename = $filename;
			}
		}
		return $latest_filename;
	}
	//
}