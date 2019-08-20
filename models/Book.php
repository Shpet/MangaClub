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
			$db = Db ::getConnection();

			$result = $db -> query("SELECT *, GROUP_CONCAT(genre.name_genre ORDER BY genre.name_genre SEPARATOR ', ') as genre 
											FROM book 
											JOIN book_genre ON book.id_book = book_genre.id_book_bg 
											JOIN genre on book_genre.id_genre_bg = genre.id_genre 
											where id_book = $id");

			$bookItem = $result -> fetch();

			if($bookItem['ongoing']) $bookItem['ongoing'] = 'да';
			else
				$bookItem['ongoing'] = 'нет';

			return $bookItem;
		}

		public static function getBookIdByName($name){
			$name = strval($name);
			//подключение к бд
			$db = Db ::getConnection();

			$sql = "SELECT id_book FROM book where name_book = :name_b";
			$result = $db -> prepare($sql);
			$result->bindParam(':name_b', $name, PDO::PARAM_STR);

			$result -> execute();

			$id = $result->fetch();

			return $id['id_book'];
		}
		public static function getBookByName($name)
		{
			$name = strval($name);
			//подключение к бд
			$db = Db ::getConnection();

			$sql = "SELECT *, GROUP_CONCAT(genre.name_genre ORDER BY genre.name_genre SEPARATOR ', ') as genre 
											FROM book 
											JOIN book_genre ON book.id_book = book_genre.id_book_bg 
											JOIN genre on book_genre.id_genre_bg = genre.id_genre 
											where name_book = :name_b";
			$result = $db -> prepare($sql);
			$result->bindParam(':name_b', $name, PDO::PARAM_STR);

			$result -> execute();

			$bookItem = $result->fetch();
			if($bookItem['ongoing']) $bookItem['ongoing'] = 'да';
			else
				$bookItem['ongoing'] = 'нет';

			return $bookItem;
		}

		public static function checkNameBookExists($name)
		{
			$db = Db ::getConnection();
			$sql = 'SELECT COUNT(*) FROM book WHERE name_book = :name_b';

			$result = $db -> prepare($sql);
			$result -> bindParam(':name_b', $name, PDO::PARAM_STR);
			$result -> execute();

			if($result -> fetchColumn()) return true;
			return false;
		}

		//return array
		public static function getBooksList()
		{
			//подключение к бд
			$db = Db ::getConnection();
			$booksList = array();

			//запрос к бд
			$result = $db -> query('SELECT *' . 'FROM book ' . 'ORDER BY id_book DESC ' . 'LIMIT 7');

			//запись результатов запроса
			$i = 0;

			while($row = $result -> fetch())
			{
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
			$db = Db ::getConnection();
			$booksList = array();

			// запрос к бд
			// limit min 15
			$result = $db -> query('SELECT id_book, name_book, author, b_description, b_path_logo,b_path_logo_big, b_rating, name_genre
										  FROM book
								 		  JOIN book_genre ON book.id_book = book_genre.id_book_bg 
 										  JOIN genre on book_genre.id_genre_bg = genre.id_genre
										  ORDER BY book.id_book DESC 
										  LIMIT 15 	');

			//запись результатов запроса
			$i = 0;
			while($row = $result -> fetch())
			{
				if($i > 0 && $row['id_book'] == $booksList[$i - 1]['id_book'])
				{
					$booksList[$i - 1]['name_genre'] = $booksList[$i - 1]['name_genre'] . ', ' . $row['name_genre'];
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

		public static function getPopularBook()
		{
			$db = Db ::getConnection();
			$booklist = array();

			//запрос
			$result = $db -> query('SELECT id_book, name_book, name_genre, b_rating, b_path_logo_big
 									from book 
 									JOIN book_genre ON book.id_book = book_genre.id_book_bg 
 									JOIN genre on book_genre.id_genre_bg = genre.id_genre
									ORDER by b_rating DESC');

			//запись результатов
			$i = 0;
			while($row = $result -> fetch())
			{
				if($i > 0 && $row['id_book'] == $booklist[$i - 1]['id_book'])
				{
					$booklist[$i - 1]['name_genre'] = $booklist[$i - 1]['name_genre'] . ', ' . $row['name_genre'];
					continue;
				}
				$booklist[$i]['id_book'] = $row['id_book'];
				$booklist[$i]['name_book'] = $row['name_book'];
				$booklist[$i]['name_genre'] = $row['name_genre'];
				$booklist[$i]['b_rating'] = $row['b_rating'];
				$booklist[$i]['b_path_logo_big'] = $row['b_path_logo_big'];
				$i++;
				if($i > 5)
				{
					break;
				}
			}
			return $booklist;
		}

		public static function getReadBookById($id)
		{
			$id = intval($id);

			//подключение к бд
			$db = Db ::getConnection();

			$result = $db -> query("SELECT id_book, b_path_content 
											FROM book 
											where id_book = $id");

			$bookItem = $result -> fetch();

			return $bookItem;
		}


		public static function deleteBookById($id)
		{
			$db = Db ::getConnection();

			$sql = 'DELETE FROM book WHERE id_book = :id';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id', $id, PDO::PARAM_INT);

			return $res -> execute();
		}

		public static function deleteBookByName($name)
		{
			$db = Db ::getConnection();

			$sql = 'DELETE FROM book WHERE name_book = :name_b';

			$res = $db -> prepare($sql);
			$res -> bindParam(':name_b', $name, PDO::PARAM_STR);

			return $res -> execute();
		}


		public static function updateBookById($id, $name, $author, $ongoing, $year, $description)
		{

			$db = Db ::getConnection();

			$sql = 'UPDATE book ' .
				   'SET name_book = :name, author = :author, ongoing = :ongoing, b_year = :year, b_description = :description ' .
				   'WHERE id_book = :id';

			$upd = $db -> prepare($sql);

			$upd -> bindParam(':id', $id, PDO::PARAM_INT);
			$upd -> bindParam(':name', $name, PDO::PARAM_STR);
			$upd -> bindParam(':author', $author, PDO::PARAM_STR);
			$upd -> bindParam(':ongoing', $ongoing, PDO::PARAM_INT);
			$upd -> bindParam(':year', $year, PDO::PARAM_STR);
			$upd -> bindParam(':description', $description, PDO::PARAM_STR);

			return $upd -> execute();

		}

		public static function delForUpdateGenre($id){

			$db = Db::getConnection();

			$sql = 'DELETE from book_genre '.
					   'WHERE id_book_bg = :id_book';
			$del = $db -> prepare($sql);
			$del->bindParam(':id_book', $id, PDO::PARAM_INT);

			return $del->execute();

		}

		public static function updateGenre($id, $genre){

			$db = Db::getConnection();

			$res = false;
			$sql = "INSERT INTO book_genre (id_book_bg, id_genre_bg)".
				   " VALUES (:id_book, :id_genre)";
			foreach($genre as $item)
			{
				$upd_genre = $db -> prepare($sql);

				$upd_genre -> bindParam(':id_book', $id, PDO::PARAM_INT);
				$upd_genre -> bindParam(':id_genre', $item, PDO::PARAM_INT);

				$res = $upd_genre->execute();
			}
			return $res;

		}


		public static function addBook($name, $author, $ongoing, $year, $description, $path_logo, $path_big_logo, $path_content)
		{
			User ::checkAdmin();

			$db = Db ::getConnection();

			$sql = 'INSERT INTO book( name_book, author, ongoing, b_description, b_year, b_path_logo, b_path_logo_big, b_path_content)' .
				   ' VALUES (:name_book, :author, :ongoing, :b_description, :b_year, :path_logo, :path_logo_big, :path_content)';

			$result = $db -> prepare($sql);
			$result -> bindParam(':name_book', $name, PDO::PARAM_STR);
			$result -> bindParam(':author', $author, PDO::PARAM_STR);
			$result -> bindParam(':ongoing', $ongoing, PDO::PARAM_INT);
			$result -> bindParam(':b_description', $description, PDO::PARAM_STR);
			$result -> bindParam(':b_year', $year, PDO::PARAM_STR);
			$result -> bindParam(':path_logo', $path_logo, PDO::PARAM_STR);
			$result -> bindParam(':path_logo_big', $path_big_logo, PDO::PARAM_STR);
			$result -> bindParam(':path_content', $path_content, PDO::PARAM_STR);

			return $result -> execute();
		}
	}