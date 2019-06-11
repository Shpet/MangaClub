<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.06.2019
	 * Time: 20:35
	 */

	include_once ROOT.'/models/Book.php';
	class bookController
	{
		public function actionNewBook()
		{
			echo 'Book controller actionNewBook';
			return true;
		}

		public function actionPopularBook()
		{
			echo 'Book controller actionPopularBook';
			return true;
		}

		public function actionAllBook()
		{
			echo 'Book controller actionAllBook';
			return true;
		}

		public function actionBookIndex($category, $id)
		{
			$bookList = array();
			$bookList = Book::getBookById($id);

			echo '<pre>';
			print_r($bookList);
			echo '</pre>';

			return true;
		}
	}