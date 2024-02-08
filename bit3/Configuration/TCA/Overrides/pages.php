<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 08/10/2023
 * Time: 10:44
 */

defined('TYPO3') or die();

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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $customPagesColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','data_element', '','after:subtitle');
