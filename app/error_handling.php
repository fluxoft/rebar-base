<?php

namespace RebarBase;

use Fluxoft\Rebar\Error\ErrorHandler;
use Fluxoft\Rebar\Error\Notifiers\HtmlNotifier;

//use Fluxoft\Rebar\Error\Notifiers\LoggerNotifier;
//use Fluxoft\Rebar\Error\Notifiers\TextNotifier;

require_once __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL & ~E_USER_DEPRECATED & ~E_DEPRECATED);
ini_set('display_errors', 1);

// Array of notifiers to use for error handling (note that these are processed in order, so put notifiers meant to display
// errors last in the array)
$notifierStack = [];
//$notifierStack[] = new LoggerNotifier($container['Logger']); // Logs errors to a PSR-3 logger
// Only one of these should be uncommented at a time:
//$notifierStack[] = new TextNotifier(); // Displays errors in plain text format. If verbose is true, it will display the full stack trace.
$notifierStack[] = new HtmlNotifier(true, 'Whoops! Something went kaboom!'); // Displays errors in HTML format. If verbose is true, it will display the full stack trace.

ErrorHandler::Register($notifierStack);
