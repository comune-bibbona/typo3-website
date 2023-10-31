<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 31/01/23
 * Time: 09:44
 */

defined('TYPO3') or die();

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

// CType Tab
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		$ll .'tab',
		'bit3_tab',
		'ext-bit3-tab',
		'custom'
	],
	'callout',
	'after'
);

// Configure the palettes for content element tab
$GLOBALS['TCA']['tt_content']['palettes']['tabheader'] = array(
	'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:tab.palette.header',
	'showitem' => '
			header;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:tab.titolo,
			layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:layout_formlabel,
		',
);
$GLOBALS['TCA']['tt_content']['palettes']['tabframes'] = array(
	'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames',
	'showitem' => '
			frame_class;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:frame_class_formlabel,
			space_before_class;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:space_before_class_formlabel,
			space_after_class;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:space_after_class_formlabel,
            ',
);

// Configure the default backend fields for the content element tab
$GLOBALS['TCA']['tt_content']['types']['bit3_tab'] = array(
	'showitem' => '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
			--palette--;;general,
			--palette--;;tabheader,
			--palette--;;,child_item;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:accordion.elementi,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
			--palette--;;tabframes,
			--palette--;;appearanceLinks,
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
			--palette--;;language,
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
			--palette--;;hidden,
			--palette--;;access,
		',
);