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

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Template Bootstrap Italia TYPO3',
	'description' => 'Template Bootstrap Italia for TYPO3: the Design System of the Italian Public Administration according to the WCAG.',
	'category' => 'frontend',
	'author' => 'Abramo Tesoro',
	'author_email' => 'abramotesoro@gmail.com',
	'author_company' => 'Archimede Informatica - www.archicoop.it',
	'state' => 'stable',
	'version' => '2.0.1',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.19-12.9.99',
			'news' => '9.0.0-11.9.99',
			'eventnews' => '6.0.1-6.0.99',
		],
		'conflicts' => [
		],
		'suggests' => [
		],
	],
);
?>