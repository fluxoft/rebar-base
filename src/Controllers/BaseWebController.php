<?php

namespace RebarBase\Controllers;

use Fluxoft\Rebar\Container;
use Fluxoft\Rebar\Http\Controller;
use Fluxoft\Rebar\Http\Presenters\PresenterInterface;

class BaseWebController extends Controller {
	/** @var Container */
	protected $container;

	/** @var PhtmlPresenter */
	protected ?PresenterInterface $presenter;

	public function Setup(Container $container) {
		$this->response->Presenter = $container['PhtmlPresenter'];
	}
}