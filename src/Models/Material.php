<?php

namespace RebarBase\Models;

use Fluxoft\Rebar\Model;

/**
 * Class Material
 * @package RebarBase\Models
 * @property int    $Id
 * @property string $Name
 * @property float  $Quantity
 * @property float  $UnitPrice
 * @property-read float  $TotalValue
 */
class Material extends Model {
	protected static array $defaultProperties = [
		'Id'         => null,
		'Name'       => '',
		'Quantity'   => 0,
		'UnitPrice'  => 0.0,
		'TotalValue' => 0.0
	];

	protected function getTotalValue() {
		return $this->Quantity * $this->UnitPrice;
	}
	protected function validateQuantity($value) {
		if (!is_numeric($value) || $value < 0) {
			return 'Quantity must be a number greater than or equal to 0.';
		}
		return true;
	}
	protected function validateUnitPrice($value) {
		if (!is_numeric($value) || $value < 0) {
			return 'Unit Price must be a number greater than or equal to 0.';
		}
		return true;
	}
}