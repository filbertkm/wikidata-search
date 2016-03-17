<?php

namespace WikidataSearch\Console;

use Symfony\Component\Console\Output\OutputInterface;
use Wikibase\DataModel\Entity\EntityDocument;
use WikibaseDumpProcessor\EntityHandler;

class ConsoleEntityHandler implements EntityHandler {

	/**
	 * @var OutputInterface
	 */
	private $output;

	/**
	 * @param OutputInterface $output
	 */
	public function setOutput( OutputInterface $output ) {
		$this->output = $output;
	}

	/**
	 * @param EntityDocument $entity
	 */
	public function handleEntity( EntityDocument $entity ) {
		$this->output->writeln( get_class( $entity ) );
	}

}
