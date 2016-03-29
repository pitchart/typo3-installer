<?php

namespace Pitchart\Typo3Installer\Service;
use AdamBrett\ShellWrapper\Runners\Runner;
use AdamBrett\ShellWrapper\Command\Builder as CommandBuilder;
use Pitchart\Typo3Installer\Model\InstallationInterface;

/**
 * Class Downloader
 * @package Pitchart\Typo3Installer\Service
 * @author Julien VITTE <vitte.julien@gmail.com>
 */
class Downloader implements Process{

    /**
     * @var string
     */
    protected $url;

    protected $commandName = 'wget';

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
        $logs = [];
        exec(sprintf('wget %1$s --content-disposition -O %2$s 2> /dev/null', $this->getUrl($version), $target), $logs);
        if (@file_exists($target.'/'.$version.'.tgz')) {
            return $target.'/'.$version.'.tgz';
        }
        return '';
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
    public function execute(Runner $runner, InstallationInterface $installation) {
        $command = (new CommandBuilder($this->commandName))
            ->addParam($this->getUrl($installation->getVersion()))
            ->addArgument('content-disposition')
            ->addFlag('O', $installation->getTarget())
        ;
        $runner->run($command);
    }
}