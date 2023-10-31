<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 26/11/21
 * Time: 09:44
 */

defined('TYPO3') or die();

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

// Add the group element to Type dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
	'tt_content',
	'CType',
	'custom',
	$ll.'wizard.tab',
	'after:default'
);

// Configure the default backend fields for the content element item-child used by content element accordion, tab
$GLOBALS['TCA']['tt_content']['columns']['child_item'] = array (
	'exclude' => false,
	'label' => $ll.'child_item',
	'config' => [
		'type' => 'inline',
		'foreign_table' => 'tx_bit3_child_item',
		'foreign_field' => 'tt_content',
	]
);

// Configure the default backend fields for the content element item-child used by content element accordion, tab
$GLOBALS['TCA']['tt_content']['columns']['imagecols']['config']['items'] = array (
	[
		'1',
		1,
	],
	[
		'2',
		2,
	],
	[
		'3',
		3,
	],
	[
		'4',
		4,
	],
	[
		'6',
		6,
	],
);

$customPagesColumns = [
	'data_element' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.dataelement',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $customPagesColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'headers', '--linebreak--');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'headers', 'data_element');