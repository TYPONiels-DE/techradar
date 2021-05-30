<?php

namespace TN\Techradar\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Techradar
 *
 * @package TN\Techradar\Domain\Model
 */
class Techradar extends AbstractEntity
{
    /**
     * @var int
     */
    protected $uid;
    /**
     * @var string
     */
    protected $title = '';
    /**
     * @var string|null
     */
    protected $titleSlug = '';
    /**
     * @var string|null
     */
    protected $subtitle = '';
    /**
     * @var string|null
     */
    protected $slugadditional = '';
    /**
     * @var int
     */
    protected $visible = 0;
    /**
     * @var string|null
     */
    protected $teaser = '';
    /**
     * @var string|null
     */
    protected $bodytext = '';
    /**
     * @var string|null
     */
    protected $icon = '';
    /**
     * @var string|null
     */
    protected $tags = '';
    /**
     * @var string|null
     */
    protected $status = '';
    /**
     * @var string|null
     */
    protected $quadrant = '';
    /**
     * @var string|null
     */
    protected $area = '';
    /**
     * @var string|null
     */
    protected $level = '';
    /**
     * @var string|null
     */
    protected $mediabgcolor = '';
    /**
     * @var string
     */
    protected $cpid = '';

    /**
     * @var string
     */
    protected $baseurl = 'https://radar.niels-langlotz.com/technologien/';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * media
     *
     * @var \TN\Techradar\Domain\Model\FileReference
     */
    protected $media = 0;

    /**
     * image
     *
     * @var \TN\Techradar\Domain\Model\FileReference
     */
    protected $promotiomedia = 0;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getTitleSlug(): ?string
    {
        return $this->titleSlug;
    }

    /**
     * @param string|null $titleSlug
     */
    public function setTitleSlug(?string $titleSlug): void
    {
        $this->titleSlug = $titleSlug;
    }

    /**
     * @return string|null
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param string|null $subtitle
     */
    public function setSubtitle(?string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string|null
     */
    public function getSlugadditional(): ?string
    {
        return $this->slugadditional;
    }

    /**
     * @param string|null $slugadditional
     */
    public function setSlugadditional(?string $slugadditional): void
    {
        $this->slugadditional = $slugadditional;
    }

    /**
     * @return int
     */
    public function getVisible(): int
    {
        return $this->visible;
    }

    /**
     * @param int $visible
     */
    public function setVisible(int $visible): void
    {
        $this->visible = $visible;
    }

    /**
     * @return string|null
     */
    public function getTeaser(): ?string
    {
        return $this->teaser;
    }

    /**
     * @param string|null $teaser
     */
    public function setTeaser(?string $teaser): void
    {
        $this->teaser = $teaser;
    }

    /**
     * @return string|null
     */
    public function getBodytext(): ?string
    {
        return $this->bodytext;
    }

    /**
     * @param string|null $bodytext
     */
    public function setBodytext(?string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return string|null
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * @param string|null $tags
     */
    public function setTags(?string $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getQuadrant(): ?string
    {
        return $this->quadrant;
    }

    /**
     * @param string|null $quadrant
     */
    public function setQuadrant(?string $quadrant): void
    {
        $this->quadrant = $quadrant;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param string|null $area
     */
    public function setArea(?string $area): void
    {
        $this->area = $area;
    }

    /**
     * @return string|null
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * @param string|null $level
     */
    public function setLevel(?string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string|null
     */
    public function getMediabgcolor(): ?string
    {
        return $this->mediabgcolor;
    }

    /**
     * @param string|null $mediabgcolor
     */
    public function setMediabgcolor(?string $mediabgcolor): void
    {
        $this->mediabgcolor = $mediabgcolor;
    }

    /**
     * @return string
     */
    public function getCpid(): string
    {
        return $this->cpid;
    }

    /**
     * @param string $cpid
     */
    public function setCpid(string $cpid): void
    {
        $this->cpid = $cpid;
    }

    /**
     * @return string
     */
    public function getBaseurl(): string
    {
        return $this->baseurl;
    }

    /**
     * @param string $baseurl
     */
    public function setBaseurl(string $baseurl): void
    {
        $baseurl = $this->baseurl;
        $this->baseurl = $baseurl;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return \TN\Techradar\Domain\Model\FileReference
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param \TN\Techradar\Domain\Model\FileReference $media
     */
    public function setMedia($media): void
    {
        $this->media = $media;
    }

    /**
     * @return \TN\Techradar\Domain\Model\FileReference
     */
    public function getPromotiomedia()
    {
        return $this->promotiomedia;
    }

    /**
     * @param \TN\Techradar\Domain\Model\FileReference $promotiomedia
     */
    public function setPromotiomedia($promotiomedia): void
    {
        $this->promotiomedia = $promotiomedia;
    }

    /**
     * @param  string $heroimagePosition
     * @return void
     */
    public function setHeroimagePosition($heroimagePosition)
    {
        $this->heroimagePosition = $heroimagePosition;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param  \TYPO3\CMS\Extbase\Persistence\ObjectStorage $images
     * @return void
     */
    public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
    {
        $this->images = $images;
    }
}
