<?php

namespace TN\Techradar\Service;

use TN\Techradar\Domain\Repository\TechradarRepository;
use TN\Techradar\Utility\CockpitImportUtility;
use TN\Techradar\Utility\CockpitMediaUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TN\Techradar\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DataImportService
{

    const SUCCESSFULL = 0;
    const TNREPRO = 'TN\Techradar\Domain\Repository\\';
    const TNMODEL = 'TN\Techradar\Domain\Model\\';

    /**
     * @var PersistenceManager
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $persistenceManager;

    /**
     * @var array
     */
    protected $DTOData = [];

    /**
     * Function for Handling the Import Job (calling in CommandController)
     * @param array $extensionConfiguration
     * @return int
     */
    public function importFromCLI(array $extensionConfiguration)
    {
        $collections = [];
        if ($extensionConfiguration['importCollections'] != null) {
            // Transfer Collection from ExtensionConfiguration to CollectionConfigArray
            foreach (explode(',', $extensionConfiguration['importCollections']) as $collection) {
                $collections[] = [
                    'name' => $this->checkForWrongCollectionName(ucfirst(trim($collection))),
                    'className' => $this->checkIfClassExists(
                        $this->checkForWrongCollectionName(ucfirst(trim($collection))),
                        self::TNREPRO
                    )
                ];
            }

            // Import all Collections
            foreach ($collections as $importCollection) {
                $this->fetchAndImport($importCollection['className'], $importCollection['name'], $extensionConfiguration);
            }

            // Import was successfull
            return self::SUCCESSFULL;
        } else {
            throw new \Error('No Collection was defined in ExtensionConfiguration');
        }
    }

    /**
     * @param string $collectionRepository
     * @param string $collectionName
     * @param array $extensionConfig
     * @return int
     * @throws \TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     */
    public function fetchAndImport(string $collectionRepository, string $collectionName, array $extensionConfig): int
    {
        /* @var CockpitImportUtility $importUtil */
        $importUtil = GeneralUtility::makeInstance(CockpitImportUtility::class);
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);

        // If not a ReproCollection write to DTO Array
        if ($collectionRepository !== false && !empty($collectionRepository)) {
            $repository = $objectManager->get($collectionRepository);
            $persistManager = $objectManager->get(PersistenceManager::class);

            foreach ($importUtil->getCockpitData(strtolower($collectionName), $extensionConfig)->entries as $key => $cockpitCollectionItem) {
                // Check if new or just a update and set ID
                $isUnique = $repository->countByCpid($cockpitCollectionItem->_id);
                if ((int)$isUnique > 0) {
                    $collectionItem = $repository->findOneByCpid($cockpitCollectionItem->_id);
                } else {
                    $collectionItem = GeneralUtility::makeInstance(self::TNMODEL . ucfirst($collectionName));
                }

                // Delete old Mediafiles from Storange
                if ($isUnique > 0 && $collectionItem->getUid() !== null) {
                    $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
                    $fileObjects = $fileRepository->findByRelation(
                        'tx_techradar_domain_model_' . strtolower($collectionName),
                        'media',
                        $collectionItem->getUid()
                    );
                    foreach ($fileObjects as $fileObject) {
                        $file = $fileObject->getOriginalFile();
                        $file->getStorage()->deleteFile($file);
                    }
                    $persistManager->persistAll();
                }

                // Pass Data to Model
                $collectionItem->setCpid($cockpitCollectionItem->_id);
                $collectionItem->setPid((int) $extensionConfig['cockpitDataPid'] ?? 0);
                $collectionItem = $this->dynamicSetter(
                    ['title','subtitle','title_slug','slugadditional','teaser','bodytext', 'bodytext2',
                        'visible','icon','area','status','quadrant','level','mediabgcolor'],
                    $collectionItem,
                    $cockpitCollectionItem
                );
                $collectionItem->setTags($cockpitCollectionItem->tags ? implode(',', $cockpitCollectionItem->tags) : '');
                // Handle Media from $cockpitCollectionItem and create FileReference
                $mediaUtil = GeneralUtility::makeInstance(CockpitMediaUtility::class);
                if ($mediaUtil->getMedia($cockpitCollectionItem->media, $collectionItem, $collectionName) !== null) {
                    $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
                    $fileObject = $resourceFactory->getFileObject($mediaUtil->getMedia($cockpitCollectionItem->media, $collectionItem, $collectionName)->getProperty('uid'));
                    $fileReference = $objectManager->get(FileReference::class);
                    $fileReference->setFile($fileObject);
                    $fileReference->setPid((int) $extensionConfig['cockpitDataPid'] ?? 0);
                    $fileReference->setUidLocal($fileObject);
                    $collectionItem->setMedia($fileReference ?? null);
                }

                // Set Urls for Solr
                if ($collectionName === 'Techradar') {
                    $collectionItem->setBaseurl($extensionConfig['techradarUrl']);
                    $collectionItem->setUrl(
                        $extensionConfig['techradarUrl'] . ($this->DTOData['quadrant'][$cockpitCollectionItem->quadrant]) . '/' . $collectionItem->getTitleSlug()
                    );
                } elseif ($collectionName === 'Lernplan') {
                    $collectionItem->setBaseurl($extensionConfig['techradarUrl']);
                    $collectionItem->setUrl(
                        $extensionConfig['lernplanUrl'] . $collectionItem->getTitleSlug()
                    );
                } else {
                    $collectionItem->setBaseurl('#');
                    $collectionItem->setUrl('#');
                }

                // Save the Item
                if ((int)$isUnique > 0) {
                    $repository->update($collectionItem);
                } else {
                    $repository->add($collectionItem);
                }
                $persistManager->persistAll();
                unset($collectionItem);
            }
            return self::SUCCESSFULL;
        } else {
            $this->DTOData[strtolower($collectionName)] = [];
            foreach ($importUtil->getCockpitData($collectionName, $extensionConfig)->entries as $collectionDtoItem) {
                $this->DTOData[strtolower($collectionName)][$collectionDtoItem->Identifier] = $collectionDtoItem->title_slug;
            }
            return self::SUCCESSFULL;
        }
    }

    /**
     * @param array $fields
     * @param mixed $collectionItem
     * @param mixed $cockpitCollectionItem
     * @return mixed
     */
    public function dynamicSetter(array $fields, $collectionItem, $cockpitCollectionItem)
    {
        foreach ($fields as $setterField) {
            // Prepare SetterField (underscore to UpperCammelcase)
            $validSetterField = preg_replace_callback("/_[a-z]?/", function ($matches) {
                return strtoupper(ltrim($matches[0], "_"));
            }, $setterField);

            // Check if Model has SetterMethod and execute
            if (method_exists($collectionItem, 'set' . ucfirst($validSetterField))) {
                $collectionItem->{'set' . ucfirst($validSetterField)}($cockpitCollectionItem->{$setterField} ?? '');
            }
        }
        return $collectionItem;
    }

    /**
     * Workaround for wrong named Collection
     * @TODO: Change Naming in Cockpit
     * @param string $collectionName
     * @return string
     */
    public function checkForWrongCollectionName(string $collectionName)
    {
        if ($collectionName == 'Leanplan') {
            return 'Lernplan';
        } else {
            return $collectionName;
        }
    }

    /**
     * @param string $collectionName
     * @param string $namespace
     * @return bool|string
     */
    public function checkIfClassExists(string $collectionName, string $namespace)
    {
        if (class_exists($namespace . $collectionName . 'Repository')) {
            return $namespace . $collectionName . 'Repository';
        } else {
            return false;
        }
    }
}
