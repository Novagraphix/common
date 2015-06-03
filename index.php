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
	'navigation' => array(
		'use' => true, // [true, false / 'static']
		'pages' => array(
			array('label' => 'Home', 'file' => 'home', 'classes' => '', 'id' => ''),
			array('label' => 'Inhalt', 'file' => 'inhalt', 'classes' => '', 'id' => ''),
			// array('label' => 'Trailer', 'file' => 'trailer', 'classes' => 'popup', 'id' => 'trailer_btn', 'data' => array('name'=>'rel', 'value'=>'#trailer')),
			array('label' => 'Fotos', 'file' => 'fotos', 'classes' => 'popup', 'id' => '', 'data' => array('name'=>'rel', 'value'=>'#gallery')),
			array('label' => '404 - Example', 'file' => 'foo', 'classes' => '', 'id' => ''),
		)
	),
	'modules' => array(
		'pdfButtons' => array(
			'startkinos' => array(
				'use' => true
			),
			'schulmaterial' => array(
				'use' => true
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
			'use' => true,
			'type' => 'sizzle', //'embed', // ['embed', 'button', 'sizzle']
			'yt_id' => 'LYp3qGEeSKA' // ['LYp3qGEeSKA'] testbild
		),
		'cites' => array(
			'use' => true
		),
		'facebookLike' => array(
			'use' => false,
			'url' => 'http://localhost', //
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