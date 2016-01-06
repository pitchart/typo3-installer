<?php


namespace Pitchart\Typo3Installer;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Application extends ConsoleApplication implements ContainerAwareInterface {

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }


}