<?php

namespace todo\components;

class Router
{

	private $routes;

	public function __construct()
	{
		$this->routes = $this->getRoutes();
	}

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
		return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		$uri = $this->getURI();

        error_log("Failed to connect to database!", 0);

		if (substr($uri, -1) == "?") {
            $uri = substr_replace($uri ,"", -1);
        }

		foreach ($this->routes as $uriPattern => $path) {

			if(preg_match("~$uriPattern~", $uri)) {

				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

				$segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				$parameters = $segments;

				$controllerNameSpaceName = "todo\controllers\\" . $controllerName;
				$controllerObject = new $controllerNameSpaceName;

				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				if ($result != null) {
				    echo $result;
					break;
				}
			}

		}
	}

	private function getRoutes()
    {
        return array(
            'login' => 'user/login',
            'register' => 'user/register',
            'delete' => 'task/delete',
            'deletesub' => 'task/deletesub',
            'addtask' => 'task/add',
            'addsub' => 'task/addsub',
            'update' => 'task/update',
            'updatesub' => 'task/updatesub'
        );
    }
}
