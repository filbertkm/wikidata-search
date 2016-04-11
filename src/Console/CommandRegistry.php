<?php

namespace WikidataSearch\Console;

use WikibaseDumpProcessor\Services;
use WikidataSearch\Console\Commands\BuildMappingCommand;
use WikidataSearch\Console\Commands\CreateIndexCommand;
use WikidataSearch\Console\Commands\DeleteIndexCommand;
use WikidataSearch\Console\Commands\ProcessDumpCommand;

class CommandRegistry {

	private $services;

	public function __construct( Services $services ) {
		$this->services = $services;
	}

	public function getCommands() {
		$commands = array(
			$this->newBuildMappingCommand(),
			new CreateIndexCommand(),
			new DeleteIndexCommand(),
			$this->newProcessDumpCommand()
		);

		return $commands;
	}

	private function newBuildMappingCommand() {
		$command = new BuildMappingCommand();
		$command->setServices(
			[ 'ar', 'de', 'en', 'es', 'fr', 'ja' ]
		);

		return $command;
	}

	private function newProcessDumpCommand() {
		$command = new ProcessDumpCommand();
		$command->setServices(
			$this->services->newEntityDeserializer()
		);

		return $command;
	}

}
