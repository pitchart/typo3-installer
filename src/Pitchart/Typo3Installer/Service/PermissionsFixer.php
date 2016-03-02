<?php

namespace Pitchart\Typo3Installer\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Class PermissionsFixer
 * @package Pitchart\Typo3Installer\Service
 */
class PermissionsFixer
{
    protected $script = 'typo3/cli_dispatch.phpsh';

    public function execute($typo3SrcPath) {
        if (file_exists($typo3SrcPath) && file_exists(sprintf('%s/%s', $typo3SrcPath, $this->script))) {
            exec(sprintf('chmod +x %s/%s', $typo3SrcPath, $this->script));
            return;
        }
        throw new FileNotFoundException('Invalid TYPO3 source folder : '.$typo3SrcPath);
    }
}