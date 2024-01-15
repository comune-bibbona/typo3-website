<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2022 Abramo Tesoro <tesoro@archicoop.it>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

 if (!defined('TYPO3')) {
	die ('Access denied.');
}

if (TYPO3 === 'BE') {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'aip.bit3',
		'site',                       // Main area
		'tx_bit3_configuration',      // Name of the module
		'top',  // Position of the module
		[ // Controller configuration
			\Aip\Bit3\Controller\ModuleConfController::class => 'index, cookies, skin, contatti, page, servizi, social, salvaCookies, salvaSkin, salvaContatti, salvaCopyrightAndCredits, salvaPage, salvaContainer, salvaCategory, salvaServiziInformato, salvaServiziAttivo, salvaSocial'
		],
		[  // Additional configuration
			'access' => 'user,group',
			'iconIdentifier' => 'module-icon',
			'labels' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_mod.xlf',
			'navigationComponentId' => 'TYPO3/CMS/Backend/PageTree/PageTreeElement',
			'inheritNavigationComponentFromMainModule' => true,
		]
	);
}

# TCA configuration
$boot = function () {
	foreach (['child_item','timeline_item'] as $table) {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_bit3_'.$table,'EXT:bit3/Resources/Private/Language/locallang_db.xlf');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bit3_'.$table);
	}
};
$boot();
unset($boot);
?>