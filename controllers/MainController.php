<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 13.06.2019
	 * Time: 16:33
	 */
	include_once  ROOT.'/models/Book.php';

	class MainController
	{
		public function actionMainPage(){

			$newBook = array();
			$newBook = BOOk::getNewBooks();
			require_once (ROOT.'/view/page/main.php');

			return true;
		}
		public function actionNewBook(){

			return true;
		}
	}