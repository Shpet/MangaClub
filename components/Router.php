<?php

	class Router
	{
		private $routes;

		public function __construct()
		{
			$routerPath = ROOT . '/config/routes.php';
			$this -> routes = include($routerPath);
		}

		//получить строку запроса (string)
		private function getURI()
		{
			if(!empty($_SERVER['REQUEST_URI']))
			{
				return trim($_SERVER['REQUEST_URI'], '/');
			}
		}

		public function run()
		{
			$uri = $this->getURI();

			//есть ли совпадения в адрессной строке
			foreach($this->routes as $uriPattern=>$path){
				if(preg_match("~$uriPattern~", $uri)){

					//разделить контроллер и экшн
					$segments = explode('/', $path);

					$controllerName = array_shift($segments).'Controller';
					$controllerName = ucfirst($controllerName);

					$actionName = 'action'.ucfirst(array_shift($segments));

					//подключить файл класса-контроллера
					$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
					//существует ли такой файл
					if(file_exists($controllerFile)){
						include_once($controllerFile);
					}

					//создать объект, вызвать метод(action)
					$controllerObject = new $controllerName;
					$result = $controllerObject->$actionName();
					if($result != null){
						break;
					}
				}
			}
		}
	}