<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.06.2019
	 * Time: 20:35
	 */

	class bookController
	{

		public function actionAdvancedSearch()
		{

			$data = $_POST;
			$name = '';

			if(isset($data['search']))
			{
				$Mname = $data['name'];

				$bookList = Book ::searchByName($Mname);
			}
			if(isset($data['searchName']))
			{
				$name = $data['name'];
				$bookList = Book ::searchByName($name);
			}
			if(isset($data['searchGenre']))
			{
				$genre = $data['genre'];
				$bookList = Book ::searchByGenre($genre);
			}
			if(isset($data['searchAuthor']))
			{
				$author = $data['author'];
				$bookList = Book ::searchByAuthor($author);

			}
			if(isset($data['searchYear']))
			{
				$year = $data['year'];
				$bookList = Book ::searchByYear($year);

			}


			require_once(ROOT . '/view/page/advancedSearch.php');
			return true;
		}

		public function actionNewBook()
		{

			$newBook = BOOk ::getNewBooks();
			$countLikes = Book ::countOfFullLikes();
			$countDislikes = Book ::countOfFullDislikes();

			require_once(ROOT . '/view/page/newBook.php');

			return true;
		}

		public function actionStats()
		{

			$stats = BOOk ::stats();
			$i = 0;
			$dataPoints = array();
			while($i < count($stats))
			{
				$dataPoints[$i] = (array("label" => $stats[$i]['name_genre'], "y" => $stats[$i]['countOfGenre']));
				$i++;
			}

			require_once(ROOT . '/view/page/stats.php');

			return true;
		}

		public function actionReadBook($id)
		{
			$bookItem = Book ::getReadBookById($id);

			$tomsCount = $this -> numOfFiles($id);

			require_once(ROOT . '/view/page/readBook.php');
			return true;
		}

		public function actionSelectChapter($id, $numToms)
		{

			$chapters = $this -> numOfFiles($id, $numToms);

			print_r($chapters);

			return true;
		}

		public function actionCreateContent($id)
		{
			$bookItem = Book ::getReadBookById($id);
			$numChapter = $_GET['chapter'];
			$numToms = $_GET['tom'];

			$directory = $bookItem['b_path_content'] . $numToms . '\\' . $numChapter . '\\';    // Папка с изображениями
			$directory = str_replace('/', '\\', substr($directory, 1));
			$result = '';

			$i = 0;
			$bookList = scandir($directory);
			$directory = str_replace('\\', '/', $directory);
			$directory = '/' . $directory;
			$bookList = array_slice($bookList, 2);
			$ext = array();
			$name = array();

			foreach($bookList as $item)
			{
				$item = explode('.', $item);
				$ext[$i] = strtolower(array_pop($item));
				$name[$i] = intval($item[0]);
				$i++;
			}
			sort($name);
			for($i = 0; $i < count($name); $i++)
			{
				$result = $result . '
<div class="col-md-2">
					<div class="card bg-secondary mb-4 box-shadow">
						<a data-fancybox="gallery" href="' . $directory . $name[$i] . '.jpg">
							<img
									class="card-img-top"
									data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
									alt="' . $name[$i] . '.jpg" style="height: auto;  display: block;"
									src="' . $directory . $name[$i] . '.jpg" data-holder-rendered="true">
						</a>
					</div>
				</div>
				';
			}

			print($result);
			return true;
		}

		function numOfFiles($id, $parent = '')
		{
			$bookItem = Book ::getReadBookById($id);

			$parent = substr($parent, 1);
			$dir = $bookItem['b_path_content'];
			$dir = str_replace('/', '\\', $dir);
			$dir = substr($dir, 1) . $parent;

			$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
			$result = iterator_count($fi);
			return $result;
		}

		public function actionBookIndex($id)
		{
			$bookItem = Book ::getBookById($id);

			$countLikes = Book ::countOfLikes($id);
			$countDislikes = Book ::countOfDislikes($id);

			$arts = array();

			$directory = $bookItem['b_path_content'] . 'Arts/';    // Папка с изображениями
			$directory = str_replace('/', '\\', substr($directory, 1));
			$allowed_types = array("jpg", "png", "gif");  //разрешеные типы изображений
			$file_parts = array();

			$ext = '';
			$i = 0;
			//пробуем открыть папку
			$dir_handle = @opendir($directory) or die("Не удалось открыть: " . $directory);
			while($file = readdir($dir_handle))    //поиск по файлам
			{
				if($file == "." || $file == "..") continue;  //пропустить ссылки на другие папки
				$file_parts = explode(".", $file);          //разделить имя файла и поместить его в массив
				$ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
				$path = '/' . str_replace('\\', '/', $directory . $file);

				if(in_array($ext, $allowed_types))
				{
					$arts[$i] = $path;
					$i++;
				}


			}
			closedir($dir_handle);  //закрыть папку

			require_once(ROOT . '/view/page/aboutBook.php');

			return true;
		}

		public function actionIncrementLikes()
		{
			if(User ::isGuess())
			{
				print false;
				return true;
			}
			else
			{
				$id_book = $_GET['id'];
				$id_user = User ::checkLogged();

				$active = !Book ::isUserLike($id_book, $id_user);
				if($active)
				{
					Book ::incrementlike($id_book, $id_user);

					$activeDis = Book ::isUserDislike($id_book, $id_user);
					if($activeDis)
					{
						Book ::decrementDislike($id_book, $id_user);
					}
				}
				else
				{
					Book ::decrementlike($id_book, $id_user);
				}

				$res = Book ::countOfLikes($id_book) . ' ' . Book ::countOfDislikes($id_book);

				print_r($res);
				return true;
			}

		}

		public function actionIncrementDislikes()
		{
			if(User ::isGuess())
			{
				print false;
				return true;
			}
			else
			{
				$id_book = $_GET['id'];
				$id_user = User ::checkLogged();

				$active = !Book ::isUserDislike($id_book, $id_user);
				if($active)
				{
					Book ::incrementdislike($id_book, $id_user);

					$activeLike = Book ::isUserLike($id_book, $id_user);
					if($activeLike)
					{
						Book ::decrementLike($id_book, $id_user);
					}
				}
				else
				{
					Book ::decrementdislike($id_book, $id_user);
				}
				$res = Book ::countOfDislikes($id_book) . ' ' . Book ::countOfLikes($id_book);

				print_r($res);
				return true;
			}

		}

	}
