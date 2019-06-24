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
			$newBook = BOOk::getNewBooks();
			$popularBook = BOOK::getPopularBook();

			require_once (ROOT.'/view/page/main.php');

			return true;
		}
	}