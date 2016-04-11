<?php

namespace WikidataSearch\Console\Commands;

use Elastica\Client;
use Elastica\Index;
use Elastica\Type;
use Elastica\Type\Mapping;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wikibase\Elastic\Mapping\WikibaseMappingBuilder;

class BuildMappingCommand extends Command {

	/**
	 * @var string[]
	 */
	private $languageCodes;

	protected function configure() {
		$this->setName( 'build-mapping' )
			->setDescription( 'Build ElasticSearch mapping' )
			->addArgument(
				'name',
				InputArgument::REQUIRED,
				'Index name'
			)
			->addArgument(
				'type',
				InputArgument::REQUIRED,
				'Type name'
			);
	}

	public function setServices( array $languageCodes ) {
		$this->languageCodes = $languageCodes;
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
		$type = new Type( $index, $input->getArgument( 'type' ) );

		$wikibaseMappingBuilder = new WikibaseMappingBuilder( $this->languageCodes );
		$properties = $wikibaseMappingBuilder->getProperties();

		$mapping = new Mapping( $type, $properties );
		$res = $mapping->send();

		var_export( $res );

		$output->writeln( "done" );
	}

}
