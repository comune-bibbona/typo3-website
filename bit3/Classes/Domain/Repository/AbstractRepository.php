<?php
/**
 * Created by PhpStorm.
 * User: abramotesoro
 * Date: 10/11/2022
 * Time: 11.14
 */

namespace Aip\Bit3\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function findConstantsSysTemplate(int $templateUid) : array
    {
        $vettConstantsSysTemplate = [];
        $conn = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_template');
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->getRestrictions();
        $valueConstantsSysTemplate = $queryBuilder
            ->select('constants')
            ->from('sys_template')
            ->add('where', 'root = 1 AND uid='.$templateUid)
            ->execute()
            ->fetchAll();
        if (!empty($valueConstantsSysTemplate[0]['constants'])){
            $vettConstants = preg_split('/\n|\r\n?/',$valueConstantsSysTemplate[0]['constants']);
            /*costruire il vettore del campo constants della tabella sys_template*/
            for ($i = 0; $i < count($vettConstants); $i++){
                 $idx = stripos($vettConstants[$i], '=');
                 $constantsIdx = substr($vettConstants[$i],0,$idx);
                 $constantsValue = substr($vettConstants[$i],$idx+1);
                $vettConstantsSysTemplate[trim($constantsIdx)]= trim($constantsValue);
            }
            return $vettConstantsSysTemplate;
        }

        return $vettConstantsSysTemplate;
    }

    public function updateCostantsSysTemplate(string $valueConstants, int $templateUid){

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_template');
        $queryBuilder
            ->update('sys_template')
            ->where('root = 1 AND uid='.$templateUid)
            ->set('constants', $valueConstants)
            ->execute();
    }


    /**
     * @param int $pageUid
     * @return int
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findCurrentSyTemplate(int $pageUid):int
    {
        $conn = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_template');
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->getRestrictions();
        $result = $queryBuilder
            ->select('uid')
            ->from('sys_template')
            ->add('where', 'root = 1 AND pid='.$pageUid)
            ->execute()
            ->fetchAll();
        if (!empty($result[0]['uid'])){
            return (int) $result[0]['uid'];
        } else {
            return -1;
        }

    }

    public function findParentPage(int $pageUid):int
    {
        $conn = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('sys_template');
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->getRestrictions();
        $result = $queryBuilder
            ->select('pid')
            ->from('pages')
            ->add('where', 'uid='.$pageUid)
            ->execute()
            ->fetchAll();
        if (!empty($result[0]['pid'])){
            return (int) $result[0]['pid'];
        } else {
            return -1;
        }
    }
}