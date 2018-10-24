<?php
namespace AppBundle\Command;

use AppBundle\Entity\Sequences;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NumSeqCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:numseq')
            ->setDescription('Get max value of sequence.')
            ->addArgument('n', InputArgument::IS_ARRAY, 'N values (separate multiple values with a space)'); ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Start.....');
        $arr_result = array();
        $arr_n = $input->getArgument('n');
    
        $seqs = new Sequences($arr_n);
        $arr_result = $seqs->countMaxSequences();
            
        $output->writeln(str_pad('INPUT', 20).str_pad('OUTPUT',20));
        foreach($arr_result as $result) {
            $output->writeln(str_pad($result['n'], 20) . str_pad($result['result'], 20));
        }

        $output->writeln('.....End');
    }
}