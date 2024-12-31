<?php

namespace RebarBase\Controllers\Api;

use Fluxoft\Rebar\Http\AbstractRestController;
use RebarBase\Services\MaterialsService;

class Materials extends AbstractRestController {
	protected function getServiceClass(): string {
		return MaterialsService::class;
	}
}
