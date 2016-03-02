<?php
/**
 * Created by PhpStorm.
 * User: jvitte
 * Date: 02/03/16
 * Time: 13:35
 */

namespace Pitchart\Typo3Installer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class FixPermissionsCommand extends Command implements ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Command configuration
     */
    protected function configure()
    {
        $this
            ->setName('typo3:fix')
            ->setDescription('Fixes execution permissions for cli_dispatcher')
            ->addArgument('target', InputArgument::OPTIONAL, 'Target path', './')
        ;
    }

    /**
     * Command execution
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $typo3Directory = realpath($input->getArgument('target')).'/';
        // FIX filemode for cli_dispatcher command
        $fixer = $this->container->get('permissionsFixer');
        $fixer->execute($typo3Directory);
    }

}