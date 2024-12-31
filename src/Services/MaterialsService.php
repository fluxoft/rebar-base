<?php

namespace RebarBase\Services;

use Fluxoft\Rebar\Data\Db\AbstractService;
use RebarBase\Mappers\MaterialMapper;

class MaterialsService extends AbstractService {
	public function __construct(MaterialMapper $mapper) {
		parent::__construct($mapper);
	}
}
