<?php

namespace WikidataSearch\Console;

use WikibaseDumpProcessor\Services;
use WikidataSearch\Console\Commands\BuildMappingCommand;
use WikidataSearch\Console\Commands\ProcessDumpCommand;

class CommandRegistry {

	private $services;

	public function __construct( Services $services ) {
		$this->services = $services;
	}

	public function getCommands() {
		$commands = array(
			new BuildMappingCommand(),
			$this->newProcessDumpCommand()
		);

		return $commands;
	}

	private function newProcessDumpCommand() {
		$command = new ProcessDumpCommand();
		$command->setServices(
			$this->services->newEntityDeserializer()
		);

		return $command;
	}

}
