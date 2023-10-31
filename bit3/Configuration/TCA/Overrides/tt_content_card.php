<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 31/01/23
 * Time: 09:44
 */

defined('TYPO3') or die();

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

// CType Card
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		$ll .'card',
		'bit3_card',
		'ext-bit3-card',
		'custom'
	],
	'accordion',
	'after'
);

// Configure the default backend fields for the content element card
$GLOBALS['TCA']['tt_content']['types']['bit3_card'] = array(
	'showitem' => '
		--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
			--palette--;;general,
			--palette--;;,header;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:card.titolo,
			--palette--;;,subheader;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:card.ruolo,			
			--palette--;;,bodytext;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:card.bodytext,  
			--palette--;;,image;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:card.immagine,	
			--palette--;;,header_link;LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:card.link,	
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
		'image' => [
			'config' => [
				'maxitems' => 1,
				'autoSizeMax' => true,
				'overrideChildTca' => [
					'types' => [
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
								--palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageTramePalette,
								--palette--;;imageoverlayPalette,
								--palette--;;filePalette'
						],
					],
				],
			]
		],
		'bodytext' => [
			'config' => [
				'enableRichtext' => true,
			]
		],
	]
);