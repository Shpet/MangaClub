<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 19.08.2019
	 * Time: 14:21
	 */

	class UploadFiles
	{
		public static function NumFolders($name){

			//узнаём, № последней папки
			$dir = ROOT.'/view/content/'.strtolower(str_replace(' ', '_', $name));
			$numTom = scandir($dir);
			$numTom = array_slice($numTom, 3);
			$numTom = implode(' ', $numTom);
			$numTom = str_replace('Tom', '', $numTom);
			$numTom = explode(' ', $numTom);
			$numTom = array_map('intval', $numTom);
			rsort($numTom);


			return $numTom[0];
		}
	}