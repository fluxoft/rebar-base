<?php

namespace RebarBase\Controllers;

use Fluxoft\Rebar\Container;
use Fluxoft\Rebar\Http\Controller;

class Hello extends Controller {
	private Container $container;
	public function Setup($container) {
		$this->container = $container;
	}

	public function World() {
		$this->response->Body = 'Hello, World!';
		$this->response->Send();
	}
}
