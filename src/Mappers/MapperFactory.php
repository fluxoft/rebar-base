<?php

namespace RebarBase\Mappers;

use Fluxoft\Rebar\Data\Db\MapperFactory as RebarMapperFactory;

class MapperFactory extends RebarMapperFactory {
	protected string $mapperNamespace = 'RebarBase\\Mappers\\';
	protected string $modelNamespace  = 'RebarBase\\Models\\';
}
