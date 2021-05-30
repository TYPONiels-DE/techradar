<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
$TNL = 'LLL:EXT:techradar/Resources/Private/Language/locallang_db.xlf:';
$_EXTKEY = $GLOBALS['_EXTKEY'] = 'techradar';

$GLOBALS['TCA']['tx_techradar_domain_model_lernplan'] = array(
    'ctrl' => array(
        'title' => $TNL . 'tx_techradar_domain_model_lernplan',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ),
        'searchFields' => 'title,subtitle,teaser,bodytext,status,quadrant,area,level,cpid,visible',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'ext_icon.png'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title,subtitle,teaser,bodytext,status,quadrant,area,level,cpid,visible',
    ),
    'types' => array(
        '1' => array('showitem' => '
			    --div--;Techradar Datensatz,
			        --palette--;Basic;basic,
			        --palette--;Cockpit;cockpit,
			        --palette--;Titles;titles,
			        --palette--;Slugs;slugs,
			        --palette--;Urls;urls,
			        --palette--;Options;options,
			        --palette--;;options2,
			        --palette--;Background und Visability;bgoptions,
			    --div--;Medien,media,
			--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
				hidden;;1,
				starttime,
				endtime,
			--linebreak--,fe_group;LLL:EXT:cms/locallang_ttc.xlf:fe_group_formlabel,
			--linebreak--,editlock,
		'),
    ),
    'palettes' => array(
        'basic' => array('showitem' => 'sys_language_uid,l10n_parent,l10n_diffsource'),
        'cockpit' => array('showitem' => 'cpid,visible'),
        'titles' => array('showitem' => 'title,subtitle'),
        'urls' => array('showitem' => 'url,baseurl'),
        'slugs' => array('showitem' => 'title_slug,slugadditional'),
        'options' => array('showitem' => 'status,quadrant'),
        'options2' => array('showitem' => 'area,level'),
        'bgoptions' => array('showitem' => 'mediabgcolor'),
    ),
    'columns' => array(
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'default' => 0,
            ]
        ],
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table' => 'tx_techradar_domain_model_lernplan',
                'foreign_table_where' => 'AND tx_techradar_domain_model_lernplan.pid=###CURRENT_PID### AND tx_techradar_domain_model_lernplan.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 16,
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 16,
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ]
        ],
        'fe_group' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        -1,
                    ],
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        -2,
                    ],
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        '--div--',
                    ],
                ],
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
                'foreign_table_where' => 'ORDER BY fe_groups.title',
            ],
        ],
        'cpid' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.cpid',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'title' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.title',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'subtitle' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.subtitle',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'title_slug' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.titleSlug',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'slugadditional' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.slugadditional',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'readOnly' => true
            ),
        ),

        'teaser' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.teaser',
            'config' => array(
                'type' => 'text',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'bodytext' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.bodytext',
            'config' => array(
                'type' => 'text',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'visible' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.visible',
            'config' => array(
                'type' => 'check',
                'readOnly' => true
            ),
        ),

        'url' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.url',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'baseurl' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.baseurl',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'status' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.status',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),

        'quadrant' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.quadrant',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'area' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.area',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'level' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.level',
            'config' => array(
                'type' => 'input',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),

        'mediabgcolor' => array(
            'exclude' => 1,
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.mediabgcolor',
            'config' => array(
                'type' => 'input',
                'renderType' => 'colorpicker',
                'readOnly' => true,
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'media' => [
            'label' => $TNL . 'tx_techradar_domain_model_lernplan.media',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'media',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                        'collapseAll' => true
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                    --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                    --palette--;;filePalette'
                            ],
                        ],
                    ],
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                    'maxitems' => 1,
                    'foreign_match_fields' => [
                        'fieldname' => 'media',
                        'tablenames' => 'tx_techradar_domain_model_lernplan',
                        'table_local' => 'sys_file',
                    ],

                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            )
        ],
    ),
);
