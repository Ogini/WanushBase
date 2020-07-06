<?php


namespace Wanush\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestCommand
 * @package Wanush\Commands
 */
class TestCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'wanush:test';

    /**
     * @return void
     */
    protected function configure() {
        $this
            ->setDescription('This is a test')
            ->setHelp('This is only a test')
            ->addArgument('name', InputArgument::OPTIONAL, 'Name:');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $name = $input->getArgument('name');
        dump($name);
        $output->writeln('This was a test: ' . $name);
        return Command::SUCCESS;
    }
}
