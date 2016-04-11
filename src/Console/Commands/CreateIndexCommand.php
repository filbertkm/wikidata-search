<?php

namespace WikidataSearch\Console\Commands;

use Elastica\Client;
use Elastica\Index;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wikibase\Elastic\Index\IndexCreator;

class CreateIndexCommand extends Command {

	protected function configure() {
		$this->setName( 'create-index' )
			->setDescription( 'Create ElasticSearch index' )
			->addArgument(
				'name',
				InputArgument::REQUIRED,
				'Index name'
			);
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$client = new Client( [
			'servers' => [
				[
					'host' => '127.0.0.1'
				]
			]
		] );

		$index = new Index( $client, $input->getArgument( 'name' ) );

		$indexCreator = new IndexCreator();
		$indexCreator->create( $index );

		$output->writeln( "done" );
	}

}
