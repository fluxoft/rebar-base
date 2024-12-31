<?php

namespace RebarBase;

use Fluxoft\Rebar\Config;

// Define configuration sources:
$sources = [];
$sources['array'] = [
	'app' => [
		'env' => 'development',
		'name' => 'RebarBase',
		'debug' => true,
	],
];
$sources['ini'] = __DIR__ .	'/../config/app.ini'; // Path to the INI file
$sources['json'] = __DIR__.'/../config/app.json'; // Path to the JSON file
$sources['dotenv'] = __DIR__.'/../.env'; // Path to the .env file
$sources['env'] = null; // Use the environment variables

// Initialize the Config object
Config::Instance($sources);
