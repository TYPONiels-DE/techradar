<?php

namespace TN\Techradar\Domain\Repository;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Annotation\Inject;

/**
 * Class LernplanRepository
 *
 * @package TN\Techradar\Domain\Repository
 */
class LernplanRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var \TYPO3\CMS\Core\Context\Context
     * @TYPO3\CMS\Extbase\Annotation\Inject
    */
    protected $context;

    /**
     * LernplanRepository constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Initialize the repository with default query settings
     */
    public function initializeObject()
    {
        $defaultQuerySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
        $defaultQuerySettings->setRespectStoragePage(false);
        $defaultQuerySettings->setIgnoreEnableFields(false);
        $this->setDefaultQuerySettings($defaultQuerySettings);
    }

    protected $defaultOrderings = [
            'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
            'uid' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
        ];

    /**
     * Finds all by specific pid
     *
     * @param  int $pid
     * @return mixed
     */
    public function findByPid(int $pid)
    {
        $query = $this->createQuery();
        $matching = [];

        $matching[] = $query->logicalOr(
            $query->like('sysLanguageUid', (string) -1)
        );
        $matching[] = $query->logicalOr(
            /** @phpstan-ignore-next-line */
            $query->like('sysLanguageUid', ($this->context->getAspect('language'))->getId())
        );
        $query->matching(
            $query->logicalAnd(
                $query->equals('pid', (int)$pid)
            )
        );
        $query->getQuerySettings()->setRespectStoragePage(true)->setStoragePageIds([683]);
        $query->matching($query->logicalAnd($matching));
        return $query->execute();
    }
}
