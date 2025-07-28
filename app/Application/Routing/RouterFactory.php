<?php

declare(strict_types=1);

namespace App\Application\Routing;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('graphiql', 'Graphql:ui');
		$router->addRoute('api/v1/<presenter>/<action>[/<id>]', 'Graphql:default');
		return $router;
	}
}
