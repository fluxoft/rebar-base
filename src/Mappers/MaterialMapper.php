<?php

namespace RebarBase\Mappers;

use Fluxoft\Rebar\Data\Db\Mappers\SQLiteMapper;

class MaterialMapper extends SQLiteMapper {
	protected string $dbTable       = 'materials';
	protected string $idProperty    = 'Id';
	protected array  $propertyDbMap = [
		'Id'        => 'id',
		'Name'      => 'name',
		'Quantity'  => 'quantity',
		'UnitPrice' => 'unit_price'
	];
}
