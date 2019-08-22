<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 11.06.2019
	 * Time: 15:07
	 */

	class Book
	{

		//SEARCH
		public static function searchByName($name){
			//подключение к бд
			$db = Db ::getConnection();
			$booksList = array();

			// запрос к бд
			$sql = "SELECT id_book, name_book, author, b_description, b_path_logo, name_genre
										  FROM book
								 		  JOIN book_genre ON book.id_book = book_genre.id_book_bg 
 										  JOIN genre on book_genre.id_genre_bg = genre.id_genre
										  WHERE name_book LIKE :name ";

			//запись результатов запроса
			$result = $db->prepare($sql);
			$name = '%'.$name.'%';
			$result->bindParam(':name', $name, PDO::PARAM_STR);
			$result->execute();
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
				$booksList[$i]['name_genre'] = $row['name_genre'];

				$i++;
			}
			return $booksList;
		}




		//GET BOOKS
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

		public static function getBookIdByName($name)
		{
			$name = strval($name);
			//подключение к бд
			$db = Db ::getConnection();

			$sql = "SELECT id_book FROM book where name_book = :name_b";
			$result = $db -> prepare($sql);
			$result -> bindParam(':name_b', $name, PDO::PARAM_STR);

			$result -> execute();

			$id = $result -> fetch();

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
			$result -> bindParam(':name_b', $name, PDO::PARAM_STR);

			$result -> execute();

			$bookItem = $result -> fetch();
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
			$result = $db -> query('SELECT id_book, name_book, author, b_description, b_path_logo,b_path_logo_big, name_genre
										  FROM book
								 		  JOIN book_genre ON book.id_book = book_genre.id_book_bg 
 										  JOIN genre on book_genre.id_genre_bg = genre.id_genre
										  ORDER BY book.id_book DESC ');

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
				$booksList[$i]['name_genre'] = $row['name_genre'];

				$i++;
				if($i > 15) break;
			}
			return $booksList;
		}

		public static function getPopularBook()
		{
			$db = Db ::getConnection();
			$booklist = array();

			//запрос
			$result = $db -> query('SELECT id_book, name_book, b_description, b_path_logo_big, COUNT(id_book) as num
 											 from book 
 											 JOIN likes on likes.id_book_fk = book.id_book 
 											 GROUP by likes.id_book_fk 
 											 ORDER by num DESC ');

			//запись результатов
			$i = 0;
			while($row = $result -> fetch())
			{
				$booklist[$i]['id_book'] = $row['id_book'];
				$booklist[$i]['name_book'] = $row['name_book'];
				$booklist[$i]['description'] = $row['b_description'];
				$booklist[$i]['count'] = $row['num'];
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



		// ADMIN
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

		public static function delForUpdateGenre($id)
		{

			$db = Db ::getConnection();

			$sql = 'DELETE from book_genre ' . 'WHERE id_book_bg = :id_book';
			$del = $db -> prepare($sql);
			$del -> bindParam(':id_book', $id, PDO::PARAM_INT);

			return $del -> execute();

		}

		public static function updateGenre($id, $genre)
		{

			$db = Db ::getConnection();

			$res = false;
			$sql = "INSERT INTO book_genre (id_book_bg, id_genre_bg)" . " VALUES (:id_book, :id_genre)";
			foreach($genre as $item)
			{
				$upd_genre = $db -> prepare($sql);

				$upd_genre -> bindParam(':id_book', $id, PDO::PARAM_INT);
				$upd_genre -> bindParam(':id_genre', $item, PDO::PARAM_INT);

				$res = $upd_genre -> execute();
			}
			return $res;

		}


		public static function addBook($name, $author, $ongoing, $year, $description, $path_logo, $path_big_logo,
									   $path_content)
		{
			User ::checkAdmin();

			$db = Db ::getConnection();

			$sql =
				'INSERT INTO book( name_book, author, ongoing, b_description, b_year, b_path_logo, b_path_logo_big, b_path_content)' .
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



		// LIKE/DISLIKE
		public static function isUserLike($id_book, $id_user)
		{
			$db = Db ::getConnection();

			$sql = 'SELECT COUNT(*) FROM likes ' . 'WHERE id_book_fk = :id_book AND id_user_fk = :id_user';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> bindParam(':id_user', $id_user, PDO::PARAM_INT);
			$res -> execute();
			if($res -> fetchColumn()) return true;
			return false;
		}

		public static function isUserDislike($id_book, $id_user)
		{
			$db = Db ::getConnection();

			$sql = 'SELECT COUNT(*) FROM dislikes ' . 'WHERE id_book_fk = :id_book AND id_user_fk = :id_user';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> bindParam(':id_user', $id_user, PDO::PARAM_INT);
			$res -> execute();
			if($res -> fetchColumn()) return true;
			return false;
		}

		public static function incrementlike($id_book, $id_user)
		{
			$db = Db ::getConnection();

			$sql = 'INSERT INTO likes (id_book_fk, id_user_fk, active)' . 'VALUES (:id_book, :id_user, 1)';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> bindParam(':id_user', $id_user, PDO::PARAM_INT);

			$res -> execute();
			if($res -> fetch()) return true;
			return false;
		}

		public static function decrementlike($id_book, $id_user)
		{
			$db = Db ::getConnection();

			$sql = 'DELETE FROM likes ' . ' WHERE id_book_fk = :id_book AND id_user_fk = :id_user';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> bindParam(':id_user', $id_user, PDO::PARAM_INT);

			$res -> execute();
			if($res -> fetch()) return true;
			return false;
		}

		public static function incrementdislike($id_book, $id_user)
		{
			$db = Db ::getConnection();

			$sql = 'INSERT INTO dislikes (id_book_fk, id_user_fk, active)' . 'VALUES (:id_book, :id_user, 1)';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> bindParam(':id_user', $id_user, PDO::PARAM_INT);

			$res -> execute();
			if($res -> fetch()) return true;
			return false;
		}

		public static function decrementdislike($id_book, $id_user)
		{
			$db = Db ::getConnection();

			$sql = 'DELETE FROM dislikes ' . ' WHERE id_book_fk = :id_book AND id_user_fk = :id_user';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> bindParam(':id_user', $id_user, PDO::PARAM_INT);

			$res -> execute();
			if($res -> fetch()) return true;
			return false;
		}

		public static function countOfLikes($id_book)
		{
			$db = Db ::getConnection();

			$sql = 'SELECT COUNT(*) FROM likes ' . 'WHERE id_book_fk = :id_book';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> execute();
			return $res -> fetchColumn();
		}

		public static function countOfDislikes($id_book)
		{
			$db = Db ::getConnection();

			$sql = 'SELECT COUNT(*) FROM dislikes ' . 'WHERE id_book_fk = :id_book';

			$res = $db -> prepare($sql);
			$res -> bindParam(':id_book', $id_book, PDO::PARAM_INT);
			$res -> execute();
			return $res -> fetchColumn();
		}

		public static function countOfFullLikes()
		{
			$db = Db ::getConnection();

			$sql = 'SELECT id_book_fk, COUNT(*)' . ' FROM likes' . ' GROUP BY id_book_fk';

			$res = $db -> prepare($sql);
			$res -> execute();

			$i = 0;
			while($row = $res -> fetch())
			{
				$countLikes[$i]['id_book'] = $row['id_book_fk'];
				$countLikes[$i]['count'] = $row['COUNT(*)'];
				$i++;
			}
			return $countLikes;

		}

		public static function countOfFullDislikes()
		{
			$db = Db ::getConnection();

			$sql = 'SELECT id_book_fk, COUNT(*)' . ' FROM dislikes' . ' GROUP BY id_book_fk';

			$res = $db -> prepare($sql);
			$res -> execute();

			$i = 0;
			while($row = $res -> fetch())
			{
				$countDislikes[$i]['id_book'] = $row['id_book_fk'];
				$countDislikes[$i]['count'] = $row['COUNT(*)'];
				$i++;
			}
			return $countDislikes;

		}

	}