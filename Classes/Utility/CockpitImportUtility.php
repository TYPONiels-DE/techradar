<?php

namespace TN\Techradar\Utility;

use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Inject;

class CockpitImportUtility
{

    /**
     * @var RequestFactory
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $requestFactory = null;

    /**
     * @throws \Exception
     */
    public function getCockpitData(string $collection = null, array $extensionConfig = [])
    {
        if ($this->requestFactory == null) {
            $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        }

        if ($collection == 'lernplan') {
            $collection = 'leanplan';
        }
        $response = $this->requestFactory->request( $extensionConfig['cockpitUrl'] . '/api/collections/get/' . $collection,
            'GET',
            $additionalOptions = [
                'headers' => ['Cache-Control' => 'no-cache', 'Cockpit-Token' => $extensionConfig['cockpitToken']],
                'allow_redirects' => true,
                'cookies' => false,
            ]
        );
        if ($response->getStatusCode() === 200) {
            if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
                return json_decode($response->getBody()->getContents());
            } else {
                return 'No JSON-Response from Cockpit';
            }
        } else {
            throw new \Exception('Not Authenticated');
        }
    }



}