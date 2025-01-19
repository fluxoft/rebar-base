<?php

namespace RebarBase\Controllers;

use Fluxoft\Rebar\Config;

class Main extends BaseWebController {
	public function Default() {
		$this->response->AddData('title', 'Welcome to RebarBase');
		$this->response->AddData('env', Config::Instance()['app']['env']);
		$this->response->Presenter->Template = 'main/default.phtml';
	}

	public function Protected() {
		$this->response->AddData('title', 'Protected Page');
		$this->response->AddData('user', $this->request->AuthenticatedUser);
		$this->response->Presenter->Template = 'main/protected.phtml';
	}
}