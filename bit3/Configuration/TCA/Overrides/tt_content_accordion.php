<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 31/01/23
 * Time: 09:44
 */

defined('TYPO3') or die();

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

// CType Accordion
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		$ll .'accordion',
		'bit3_accordion',
		'ext-bit3-accordion',
		'custom'
	],
	'default',
	'after'
);

// Configure the default backend fields for the content element accordion
$GLOBALS['TCA']['tt_content']['types']['bit3_accordion'] = array(
	'showitem' => '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
			--palette--;;general,
			--palette--;;,header;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:accordion.titolo,
			--palette--;;,child_item;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:accordion.elementi,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
			--palette--;;frames,
			--palette--;;appearanceLinks,
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
			--palette--;;language,
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
			--palette--;;hidden,
			--palette--;;access,
		',
);