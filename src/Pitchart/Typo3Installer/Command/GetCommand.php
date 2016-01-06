<?php

namespace Pitchart\Typo3Installer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetCommand extends Command {

    protected function configure()
    {
        $this
            ->setName('typo3:get')
            ->setDescription('Download a new TYPO3')
            ->addArgument('version', InputArgument::OPTIONAL, 'TYPO3 version', 'current')
            ->addArgument('target', InputArgument::OPTIONAL, 'Target path', './')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Downloading TYPO3 '.$input->getArgument('version'));
/*
wget http://get.typo3.org/$1 -O $1.tgz;
tar -zxvf $1.tgz;
mv typo3_src-$1/ $1/;
rm $1.tgz;
chmod +x $1/typo3/cli_dispatch.phpsh;
 */
        $output->writeln('Hello World');
    }
}