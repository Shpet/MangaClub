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
			$numTom = array_slice($numTom, 2);
			$numTom = implode(' ', $numTom);
			$numTom = str_replace('Tom', '', $numTom);
			$numTom = explode(' ', $numTom);
			$numTom = array_map('intval', $numTom);
			rsort($numTom);


			return $numTom[0];
		}
		public static function NumChapters($name){

			//узнаём, № последней папки
			$dir = ROOT.'/view/content/'.strtolower(str_replace(' ', '_', $name));
			$numChapter = scandir($dir);
			$numChapter = array_slice($numChapter, 2);
			$numChapter = array_map('intval', $numChapter);
			rsort($numChapter);


			return $numChapter[0];
		}
	}