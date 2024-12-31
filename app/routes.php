<?php

namespace RebarBase;

use Fluxoft\Rebar\Http\Route;

$routes = [];

$routes[] = new Route('/protected', 'Main', 'Protected');

return $routes;
