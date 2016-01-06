<?php


namespace Pitchart\Typo3Installer;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Application
 * @package Pitchart\Typo3Installer
 * @author Julien VITTE <vitte.julien@gmail.com>
 */
class Application extends ConsoleApplication implements ContainerAwareInterface {

    protected $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->injectContainer();
        parent::doRun($input, $output);
    }

    /**
     * Inject Service container to all commands
     */
    private function injectContainer()
    {
        foreach ($this->all() as $command) {
            if ($command instanceof ContainerAwareInterface) {
                $command->setContainer($this->container);
            }
        }
    }
}