<?php

namespace RebarBase;

use Fluxoft\Rebar\Auth\DefaultClaimsProvider;
use Fluxoft\Rebar\Auth\TokenManager;
use Fluxoft\Rebar\Auth\WebAuth;
use Fluxoft\Rebar\Container;
use Fluxoft\Rebar\ContainerDefinition;
use Fluxoft\Rebar\Http\Presenters\JsonPresenter;
use Fluxoft\Rebar\Http\Presenters\PhtmlPresenter;
use RebarBase\Services\MaterialsService;

$c   = new Container();
$def = [];

// Secret Key for Auth
$def['SecretKey'] = 'ThisIsASecretKey';
$def['UseSessionsForWebAuth'] = false;

/**
 * Database Connection Setup
 */
$def['DbConnectionString'] = 'sqlite:' . __DIR__ . '/../data/rebarbase.db';

// Set up a PDO connection, added as a closure call as it is a more complex instantiation
$c['DbWriter']           = function ($c) {
	$pdo = new \PDO($c['DbConnectionString']);
	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	return $pdo;
};
$def['DbReader'] = 'DbWriter'; // Not using master/slave, so just use the writer for reading

/**
 * Auth Setup
 */
$def['ClaimsProvider'] = new ContainerDefinition(DefaultClaimsProvider::class);
$def['TokenManager']   = new ContainerDefinition(TokenManager::class, ['RefreshTokenMapper', 'ClaimsProvider', 'SecretKey']);
$def['WebAuth']        = new ContainerDefinition(WebAuth::class, ['UserMapper', 'TokenManager', 'UseSessionsForWebAuth']);

/**
 * Data Mapper Setup
 */
$def['MapperFactory']      = new ContainerDefinition(Mappers\MapperFactory::class, ['DbWriter']);
$def['MaterialMapper']     = new ContainerDefinition(Mappers\MaterialMapper::class, ['MapperFactory', 'MaterialModel', 'DbReader']);
$def['RefreshTokenMapper'] = new ContainerDefinition(Mappers\RefreshTokenMapper::class, ['MapperFactory', 'RefreshTokenModel', 'DbReader']);
$def['UserMapper']         = new ContainerDefinition(Mappers\UserMapper::class, ['MapperFactory', 'UserModel', 'DbReader']);

/**
 * Models Setup
 */
$def['MaterialModel']     = new ContainerDefinition(Models\Material::class);
$def['RefreshTokenModel'] = new ContainerDefinition(Models\RefreshToken::class);
$def['UserModel']         = new ContainerDefinition(Models\User::class);

/**
 * Services Setup
 */
$def['MaterialsService'] = new ContainerDefinition(Services\MaterialsService::class, ['MaterialMapper']);
$def[MaterialsService::class] = 'MaterialsService'; // The AbstractRestController accesses this service by its FQN

/**
 * Presenter Setup
 */
$def['TemplatePath']   = __DIR__ . '/../templates/';
$def['PhtmlPresenter'] = new ContainerDefinition(PhtmlPresenter::class, ['TemplatePath']);
$def['JsonPresenter']  = new ContainerDefinition(JsonPresenter::class);

$c->LoadDefinitions($def);
return $c;
