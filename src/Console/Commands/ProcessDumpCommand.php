<?php

namespace WikidataSearch\Console\Commands;

use Deserializers\DispatchingDeserializer;
use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WikibaseDumpProcessor\JsonDumpProcessor;
use WikidataSearch\Console\ConsoleEntityHandler;

class ProcessDumpCommand extends Command {

	private $entityDeserializer;

	public function setServices( DispatchingDeserializer $entityDeserializer ) {
		$this->entityDeserializer = $entityDeserializer;
	}

	protected function configure() {
		$this->setName( 'process-dump' )
			->setDescription( 'Process dump' )
			->addArgument(
				'file',
				InputArgument::REQUIRED,
				'Dump file'
			);
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$jsonDumpProcessor = new JsonDumpProcessor(
			$this->entityDeserializer,
			$this->getEntityHandler( $output )
		);

		$dumpFile = $input->getArgument( 'file' );

		$jsonDumpProcessor->process( $dumpFile );
	}

	private function getEntityHandler( OutputInterface $output ) {
		$entityHandler = new ConsoleEntityHandler();
		$entityHandler->setOutput( $output );

		return $entityHandler;
	}

}
