<?php

namespace TN\Techradar\Domain\Model;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceInterface;

/**
 * Class FileReference
 *
 * @package TN\Techradar\Domain\Model
 */
class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference
{

    /**
     * We need this property so that the Extbase persistence can properly persist the object
     *
     * @var integer
     */
    protected $uidLocal;
    /**
     * uid of a sys_file
     *
     * @var integer
     */
    protected $originalFileIdentifier;


    /**
     * @var mixed
     */
    protected $file = null;

    /**
     * setFile
     *
     * @param \TYPO3\CMS\Core\Resource\File $falFile
     *
     * @return void
     */
    public function setFile(File $falFile)
    {
        $this->originalFileIdentifier = (int)$falFile->getUid();
    }

    /**
     * @return int
     */
    public function getUidLocal()
    {
        return $this->uidLocal;
    }

    /**
     * setUidLocal
     *
     * @param \TYPO3\CMS\Core\Resource\File $falFile
     *
     * @return void
     */
    public function setUidLocal(File $falFile)
    {
        $this->uidLocal = (int)$falFile->getUid();
    }
}
