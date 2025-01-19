<?php

namespace RebarBase;

use Fluxoft\Rebar\Exceptions\AuthenticationException;
use Fluxoft\Rebar\Exceptions\RouterException;
use Fluxoft\Rebar\Http\Environment;
use Fluxoft\Rebar\Http\Request;
use Fluxoft\Rebar\Http\Response;
use Fluxoft\Rebar\Http\Router;

require_once __DIR__ . '/../vendor/autoload.php';

// Set error handling
require_once __DIR__ . '/error_handling.php';

// Initialize config
require_once __DIR__ . '/config.php';

// Load in container, custom routes, and middleware stack
$container  = require_once __DIR__ . '/container.php';
$routes     = require_once __DIR__ . '/routes.php';
$middleware = require_once __DIR__ . '/middleware.php';

$router = new Router(
	'RebarBase\\Controllers\\',
	[$container]
);
$router->SetMiddlewareStack($middleware);
$router->AddRoutes($routes);

// Set presenters
$router->AddPresenter('/', $container['PhtmlPresenter']);
$router->AddPresenter('/api', $container['JsonPresenter']);

// Create the request and response objects
$request  = new Request(Environment::GetInstance());
$response = new Response();

$router->Route($request, $response);
