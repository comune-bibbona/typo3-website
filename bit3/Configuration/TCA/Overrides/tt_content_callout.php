<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 31/01/23
 * Time: 09:44
 */

defined('TYPO3') or die();

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

// CType Callout
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		$ll .'callout',
		'bit3_callout',
		'ext-bit3-callout',
		'custom'
	],
	'accordion',
	'after'
);

// Configure the default backend fields for the content element callout
$GLOBALS['TCA']['tt_content']['types']['bit3_callout'] = array(
	'showitem' => '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
			--palette--;;general,
			--palette--;;,header;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:callout.titolo,
			--palette--;;,bodytext;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:callout.bodytext,  
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
			--palette--;;frames,
			--palette--;;appearanceLinks,
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
			--palette--;;language,
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
			--palette--;;hidden,
			--palette--;;access,
		',
	'columnsOverrides' => [
		'bodytext' => [
			'config' => [
				'enableRichtext' => true,
			]
		]
	]
);