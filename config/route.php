<?
// класс маршрутизации

class Routing
{

	public static function buildRoute()
	{

		$controllerName = "IndexController";
		$modelName = "IndexModel";
		$action = "index";

		$route = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


		if ($route[1] != '') {
			$controllerName = ucfirst($route[1] . 'Controller');
			$modelName = ucfirst($route[1] . 'Model');
		}

		if (file_exists(CONTROLLER_PATH . $controllerName . '.php')) {
			include CONTROLLER_PATH . $controllerName . '.php'; // IndexController.php
			include MODEL_PATH . $modelName . '.php'; // IndexModel.php


		} 
		// else {
		// 	header('Location: /');
		// }

		if (isset($route[2]) && $route[2] != '') {
			$action = $route[2];
		}

		$controller = new $controllerName();
		$controller->$action();
	}

	public function errorPage()
	{
	}
}
