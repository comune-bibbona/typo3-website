<?php
declare(strict_types=1);

/*
 *
 * Save Feedback Form data to database
 *
 */

namespace Aip\Bit3\Domain\Finishers;

use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;

/**
 * Finisher base class.
 *
 * Scope: frontend
 * **This class is meant to be sub classed by developers**
 */
class SaveFeedbackFinisher extends AbstractFinisher
{
	protected $defaultOptions = [
		'clarityRatingField' => 'radiobutton-1',
		'difficultyAreaField' => 'radiobutton-2',
		'preferredAspectsField' => 'radiobutton-3',
		'additionalDetailsField' => 'text-1',
		'pageUrlField' => 'pageurl',
		'storagePid' => 0,
	];

	protected function executeInternal()
	{
		$clarityRatingField = $this->parseOption('clarityRatingField');
		$difficultyAreaField = $this->parseOption('difficultyAreaField');
		$preferredAspectsField = $this->parseOption('preferredAspectsField');
		$additionalDetailsField = $this->parseOption('additionalDetailsField');
		$pageUrlField = $this->parseOption('pageUrlField');
		$storagePid = $this->parseOption('storagePid');

		$formValues = $this->finisherContext->getFormValues();
		$FeedbackPid = 1760;

		$data = [
			'pid' => (int)$FeedbackPid,
			'clarity_rating' => $formValues[$clarityRatingField] ?? null,
			'difficulty_area' => $this->formatFieldValue($formValues[$difficultyAreaField] ?? null),
			'preferred_aspects' => $this->formatFieldValue($formValues[$preferredAspectsField] ?? null),
			'additional_details' => $formValues[$additionalDetailsField] ?? null,
			'pageurl' => $formValues[$pageUrlField] ?? null,
			'tstamp' => time(),
			'crdate' => time(),
			'cruser_id' => $this->getCurrentUserId(),
			'sys_language_uid' => 0,
			'l10n_parent' => 0,
			'l10n_diffsource' => '',
		];

		$connection = GeneralUtility::makeInstance(ConnectionPool::class)
			->getConnectionForTable('tx_bit3_feedback_data');

		$connection->insert(
			'tx_bit3_feedback_data',
			$data
		);
	}

	/**
	 * Formatta il valore del campo per il database
	 *
	 * @param mixed $value
	 * @return string|null
	 */
	protected function formatFieldValue($value): ?string
	{
		if (is_array($value)) {
			return implode(',', $value);
		}
		return $value !== null ? (string)$value : null;
	}

	protected function getTypoScriptFrontendController()
	{
		return $GLOBALS['TSFE'];
	}

	protected function getCurrentUserId(): int
	{
		$context = GeneralUtility::makeInstance(Context::class);
		return (int)$context->getPropertyFromAspect('backend.user', 'id', 0);
	}
}
