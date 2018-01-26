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

class CsvExtendedCommand extends Command {

    protected function configure(){
        $this->setName("csv:extended")
                ->setDescription("Fetch RSS channel data from given URL and save it to .csv file in given path. If file exists content will be added to the end of file.")
                ->addArgument('URL', InputArgument::REQUIRED, 'URL to fetch RSS feed.')
                ->addArgument('PATH', InputArgument::REQUIRED, 'Path to .csv file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $fetch = new Fetch();
        $csvManager = new CsvManager();

        $url = $input->getArgument('URL');
        $path = $input->getArgument('PATH');

        $feed = $fetch->fetch($url);
        $csvManager->saveExtended($path, $feed);

        $output->writeln('Your csv file is saved.');

    }

}
