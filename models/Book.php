<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 11.06.2019
	 * Time: 15:07
	 */

	class Book
	{

		public static function getBookById($id)
		{
			$id = intval($id);

			//подключение к бд
			$db = Db::getConnection();

			$result = $db->query("SELECT * FROM book WHERE id_book = $id");

			$bookItem = $result->fetch();
			return$bookItem;
		}

		//return array
		public static function getBooksList()
		{
			//подключение к бд
			$db = Db::getConnection();
			$booksList = array();

			//запрос к бд
			$result = $db->query('SELECT *'.
								'FROM book '.
								'ORDER BY id_book DESC '.
								'LIMIT 7');

			//запись результатов запроса
			$i =0;

			while($row = $result->fetch()){
				$booksList[$i]['name_book'] = $row['name_book'];
				$booksList[$i]['author'] = $row['author'];
				$booksList[$i]['ongoing'] = $row['ongoing'];
				$booksList[$i]['b_description'] = $row['b_description'];
				$booksList[$i]['b_path_logo'] = $row['b_path_logo'];
				$booksList[$i]['b_path_content'] = $row['b_path_content'];
				$booksList[$i]['b_year'] = $row['b_year'];
				$booksList[$i]['b_rating'] = $row['b_rating'];
				$i++;
			}
			return $booksList;
		}
		//return array
		public static function getNewBooks()
		{
			//подключение к бд
			$db = Db::getConnection();
			$booksList = array();

			//запрос к бд
			$result = $db->query('SELECT * '.
								'FROM book '.
								'ORDER BY id_book DESC '.
								'LIMIT 12');

			//запись результатов запроса
			$i =0;
			while($row = $result->fetch()){
				$booksList[$i]['id_book'] = $row['id_book'];
				$booksList[$i]['name_book'] = $row['name_book'];
				$booksList[$i]['author'] = $row['author'];
				$booksList[$i]['ongoing'] = $row['ongoing'];
				$booksList[$i]['b_description'] = $row['b_description'];
				$booksList[$i]['b_path_logo'] = $row['b_path_logo'];
				$booksList[$i]['b_path_content'] = $row['b_path_content'];
				$booksList[$i]['b_year'] = $row['b_year'];
				$booksList[$i]['b_rating'] = $row['b_rating'];
				$i++;
			}
			return $booksList;
		}
	}