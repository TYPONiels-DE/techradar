<?php

namespace TN\Techradar\Utility;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\DuplicationBehavior;
use TYPO3\CMS\Extbase\Annotation\Inject;

class FalmediaUtility
{
    const REDACTION_DIRECTORY = 'redaktion';
    const UPLOAD_DIRECTORY = 'Techradar';
    const TEMP_PREFIX = 'techtemp';

    /**
     * @var ResourceFactory
     * @inject
     */
    protected $resourceFactory = null;

    /**
     * FalUtility constructor.
     */
    public function __construct(ResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
    }

    /**
     * @param null $url
     * @return string|null
     * @throws \TYPO3\CMS\Core\Resource\Exception\ExistingTargetFolderException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderReadPermissionsException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderWritePermissionsException
     */
    public function tempoaryFile($url = null, $filename = null, $subdirName)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $storage = $this->resourceFactory->getDefaultStorage();

            // redaktion
            if (!$storage->hasFolder(self::REDACTION_DIRECTORY)) {
                $storage->createFolder(self::REDACTION_DIRECTORY);
            }
            // redaktion/Techradar
            if (!$storage->getFolder(self::REDACTION_DIRECTORY)->hasFolder(self::UPLOAD_DIRECTORY)) {
                $storage->createFolder(
                    self::UPLOAD_DIRECTORY,
                    $storage->getFolder(self::REDACTION_DIRECTORY));
            }
            // redaktion/Techradar/Lernplan
            if (!$storage->getFolder(self::REDACTION_DIRECTORY)->getSubfolder(self::UPLOAD_DIRECTORY)->hasFolder(ucfirst(strtolower($subdirName)))) {
                $storage->createFolder(
                    ucfirst(strtolower($subdirName)),
                    $storage->getFolder(self::REDACTION_DIRECTORY)->getSubfolder(self::UPLOAD_DIRECTORY)
                );
            }

            $externalFile = GeneralUtility::getUrl($url);
            if ($externalFile) {
                $tempFileName = tempnam(sys_get_temp_dir(), self::TEMP_PREFIX);
                $handle = fopen($tempFileName, 'w');
                fwrite($handle, $externalFile);
                fclose($handle);

                $uploadDir = $storage->getFolder(
                    self::REDACTION_DIRECTORY
                )->getSubfolder(self::UPLOAD_DIRECTORY)->getSubfolder(ucfirst(strtolower($subdirName)));

                $file = $uploadDir->addFile($tempFileName, $filename . '.jpg', DuplicationBehavior::REPLACE);
                return $file;
            } else {
                throw new \Exception(sprintf('External URL % cannot accessed.', $url), 1473233519);
            }
        }
    }

    public function downloadImageToStorage($urlToImage = null, $fileName = 'demo')
    {
        return $this->tempoaryFile($urlToImage, $fileName);
    }
}