<?php
namespace BartoszFabianski\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use BartoszFabianski\Core\Utils\Fetch;
use BartoszFabianski\Core\Utils\CsvManager;

class CsvSimpleCommand extends Command {

    protected function configure(){
        $this->setName("csv:simple")
                ->setDescription("Downloads .xml file from given URL.")
                ->addArgument('URL', InputArgument::REQUIRED, 'Type URL to fetch RSS feed.')
                ->addArgument('PATH', InputArgument::REQUIRED, 'Path to .csv file. If file doesnt');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $fetch = new Fetch();
        $csvManager = new CsvManager();

        $url = $input->getArgument('URL');
        $path = $input->getArgument('PATH');

        $feed = $fetch->fetch($url);
        $csvManager->saveSimple($path, $feed);

        $output->writeln('Your csv file is saved.');

    }

}
