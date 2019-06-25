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

			$result = $db->query("SELECT *, GROUP_CONCAT(genre.name_genre ORDER BY genre.name_genre SEPARATOR ', ') as genre 
											FROM book 
											JOIN book_genre ON book.id_book = book_genre.id_book_bg 
											JOIN genre on book_genre.id_genre_bg = genre.id_genre 
											where id_book = $id");

			$bookItem = $result->fetch();

			if($bookItem['ongoing'])
				$bookItem['ongoing'] = 'да';
			else
				$bookItem['ongoing'] = 'нет';

			return $bookItem;
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
			$result = $db->query('SELECT id_book, name_book, author, b_description, b_path_logo,b_path_logo_big, b_rating, name_genre
										  FROM book
								 		  JOIN book_genre ON book.id_book = book_genre.id_book_bg 
 										  JOIN genre on book_genre.id_genre_bg = genre.id_genre
										  ORDER BY book.id_book DESC ');

			//запись результатов запроса
			$i =0;
			while($row = $result->fetch()){
				if($i > 0 && $row['id_book'] == $booksList[$i-1]['id_book']){
					$booksList[$i-1]['name_genre'] = $booksList[$i-1]['name_genre'].', '.$row['name_genre'];
					continue;
				}
				$booksList[$i]['id_book'] = $row['id_book'];
				$booksList[$i]['name_book'] = $row['name_book'];
				$booksList[$i]['author'] = $row['author'];
				$booksList[$i]['b_description'] = $row['b_description'];
				$booksList[$i]['b_path_logo'] = $row['b_path_logo'];
				$booksList[$i]['b_path_logo_big'] = $row['b_path_logo_big'];
				$booksList[$i]['b_rating'] = $row['b_rating'];
				$booksList[$i]['name_genre'] = $row['name_genre'];

				$i++;
			}
			return $booksList;
		}

		public static function getPopularBook(){
			$db = Db::getConnection();
			$booklist = array();

			//запрос
			$result = $db->query('SELECT id_book, name_book, name_genre, b_rating, b_path_logo_big
 									from book 
 									JOIN book_genre ON book.id_book = book_genre.id_book_bg 
 									JOIN genre on book_genre.id_genre_bg = genre.id_genre
									ORDER by b_rating DESC');

			//запись результатов
			$i = 0;
			while($row = $result->fetch()){
				if($i > 0 && $row['id_book'] == $booklist[$i-1]['id_book']){
					$booklist[$i-1]['name_genre'] = $booklist[$i-1]['name_genre'].', '.$row['name_genre'];
					continue;
				}
				$booklist[$i]['id_book'] = $row['id_book'];
				$booklist[$i]['name_book'] = $row['name_book'];
				$booklist[$i]['name_genre'] = $row['name_genre'];
				$booklist[$i]['b_rating'] = $row['b_rating'];
				$booklist[$i]['b_path_logo_big'] = $row['b_path_logo_big'];
				$i++;
				if($i > 5){
					break;
				}
			}
			return $booklist;
		}
	}