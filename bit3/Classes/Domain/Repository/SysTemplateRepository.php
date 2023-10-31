<?php

/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 10/11/2022
 * Time: 10:04
 */

namespace Aip\Bit3\Domain\Repository;

use TYPO3\CMS\Core\Exception;

class SysTemplateRepository extends \TYPO3\CMS\ExtBase\Persistence\Repository
{

	/**
	 * Find Constants via sys_template Database Table
	 *
	 * @return array|NULL           Result is array('constants' => queryResult) or NULL
	 */

	/*
	public function fetchConstants()
	{   //
		// Query Builder for Table: sys_template
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_template');

		// Get Constants of Row, where RM Registration is included
		$query = $queryBuilder
			->select('constants')
			->from('sys_template')
			->where(
				$queryBuilder->expr()->like(
					'include_static_file',
					$queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards('EXT:template-bootstrap-itatoolkit/Configuration/TypoScript') . '%')
				)
			);

		// Execute Query and Return the Query-Fetch
		$query = $queryBuilder->execute();
		return $query->fetch();
	}

	/**
	 * Update Constants via sys_template Database Table         ( Updates $this->settings )
	 *
	 * @param string $constants         The new settings, that has to be stored in $this->settings
	 */
	/*
	public function updateConstants(string $constants)
	{
		// Query Builder for Table: sys_template
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_template');

		$query = $queryBuilder
			->update('sys_template')
			->where(
				$queryBuilder->expr()->like(
					'include_static_file',
					$queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards('EXT:template-bootstrap-itatoolkit/Configuration/TypoScript') . '%')
				)
			)
			->set('constants', $constants);
		$query = $queryBuilder->execute();

		return ($query > 0) ? TRUE : FALSE;
	}
	*/

}