<?php
namespace Correction\TP1\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class FormationTP1HelloWorld extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('formation:tp1:helloworld')->setDescription('Cette command affiche un message simple');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Ceci est un message simple :)');
    }
}
