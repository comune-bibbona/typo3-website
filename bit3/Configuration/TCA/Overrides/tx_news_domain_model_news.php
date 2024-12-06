<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 08/11/24
 * Time: 09:44
 */

$ll = 'LLL:EXT:bit3/Resources/Private/Language/locallang_db.xlf:';

$fields = array(
	'price' => array(
		'exclude' => false,
		'label' => $ll . 'eventnews.costi',
		'config' => array(
			'type' => 'text',
			'cols' => 30,
			'rows' => 5,
			'softref' => 'typolink_tag,email[subst],url',
			'enableRichtext' => true,
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);

$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['palette_eventfields']['showitem'] = 'organizer,organizer_simple, --linebreak--,location,location_simple, --linebreak--,price';
