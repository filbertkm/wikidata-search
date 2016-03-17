<?php

namespace WikidataSearch;

use Knp\Command\Command;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Application;
use WikibaseDumpProcessor\Services;
use WikidataSearch\Console\CommandRegistry;

class App {

	private $app;

	private $console;

	private $commandRegistry;

	public function __construct() {
		$this->app = new Application();
		$this->app['debug'] = true;

		$this->init();

		$this->commandRegistry = new CommandRegistry( new Services() );
		$this->initCommands();
	}

	public function init() {
		$this->app->register( new ConsoleServiceProvider(), array(
			'console.name' => 'WikidataSearch',
			'console.version' => '1.0.0',
			'console.project_directory' => __DIR__ . '/Console'
		) );

		$this->console = $this->app['console'];
	}

	private function initCommands() {
		foreach ( $this->commandRegistry->getCommands() as $command ) {
			$this->console->add( $command );
		}
	}

	public function registerCommand( Command $command ) {
		$this->console->add( $command );
	}

	public function run() {
		$this->console->run();
	}

}
