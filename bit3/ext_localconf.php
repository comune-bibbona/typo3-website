<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2023 Abramo Tesoro <tesoro@archicoop.it>
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


if (!defined('TYPO3'))
	die('Access denied.');

/*
 * Add default RTE configuration for bootstrap italia
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bit3'] = 'EXT:bit3/Configuration/RTE/Default.yaml';


$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] = 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp';

/**
 * Add PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="DIR:EXT:bit3/Configuration/TSconfig/" extensions="tsconfig">');

// Register custom EXT:form configuration
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
		plugin.tx_form {
			settings {
				yamlConfigurations {
					100 = EXT:bit3/Configuration/Form/Setup.yaml
				}
			}
		}
		 module.tx_form {
			 settings {
				 yamlConfigurations {
					100 = EXT:bit3/Configuration/Form/Setup.yaml
				 }
			 }
		 }
    '));
}

/**
 * Add custom css for backend
 */
$GLOBALS['TYPO3_CONF_VARS']['BE']['stylesheets']['bit3'] = 'EXT:bit3/Resources/Public/css/backend/backend.css';

?>