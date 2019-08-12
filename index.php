<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.06.2019
	 * Time: 14:58
	 */

	//общие настройки
	ini_set('display_errors', 1);
	error_reporting(E_ALL);


	//Подключение файлов системы
	define('ROOT', dirname(__FILE__));
	require_once (ROOT.'/components/Autoload.php');

	//Вызов router
	$router = new Router();
	$router->run();
	?>
