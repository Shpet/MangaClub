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

			$newBook = BOOk::getNewBooks();

			require_once (ROOT.'/view/page/newBook.php');

			return true;
		}

		public function actionPopularBook()
		{
			require_once (ROOT.'/view/page/aboutBook.php');
			return true;
		}

		public function actionAllBook()
		{
			$bookList = Book::getBooksList();

			echo'<pre>';
			print_r($bookList);
			echo'</pre>';
			return true;
		}

		public function actionBookIndex($id)
		{
			$bookItem = Book::getBookById($id);

			require_once (ROOT.'/view/page/aboutBook.php');

			return true;
		}
	}