<?php

namespace Pitchart\Typo3Installer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Install TYPO3-CMS using get.typo3.org
 *
 * @package Pitchart\Typo3Installer\Command
 * @author Julien VITTE <vitte.julien@gmail.com>
 */
class GetCommand extends Command implements ContainerAwareInterface {

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
            ->setName('typo3:get')
            ->setDescription('Download a new TYPO3')
            ->addArgument('version', InputArgument::OPTIONAL, 'TYPO3 version', 'current')
            ->addArgument('target', InputArgument::OPTIONAL, 'Target path', './')
            ->addOption('disable-apache', null, InputOption::VALUE_NONE, 'Do not use apache htaccess configuration')
            ->addOption('no-symlink', null, InputOption::VALUE_NONE, 'Do not create symlinks')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Rename the typo3_src folder')
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
        $output->writeln('Downloading TYPO3 '.$input->getArgument('version'));
        $downloader = $this->container->get('downloader');
        $typo3Directory = realpath($input->getArgument('target')).'/';
        $target = $typo3Directory.$input->getArgument('version').'.tgz';
        $downloader->download($input->getArgument('version'), $target);

        if (file_exists($target)) {
            $output->writeln('Extract '.pathinfo($target, PATHINFO_FILENAME));
            $extractor = $this->container->get('extractor');
            $extracted = $extractor->extract($target, true);
            $output->writeln('Extracted in '.$extracted);
            if ($extracted !== false) {
                // Create the symlinks in your Document Root
                if (!$input->getOption('no-symlink')) {
                    exec(sprintf('cd %s && ln -s typo3_src-%s typo3_src', $typo3Directory, $input->getArgument('version')));
                    exec(sprintf('cd %s && ln -s typo3_src/index.php', $typo3Directory));
                    exec(sprintf('cd %s && ln -s typo3_src/typo3', $typo3Directory));
                }
                // FIX filemode for cli_dispatcher command
                exec(sprintf('chmod +x %s/typo3/cli_dispatch.phpsh', $extracted));

                if (!$input->getOption('disable-apache')) {
                    exec(sprintf('cp %s/_.htaccess %s/.htaccess', $extracted, $typo3Directory));
                }
                if ($input->getOption('name')) {
                    exec(sprintf('mv %1$s/typo3_src-%2$s %1$s/%3$s', $typo3Directory, $input->getArgument('version'), $input->getOption('name')));
                }
            }
        }
/*
# wget http://get.typo3.org/$1 -O $1.tgz;
# tar -zxvf $1.tgz;
mv typo3_src-$1/ $1/;
# rm $1.tgz;
chmod +x $1/typo3/cli_dispatch.phpsh;
 */
    }
}