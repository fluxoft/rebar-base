<?php

namespace RebarBase;

use Fluxoft\Rebar\Http\Middleware\Auth;

return [
	// Add other middleware here if needed
	new Auth([
		'/protected'      => $container['WebAuth'], // Example: Protect a specific route
		'/main/protected' => $container['WebAuth'], // Since this route can be reached this way as well, it should also be protected.
		'/'               => null                   // All other routes are open
	]),
];
