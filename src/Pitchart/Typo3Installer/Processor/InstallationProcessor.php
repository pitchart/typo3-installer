<?php
/**
 * Created by PhpStorm.
 * User: jvitte
 * Date: 03/03/16
 * Time: 13:40
 */

namespace Pitchart\Typo3Installer\Processor;


use Pitchart\Typo3Installer\Model\Installation;
use Pitchart\Typo3Installer\Service\Process;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class InstallationProcessor implements ContainerAwareInterface {

    use ContainerAwareTrait;

    /**
     * @var \ArrayIterator
     */
    private $processes;

    public function __construct(\ArrayIterator $processes = null) {
        if ($processes === null) {
            $processes = new \ArrayIterator();
        }
        $this->processes = $processes;

    }

    public function process(Installation $installation) {
        /** @var Process $process */
        foreach ($this->processes as $process) {
            $process->execute($installation);
        }
    }

    public function addProcess(Process $process) {
        $this->processes->append($process);
    }


}