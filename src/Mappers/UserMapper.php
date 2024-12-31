<?php

namespace RebarBase\Mappers;

use Fluxoft\Rebar\Auth\Db\UserMapperTrait;
use Fluxoft\Rebar\Auth\UserMapperInterface;
use Fluxoft\Rebar\Data\Db\Mappers\SQLiteMapper;

class UserMapper extends SQLiteMapper implements UserMapperInterface {
    use UserMapperTrait;

    protected string $dbTable = 'users';
    protected string $idProperty = 'Id';

    protected array $propertyDbMap = [
        'Id'          => 'id',
        'Username'    => 'username',
        'Password'    => 'password',
        'CreatedOn'   => 'created_on',
        'LastLoginOn' => 'last_login_on'
    ];
}
