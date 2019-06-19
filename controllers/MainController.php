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
		public function actionTest(){
			$test = BOOK::getPopularBook();

			echo '<pre>';
			print_r($test);
			echo '</pre>';
		}

		public function actionNewBookPage(){


			require_once ROOT.'/view/page/newBook.php';

			return true;
		}
	}