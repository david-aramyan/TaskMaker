<?php

require "Controllers/TaskController.php";
require "Controllers/UserController.php";
require "core/DBConnection.php";

class Router {

    /**
     * List of Possible routes.
     */
	private static $routes =
	[
        '',
	    "tasks",
		'createTask',
		'editTask',
		'updateTask',
		'makeTaskCompleted',
		'insertTask',
		'login',
		'logout'
	];

    /**
     * Get current route.
     *
     * @param string $route
     *
     * @return mixed
     */
	public static function getRoute($route)
    {
		$url = trim($route, '/');
    	$urlSegments = explode('/', $url);
		if (in_array($route, self::$routes)) {
			return self::getRouteClass($route);
		} elseif (isset($urlSegments[2]) && in_array($urlSegments[2], self::$routes)) {
			return self::getRouteClass($urlSegments[2],$urlSegments[1]);
		} elseif (isset($urlSegments[1]) && in_array($urlSegments[0], self::$routes)) {
			return self::getRouteClass($urlSegments[1]);
        } else {
            include("Views/404.html");
        }
	}

    /**
     * Get class from given route.
     *
     * @param string $route
     * @param int $id
     *
     * @return mixed
     */
	private static function getRouteClass($route ,$id = null)
    {
        $db = new DBConnection;
        $task = new TaskController($db);
		if ($route == "tasks" || $route == "") {
			return $task->showResult($route);
		} else {
			$user = new User($db);
			switch ($route) {
				case 'createTask':
					return $task->createTask($route);
					break;
				case 'editTask':
					return $task->editTask($route,$id);
					break;
				case 'updateTask':
					return $task->updateTask($id);
					break;
				case 'makeTaskCompleted':
					return $task->makeTaskCompleted($id);
					break;
				case 'insertTask':
					return $task->insertTask();
					break;
				case 'login':
					return $user->login($_POST['username'],$_POST['password']);
					break;
				case 'logout':
					return $user->logout();
					break;
			}
		}
	}
}
