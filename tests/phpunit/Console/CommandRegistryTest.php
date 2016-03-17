<?php

namespace WikidataSearch\Tests;

use PHPUnit_Framework_TestCase;
use WikibaseDumpProcessor\Services;
use WikidataSearch\Console\CommandRegistry;
use WikidataSearch\Console\Commands\ProcessDumpCommand;

/**
 * @covers WikidataSearch\Console\CommandRegistry
 *
 * @licence GNU GPL v2+
 * @author Katie Filbert < aude.wiki@gmail.com >
 */
class CommandRegistryTest extends PHPUnit_Framework_TestCase {

	public function testGetCommands() {
		$services = new Services();
		$commandRegistry = new CommandRegistry( $services );

		$processDumpCommand = new ProcessDumpCommand();
		$processDumpCommand->setServices( $services->newEntityDeserializer() );

		$expected = array( $processDumpCommand );

		$this->assertEquals( $expected, $commandRegistry->getCommands() );
	}

}
