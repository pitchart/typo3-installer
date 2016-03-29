<?php
/**
 * Created by PhpStorm.
 * User: jvitte
 * Date: 03/03/16
 * Time: 13:28
 */

namespace Pitchart\Typo3Installer\Model;


class Installation implements InstallationInterface
{

    private $folderName;

    private $target;

    private $version;

    private $copyHtaccess;

    private $createSymlinks;

    /**
     * Installation constructor.
     * @param $folderName
     * @param $target
     * @param $version
     * @param $copyHtaccess
     * @param $createSymlinks
     */
    public function __construct($version, $target, $folderName, $copyHtaccess, $createSymlinks)
    {
        $this->folderName = $folderName;
        $this->target = $target;
        $this->version = $version;
        $this->copyHtaccess = $copyHtaccess;
        $this->createSymlinks = $createSymlinks;
    }

    public function getSourcesPath() {
        return realpath($this->target.'/'.$this->folderName);
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @return mixed
     */
    public function getCreateSymlinks()
    {
        return $this->createSymlinks;
    }

    /**
     * @return mixed
     */
    public function getCopyHtaccess()
    {
        return $this->copyHtaccess;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getFolderName()
    {
        return $this->folderName;
    }

    public function isReady() {
        return file_exists($this->target) && is_dir($this->target);
    }

}