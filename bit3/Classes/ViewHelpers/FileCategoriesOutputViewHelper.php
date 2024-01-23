<?php
namespace Aip\Bit3\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\ViewHelperInterface;

/**
 * will return certain system categories (sys_category) data of an element
 * either as an array or as a string with certain parameters
 *
 * EXAMPLES:
 *
 * EMBEDDING IN TEMPLATE ON TOP: {namespace b=Aip\Bit3\ViewHelpers}
 * OR
 * <html xmlns:b="http://typo3.org/ns/Aip/Bit3/ViewHelpers" data-namespace-typo3-fluid="true">
 *
 * call an array with all category data to be used in a loop, e.g. for an HTML tag for each category:
 *    <f:if condition="{data.categories}">
 *        <f:for each="{b:CategoriesOutput(recUid: data.uid)}" as="category">
 *            <span class="{category.slug}">{category.title}</span>
 *        </f:for>
 *    </f:if>
 *
 * call a “data-categories” attribute with the slug field of the categories, comma-separated (default):
 *     {my:CategoriesOutput(recUid: data.uid, fieldString: 'slug', htmlAttr: 'data-categories')}
 *     output: ' data-categories="catx,caty"'
 *
 * call all categories as CSS classes (space as string separator, prefix 'cat-' for each category)
 *     {my:CategoriesOutput(recUid: data.uid, fieldString: 'slug', stringSeparator: ' ', catPrefix: 'cat-')}
 *     output: 'cat-catx cat-caty'
 */
class FileCategoriesOutputViewHelper extends AbstractViewHelper implements ViewHelperInterface
{
	protected $escapeOutput = false;

	public function initializeArguments()
	{
		$this->registerArgument('recUid', 'integer', 'record UID of the file resource (sys_file_reference)', true);
		$this->registerArgument('parentUid', 'integer', 'record UID of the content element which include the resource', true);
	}

	/**
	 * @return mixed
	 */
	public function render()
	{
		$recUid = $this->arguments['recUid'];
		$parentUid = $this->arguments['parentUid'];
		$tableName = 'sys_file_metadata';

		/**
		 * default query for sys_category table
		 */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');

		/**
		 * select the fields that will be returned, use asterisk for all
		 */
		$queryBuilder->select('sc.uid', 'sc.title', 'sc.slug', 'sc.single_pid', 'sc.shortcut', 'scrmm.uid_foreign', 'scrmm.tablenames');
		$queryBuilder->from('sys_file_reference');
		$queryBuilder->join(
			'sys_file_reference',
			'sys_file_metadata',
			'sfm',
			$queryBuilder->expr()->eq('sys_file_reference.uid_local', $queryBuilder->quoteIdentifier('sfm.file'))
		);
		$queryBuilder->join(
			'sfm',
			'sys_category_record_mm',
			'scrmm',
			$queryBuilder->expr()->eq('scrmm.uid_foreign', $queryBuilder->quoteIdentifier('sfm.uid')),
		);
		$queryBuilder->join(
			'scrmm',
			'sys_category',
			'sc',
			$queryBuilder->expr()->eq('scrmm.uid_local', 'sc.uid')
		);
		$queryBuilder->where(
			$queryBuilder->expr()->eq('sys_file_reference.uid_local', $queryBuilder->createNamedParameter($recUid, \PDO::PARAM_INT)),
			$queryBuilder->expr()->eq('sys_file_reference.uid_foreign', $queryBuilder->createNamedParameter($parentUid, \PDO::PARAM_INT)),
			$queryBuilder->expr()->eq('scrmm.tablenames', $queryBuilder->createNamedParameter($tableName))
		);

		$result = $queryBuilder->execute();
		$res = [];
		$i = 1;
		while ($row = $result->fetch()) {
			$res[] = $row;
			$i++;
		}
		return $res;
	}

}