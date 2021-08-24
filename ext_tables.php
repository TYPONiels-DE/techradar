<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

foreach (['tx_techradar_domain_model_techradar', 'tx_techradar_domain_model_lernplan'] as $table) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages($table);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'techradar',
    'Configuration/TypoScript',
    'Techradar (Solr)'
);

$GLOBALS['TCA']['tx_techradar_domain_model_techradar']['ctrl']['readOnly'] = 1;
$GLOBALS['TCA']['tx_techradar_domain_model_lernplan']['ctrl']['readOnly'] = 1;