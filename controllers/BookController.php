<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.06.2019
	 * Time: 20:35
	 */

	class bookController
	{
		public function actionNewBook()
		{

			$newBook = BOOk ::getNewBooks();

			require_once(ROOT . '/view/page/newBook.php');

			return true;
		}

		public function actionPopularBook()
		{
			require_once(ROOT . '/view/page/aboutBook.php');
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

			$directory = $bookItem['b_path_content'].$numToms.'\\'.$numChapter.'\\';    // Папка с изображениями
			$directory = str_replace('/', '\\', substr($directory,1));
			$allowed_types=array("jpg", "png", "gif");  //разрешеные типы изображений
			$file_parts = array();
			$result = '';

			$ext='';
			$title='';
			$i=0;
			//пробуем открыть папку
			$dir_handle = @opendir($directory) or die("Не удалось открыть: ".$directory);
			while ($file = readdir($dir_handle))    //поиск по файлам
			{
				if($file=="." || $file == "..") continue;  //пропустить ссылки на другие папки
				$file_parts = explode(".",$file);          //разделить имя файла и поместить его в массив
				$ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
				$path = '/'.str_replace('\\', '/',$directory.$file);

				if(in_array($ext,$allowed_types))
				{
					$result = $result.'
<div class="col-md-2">
					<div class="card bg-secondary mb-4 box-shadow">
						<a data-fancybox="gallery" href="'.$path.'">
							<img
									class="card-img-top"
									data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
									alt="'.$file.'" style="height: auto;  display: block;"
									src="'.$path.'" data-holder-rendered="true">
						</a>
					</div>
				</div>
				';
				}


			}
			closedir($dir_handle);  //закрыть папку
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
			$arts = array();

			$directory = $bookItem['b_path_content'].'Arts/';    // Папка с изображениями
			$directory = str_replace('/', '\\', substr($directory,1));
			$allowed_types=array("jpg", "png", "gif");  //разрешеные типы изображений
			$file_parts = array();

			$ext='';
			$i=0;
			//пробуем открыть папку
			$dir_handle = @opendir($directory) or die("Не удалось открыть: ".$directory);
			while ($file = readdir($dir_handle))    //поиск по файлам
			{
				if($file=="." || $file == "..") continue;  //пропустить ссылки на другие папки
				$file_parts = explode(".",$file);          //разделить имя файла и поместить его в массив
				$ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
				$path = '/'.str_replace('\\', '/',$directory.$file);

				if(in_array($ext,$allowed_types))
				{
					$arts[$i] = $path;
					$i++;
				}


			}
			closedir($dir_handle);  //закрыть папку

			require_once(ROOT . '/view/page/aboutBook.php');

			return true;
		}
	}