<?php

namespace RebarBase\Models;

use Fluxoft\Rebar\Auth\BaseUser;

/**
 * Class User
 * @package RebarBase\Models
 *
 * @property int    $Id
 * @property string $Username
 * @property string $Password
 * @property string $CreatedOn
 * @property string|null $LastLoginOn
 */
class User extends BaseUser {
	protected static array $defaultProperties = [
		'Id'          => null,
		'Username'    => '',
		'Password'    => '',
		'CreatedOn'   => '',
		'LastLoginOn' => null
	];

	protected string $authUsernameProperty = 'Username';
	protected string $authPasswordProperty = 'Password';

	/**
	 * Optional validation for the Username property.
	 *
	 * @param mixed $value
	 * @return bool|string True if valid, or an error message if invalid.
	 */
	protected function validateUsername($value): bool|string {
		if (empty($value)) {
			return 'Username cannot be empty.';
		}
		return true;
	}

	/**
	 * Optional validation for the Password property.
	 *
	 * @param mixed $value
	 * @return bool|string True if valid, or an error message if invalid.
	 */
	protected function validatePassword($value): bool|string {
		if (strlen($value) < 8) {
			return 'Password must be at least 8 characters long.';
		}
		return true;
	}
}
