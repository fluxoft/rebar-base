<?php

namespace RebarBase\Mappers;

use Fluxoft\Rebar\Auth\Db\RefreshTokenMapperTrait;
use Fluxoft\Rebar\Auth\RefreshTokenMapperInterface;
use Fluxoft\Rebar\Data\Db\Mappers\SQLiteMapper;

class RefreshTokenMapper extends SQLiteMapper implements RefreshTokenMapperInterface {
	use RefreshTokenMapperTrait;

    protected string $dbTable = 'refresh_tokens';
    protected string $idProperty = 'Id';

    protected array $propertyDbMap = [
        'Id'        => 'id',
        'UserId'    => 'user_id',
        'SeriesId'  => 'series_id',
        'Token'     => 'token',
        'ExpiresAt' => 'expires_at',
        'CreatedAt' => 'created_at',
        'RevokedAt' => 'revoked_at'
    ];
}
