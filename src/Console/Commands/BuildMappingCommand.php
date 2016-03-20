<?php

namespace WikidataSearch\Console\Commands;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildMappingCommand extends Command {

	protected function configure() {
		$this->setName( 'build-mapping' )
			->setDescription( 'Build ElasticSearch mapping' );
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$output->writeln( "done" );
	}

}
