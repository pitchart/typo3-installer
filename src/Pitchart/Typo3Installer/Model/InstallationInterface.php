<?php

namespace Pitchart\Typo3Installer\Model;

interface InstallationInterface
{
    /**
     * @return string
     */
    public function getSourcesPath();

    /**
     * @return string
     */
    public function getTarget();

    /**
     * @return boolean
     */
    public function getCreateSymlinks();

    /**
     * @return boolean
     */
    public function getCopyHtaccess();

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @return mixed
     */
    public function getFolderName();

    /**
     * @return boolean
     */
    public function isReady();
}