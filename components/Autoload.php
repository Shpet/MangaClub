<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.08.2019
	 * Time: 13:35
	 */

	function __autoload($class_name){
		$array_path = array(
			'/components/',
			'/models/'
		);

		foreach($array_path as $path){
			$path = ROOT . $path . $class_name . '.php';
			if(is_file($path)){
				include_once $path;
			}
		}
	}