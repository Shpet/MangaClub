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
			$result = $db->query('SELECT id_book, name_book, b_description '.
								'FROM book '.
								'ORDER BY id_book DESC '.
								'LIMIT 2');

			//запись результатов запроса
			$i =0;
			while($row = $result->fetch()){
				$booksList[$i]['id_book'] = $row['id_book'];
				$booksList[$i]['name_book'] = $row['name_book'];
				$booksList[$i]['b_description'] = $row['b_description'];
				$i++;
			}
			return $booksList;
		}
	}