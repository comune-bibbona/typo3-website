<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 29/12/22
 * Time: 09:44
 */

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';


if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('lang')) {
	$generalLanguageFile = 'EXT:lang/Resources/Private/Language/locallang_general.xlf';
} else {
	$generalLanguageFile = 'EXT:core/Resources/Private/Language/locallang_general.xlf';
}

// Configure the TCA for Item Accordion
return [
	'ctrl' => [
		'title' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:childItem.header',
		'label' => 'header',
		'label_alt' => 'date,bodytext',
		'sortby' => 'sorting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'versioningWS' => true,
		'origUid' => 't3_origuid',
		'hideTable' => true,
		'hideAtCopy' => true,
		'prependAtCopy' => 'LLL:' . $generalLanguageFile . ':LGL.prependAtCopy',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'languageField' => 'sys_language_uid',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'typeicon_classes' => [
			'default' => 'ext-bit3-timeline-item'
		],
		'searchFields' => 'header,bodytext',
	],
	'interface' => [
		'showRecordFieldList' => '
				hidden,
				header,
				bodytext
        	',
	],
	'types' => [
		'0' => [
			'showitem' => '			
			--palette--;;,date;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:timeline.data,
			--palette--;;,header;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:timeline.titolo,
			--palette--;;,bodytext;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:childItem.bodytext,   
			--palette--;;,link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel
			--palette--;;,categories;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        	',
		],
	],
	'columns' => [
		'tt_content' => [
			'exclude' => true,
			'label' => $ll . 'childItem',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tt_content',
				'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID### AND tt_content.{#CType}=\'bit3_timeline\'',
				'maxitems' => 1,
				'default' => 0,
			],
		],
		'header' => [
			'exclude' => true,
			'label' => $ll . 'childItem.header',
			'config' => [
				'type' => 'input',
				'size' => 50,
				'eval' => 'trim,required'
			],
		],
		'bodytext' => [
			'label' => $ll . 'childItem.bodytext',
			'l10n_mode' => 'prefixLangTitle',
			'l10n_cat' => 'text',
			'config' => [
				'type' => 'text',
				'cols' => '80',
				'rows' => '15',
				'softref' => 'typolink_tag,email[subst],url',
				'enableRichtext' => true
			],
		],
		'date' => [
			'exclude' => true,
			'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:date',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
				'default' => 0
			]
		],
		'link' => [
			'exclude' => true,
			'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputLink',
				'size' => 50,
				'max' => 1024,
				'eval' => 'trim',
				'fieldControl' => [
					'linkPopup' => [
						'options' => [
							'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
						],
					],
				],
				'softref' => 'typolink'
			]
		],
		'categories' => [
			'config' => [
				'type' => 'category'
			]
		],
	],
];