<?php

namespace WikidataSearch;

use Silex\Application;

class Controller {

	public function indexAction( Application $app ) {
		return $app['twig']->render( 'index.html', array(
			'title' => 'Wikidata search'
		) );
	}

}
