<?php

$EM_CONF[$_EXTKEY] = array(
	'title'            => 'TYPONiels Techradar Connector',
	'description'      => 'With this extension, techradar data can be easily and automaticly integrated into TYPO3.',
	'category'         => 'plugin',
	'author'           => 'Niels Langlotz',
	'author_email'     => 'info@typoniels.de',
	'state'            => 'stable',
	'internal'         => '',
	'uploadfolder'     => '1',
	'createDirs'       => '',
	'clearCacheOnLoad' => 0,
	'version'          => '1.0.0',
	'constraints'      => array(
		'depends'   => array(
            'typo3' => '9.5.0-11.9.99',
		),
		'conflicts' => array(),
		'suggests'  => array(),
	),
);