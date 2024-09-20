<?php

namespace PixelFix\Framework\Http;

use FastRoute\RouteCollector;
use PixelFix\Framework\Controllers\AbstractController;
use PixelFix\Framework\Database\Connection;

use function FastRoute\simpleDispatcher;

class Kernel
{
	protected ?Connection $connection = null;

	public function __construct()
	{
		$config = include BASE_PATH . '/database/config.php';

		$this->connection = Connection::create($config['connectionString']);
	}

	public function handle(Request $request): Response
	{
		$dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {
			$routes = include BASE_PATH . '/routes/web.php';

			foreach ($routes as $route) {
				$routeCollector->addRoute(...$route);
			}
		});

		$routeInfo = $dispatcher->dispatch(
			$request->getMethod(),
			$request->getUri(),
		);

		[$status, [$controller, $method], $vars] = $routeInfo;

		$controller = new $controller;

		if ($controller instanceof AbstractController) {
			$controller->setRequest($request);
		}

		return call_user_func_array([$controller, $method], $vars);
	}
}
