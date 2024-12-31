<?php

namespace RebarBase\Controllers;

use Fluxoft\Rebar\Config;

class Main extends BaseWebController {
	public function Default() {
		$this->set('title', 'Welcome to RebarBase');
		$this->set('env', Config::Instance()['app']['env']);
		$this->presenter->Template = 'main/default.phtml';
	}

	public function Protected() {
		$this->set('title', 'Protected Page');
		$this->set('user', $this->request->AuthenticatedUser);
		$this->presenter->Template = 'main/protected.phtml';
	}
}