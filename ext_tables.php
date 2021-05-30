<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

foreach (['tx_typoniels_domain_model_techradar', 'tx_typoniels_domain_model_lernplan'] as $table) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages($table);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'techradar',
    'Configuration/TypoScript/Solr',
    'Techradar (Solr)'
);