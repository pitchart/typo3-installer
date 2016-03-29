<?php

namespace Pitchart\Typo3Installer\Service;

use AdamBrett\ShellWrapper\Runners\Runner;
use Pitchart\Typo3Installer\Model\InstallationInterface;

interface Process
{
    public function execute(Runner $runner, InstallationInterface $installation);

}