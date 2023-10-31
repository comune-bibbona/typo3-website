<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 31/01/23
 * Time: 09:44
 */

defined('TYPO3') or die();

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

// CType Timeline
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		$ll .'timeline',
		'bit3_timeline',
		'ext-bit3-timeline',
		'custom'
	],
	'tab',
	'after'
);

// Configure the default backend fields for the content element timeline
$GLOBALS['TCA']['tt_content']['types']['bit3_timeline'] = array(
	'showitem' => '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
			--palette--;;general,
			--palette--;;,header;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:timeline.titolo,
			--palette--;;,timeline_item;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:timeline.elementi,
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

// Configure the default backend fields for the content element item-timeline
$GLOBALS['TCA']['tt_content']['columns']['timeline_item'] = array (
	'exclude' => false,
	'label' => $ll.'timeline_item',
	'config' => [
		'type' => 'inline',
		'foreign_table' => 'tx_bit3_timeline_item',
		'foreign_field' => 'tt_content',
	]
);