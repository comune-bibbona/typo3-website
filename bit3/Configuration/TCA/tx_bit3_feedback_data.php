<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 03/04/25
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
		'title' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:feedback.header',
		'label' => 'clarity_rating',
		'sortby' => 'sorting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'versioningWS' => true,
		'origUid' => 't3_origuid',
		'hideTable' => false,
		'readOnly' => true,
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
			'default' => 'ext-bit3-child-item'
		],
		'searchFields' => 'difficulty_area,preferred_aspects,additional_details,pageurl',
		'security' => [
			'ignoreWebMountRestriction' => true,
			'ignoreRootLevelRestriction' => true,
		],
	],
	'interface' => [
		'showRecordFieldList' => [
			'showRecordFieldList' => 'hidden, clarity_rating, difficulty_area, preferred_aspects, additional_details, pageurl',
		],
	],
	'types' => [
		'0' => [
			'showitem' => '
			--palette--;;,clarity_rating;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:feedback.clarity_rating,  
			--palette--;;,difficulty_area;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:feedback.difficulty_area,       
			--palette--;;,preferred_aspects;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:feedback.preferred_aspects,       
			--palette--;;,additional_details;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:feedback.additional_details,       
			--palette--;;,pageurl;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:feedback.pageurl,            
        ',
		],
	],
	'columns' => [
		'clarity_rating' => [
			'readOnly' => true,
			'exclude' => false,
			'label' => $ll . 'feedback.clarity_rating',
			'description' => $ll . 'feedback.clarity_rating.description',
			'config' => [
				'type' => 'radio',
				'items' => [
					[
						'label' => '1',
						'value' => 1,
					],
					[
						'label' => '2',
						'value' => 2,
					],
					[
						'label' => '3',
						'value' => 3,
					],
					[
						'label' => '4',
						'value' => 4,
					],
					[
						'label' => '5',
						'value' => 5,
					],
				],
			],
		],
		'difficulty_area' => [
			'exclude' => true,
			'label' => $ll . 'feedback.difficulty_area',
			'config' => [
				'type' => 'input',
				'size' => 50,
				'eval' => 'trim,required'
			],
		],
		'preferred_aspects' => [
			'exclude' => true,
			'label' => $ll . 'feedback.preferred_aspects',
			'config' => [
				'type' => 'input',
				'size' => 50,
				'eval' => 'trim,required'
			],
		],
		'additional_details' => [
			'exclude' => true,
			'label' => $ll . 'feedback.additional_details',
			'config' => [
				'type' => 'text',
				'cols' => '80',
				'rows' => '15',
			],
		],
		'pageurl' => [
			'exclude' => true,
			'label' => $ll . 'feedback.pageurl',
			'config' => [
				'type' => 'input',
				'size' => 50,
				'eval' => 'trim,required'
			],
		],
	],
];