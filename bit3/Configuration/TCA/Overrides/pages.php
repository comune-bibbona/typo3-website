<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 15/11/2023
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
	'lat' => [
		'exclude' => true,
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.lat',
		'config' => [
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim',
			'default' => 0
		]
	],
	'lng' => [
		'exclude' => true,
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.lng',
		'config' => [
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim',
			'default' => 0
		]
	],
	'areaServed_name' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.areaserved.name',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
	'audience_audienceType' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.audience.audiencetype',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
	'serviceLocation_name' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.name',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
	'serviceLocation_address_streetAdress' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.address.streetadress',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
	'serviceLocation_address_postalCode' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.address.postalcode',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
	'serviceLocation_address_addressLocality' => [
		'exclude' => true,
		'l10n_mode' => 'prefixLangTitle',
		'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.page.servicelocation.address.addresslocality',
		'config' => [
			'type' => 'input',
			'size' => 50,
			'max' => 255,
			'eval' => 'trim',
		],
	],
];

$GLOBALS['TCA']['pages']['palettes']['geolocation'] = [
	'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.geolocation',
	'showitem' => 'lat;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.lat,lng;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.lng,',
];

$GLOBALS['TCA']['pages']['palettes']['metadataJson'] = [
	'label' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.service',
	'showitem' => 'areaServed_name;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.areaserved.name,audience_audienceType;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.audience.audiencetype, --linebreak--,serviceLocation_name;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.name, --linebreak--,serviceLocation_address_streetAdress;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.address.streetadress, serviceLocation_address_postalCode;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.address.postalcode, serviceLocation_address_addressLocality;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:page.servicelocation.address.addresslocality,',
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $customPagesColumns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','--palette--;;geolocation', '','after:lastUpdated');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','--palette--;;metadataJson', '','after:lng');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages','data_element', '','after:subtitle');