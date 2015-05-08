<?php 
require 'class.Website.php';
//
$config = array(
	'project_name' => 'Common', 
	'twig' => 'new', // 'old' php <= 5.4
	'releasedate' => '2015-12-24',
	'mobile_nav' => 'skel-layers', // [ false, 'scotchpanel', 'skel-layers' ]
	'he_buttons' => array(
		'color' => 'on_dark',
		'columns' => 3,
		'links' => array(
			array(
				'name' => 'itunes',
				'link' => '#'
			),
			array(
				'name' => 'maxdome',
				'link' => '#'
			),
			array(
				'name' => 'videoload',
				'link' => '#'
			),
			array(
				'name' => 'google_play',
				'link' => '#'
			),
			array(
				'name' => 'amazon_instant',
				'link' => '#'
			),
			array(
				'name' => 'kabel_deutschland',
				'link' => '#'
			),
			array(
				'name' => 'vodafone',
				'link' => '#'
			),
			array(
				'name' => 'videobuster',
				'link' => '#'
			),
			array(
				'name' => 'unitymedia',
				'link' => '#'
			),
			array(
				'name' => 'wuaki_tv',
				'link' => '#'
			)
		)
	),
	'modules' => array(
		'pdfButtons' => array(
			'startkinos' => array(
				'use' => true 
			),
			'schulmaterial' => array(
				'use' => false
			),
			'kinotour' => array(
				'use' => false
			)
		),
		'gallery' => array(
			'use'=>true, 
			'images'=>glob('media/gallery/*.jpg')
		),
		'trailer' => array(
			'use' => true
		),
		'cites' => array(
			'use' => true
		),
		'facebookLike' => array(
			'use' => false,
			'url' => 'http://google.de', //
			'og_img' => '', // pfad zu einem quadratischem Bild mit mindestens 250x250px Ausmaß
			'og_description' => '' // max 140 zeichen
		)
	)
); 
$site = new Website($config);
echo $site->html;
// |<--
// 
// 