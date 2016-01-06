<?php

namespace Pitchart\Typo3Installer\Service;

/**
 * Class Downloader
 * @package Pitchart\Typo3Installer\Service
 * @author Julien VITTE <vitte.julien@gmail.com>
 */
class Downloader {

    /**
     * @var string
     */
    protected $url;

    /**
     * @param string $url
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * @param string $version
     * @param string $target
     * @return string
     */
    public function download($version, $target) {
        return $this->execute($version, $target);
    }

    /**
     * @param $version
     * @return string
     */
    public function getUrl($version) {
        return sprintf('%s/%s', $this->url, $version);
    }

    /**
     * @param string $version
     * @param string $target
     * @return string
     */
    protected function execute($version, $target) {
        $logs = [];
        exec(sprintf('wget %1$s --content-disposition -O %2$s 2> /dev/null', $this->getUrl($version), $target), $logs);
        if (@file_exists($target.'/'.$version.'.tgz')) {
            return $target.'/'.$version.'.tgz';
        }
        return '';
    }
}