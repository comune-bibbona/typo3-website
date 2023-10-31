<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 23/02/2022
 * Time: 10:44
 */

defined('TYPO3') or die();

$customSysFileReferenceColumns = [
	'layout' => [
		'exclude' => true,
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:image.layout',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => [
				['LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:image.layout.default', 0, ''],
				['LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:image.layout.thumbnail', 1, ''],
			],
			'default' => 0,
		],
	],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $customSysFileReferenceColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference', 'imageoverlayPalette', 'layout');
