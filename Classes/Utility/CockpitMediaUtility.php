<?php

namespace TN\Techradar\Utility;

use TN\Typoniels\Utility\FalUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TN\Techradar\Utility\FalmediaUtility;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection as CropVariantCollection;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class CockpitMediaUtility
{

    /**
     * @var RequestFactory
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $requestFactory = null;

    /**
     * @var \TYPO3\CMS\Extbase\Service\ImageService
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $imageService = null;

    /**
     * @param $media
     * @param object $cockpitRadarItem
     * @return string
     * @throws \Exception
     */
    public function getMedia($media, object $cockpitRadarItem, string $collectionName)
    {
        if ($this->requestFactory == null) {
            $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        }

        /* @var ExtensionConfiguration $extensionConfiguration */
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('techradar');

        /* @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);

        // Fetch Media
        $response = $this->requestFactory->request(
            $extensionConfiguration['cockpitUrl'] . '/api/cockpit/image?token=' . $extensionConfiguration['cockpitToken'],
            'POST',
            [
                'headers' => ['Cache-Control' => 'no-cache', 'Content-Type' => 'application/json'],
                'allow_redirects' => false,
                'body' => json_encode([
                    'src' => $extensionConfiguration['cockpitUrl'] . '/storage/uploads' . $media->path,
                    'm' => 'fitToWidth', 'w' => 780, 'h' => 400, 'q' => 85
                ]),
                'cookies' => false,]
        );

        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                $falUtil = $objectManager->get(\TN\Techradar\Utility\FalmediaUtility::class);
                $pManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
                return $falUtil->tempoaryFile(
                    $response->getBody()->getContents(),
                    strtolower($collectionName) . '-' . $media->_id . '-' . $cockpitRadarItem->_id,
                    $collectionName
                );
            } else {
                return 'No Image was provided.';
            }
        } else {
            throw new \Exception($response->getStatusCode() . 'Not Authenticated');
        }
    }

    /**
     * @param $imageResource
     * @param string $cropVariant
     * @return string
    */
    public function getSmallImage($imageResource, $cropVariant = 'default')
    {
        if ($this->imageService == null) {
            $this->imageService = GeneralUtility::makeInstance(ImageService::class);
        }
        $image = $this->imageService->getImage($this->getImageUrl($imageResource), null, false);
        $cropVariantCollection = CropVariantCollection::create((string)$imageResource->getOriginalResource()->getProperty('crop'));
        $cropArea = $cropVariantCollection->getCropArea($cropVariant);
        $processingInstructions = [
            'maxWidth' => 900,
            'maxHeight' => 500,
            'crop' => $cropArea->makeAbsoluteBasedOnFile($image),
        ];
        $processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
        return $this->imageService->getImageUri($processedImage, true);
    }

    /**
     * @param $imageResource
     * @return mixed
    */
    public function getImageUrl($imageResource)
    {
        return $imageResource->getOriginalResource()->getOriginalFile()->getPublicUrl();
    }
}