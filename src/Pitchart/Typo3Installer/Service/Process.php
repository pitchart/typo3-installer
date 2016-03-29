<?php

namespace Pitchart\Typo3Installer\Service;

use Pitchart\Typo3Installer\Model\InstallationInterface;

interface Process
{
    public function execute(InstallationInterface $installation);

}