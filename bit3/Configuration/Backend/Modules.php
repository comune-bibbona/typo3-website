<?php
return [
	'Bit3' => [
		'parent' => 'web',
		'position' => ['after' => 'web_info'],
		'access' => 'user,group',
		'workspaces' => 'live',
		'iconIdentifier' => 'ext-bit3-module-icon',
		'path' => '/module/web/bit3',
		'labels' => 'LLL:EXT:bit3/Resources/Private/Language/locallang_mod.xlf',
		'extensionName' => 'Bit3',
		'controllerActions' => [
			Aip\Bit3\Controller\ModuleConfController::class => [
				'index',
				'cookies',
				'skin',
				'contatti',
				'page',
				'servizi',
				'social',
				'contatti',
				'salvaCookies',
				'salvaSkin',
				'salvaContatti',
				'salvaCopyrightAndCredits',
				'salvaPage',
				'salvaContainer',
				'salvaServiziInformato',
				'salvaServiziAttivo',
				'salvaSocial'
			],
		],
	],
];