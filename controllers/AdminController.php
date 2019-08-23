<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 16.08.2019
	 * Time: 12:51
	 */

	class AdminController
	{

		public function actionIndex()
		{

			User ::checkAdmin();


			require_once ROOT . '/view/page/admin/adminPanel.php';
			return true;
		}

		public function actionAdd()
		{

			User ::checkAdmin();

			$data = $_POST;
			$errors = false;
			$res = false;

			$name = '';
			$genre = false;
			$author = '';
			$year = 2000;
			$description = '';
			$ongoing = 0;
			$b_path_logo = '/view/img/preview/text.jpg';
			$b_path_big_logo = '/view/img/preview/text.jpg';


			if(isset($data['add']))
			{
				if(Book ::checkNameBookExists($data['name']))
				{
					$errors[] = 'Такое имя уже существует.';
				}
				else
				{
					if(isset($data['name'])) $name = $data['name'];
					if(isset($data['genre'])) $genre = $data['genre'];
					if(isset($data['author'])) $author = $data['author'];
					if(isset($data['ongoing'])) $ongoing = $data['ongoing'];
					if(isset($data['year'])) $year = $data['year'];
					if(isset($data['description'])) $description = $data['description'];

					//создание папки Арт
					$folderArt = ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Arts';
					if(!mkdir($folderArt, 0777, true))
					{
						$errors[] = 'Не удалось создать папку Arts';
					}

					//content
					$structure = ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Tom1/1';

					if(!mkdir($structure, 0777, true))
					{
						$errors[] = 'Не удалось создать том';
					}

					if($_FILES['content']['size'] > 0)
					{
						if(is_uploaded_file($_FILES['content']['tmp_name'][0]))
						{
							$uploads_dir = $structure;
							$i = 0;
							foreach($_FILES["content"]["error"] as $key => $error)
							{
								if($error == UPLOAD_ERR_OK)
								{
									$i++;
									$tmp_name = $_FILES["content"]["tmp_name"][$key];
									$name_file = $i . '.jpg';
									move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
									$b_path_content = '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/';
								}
							}
						}
						else
							$errors[] = 'Не удалось загрузить';
					}

					//ARTS
					if($_FILES['arts']['size'][0] > 0)
					{
						$structure = ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Arts';

						if(is_uploaded_file($_FILES['arts']['tmp_name'][0]))
						{

							$uploads_dir = $structure;
							$i = 0;
							foreach($_FILES["arts"]["error"] as $key => $error)
							{
								if($error == UPLOAD_ERR_OK)
								{
									$i++;
									$tmp_name = $_FILES["arts"]["tmp_name"][$key];
									$name_file = $_FILES['arts']['name'][$key];
									move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
								}
							}
						}
						else
							$errors[] = 'Не удалось загрузить арты';
					}

					//logo
					if($_FILES['logo']['size'] > 0)
					{
						$name_logo = ucfirst(str_replace(' ', '_', $name)) . '.jpg';
						$structure = ROOT . '/view/img/preview/';


						if(is_uploaded_file($_FILES['logo']['tmp_name']))
						{

							$uploads_dir = $structure;
							$error = $_FILES["logo"]["error"];

							if($error == UPLOAD_ERR_OK)
							{
								$tmp_name = $_FILES["logo"]["tmp_name"];
								move_uploaded_file($tmp_name, "$uploads_dir/$name_logo");
								$b_path_logo = '/view/img/preview/' . $name_logo;
							}
						}
						else
							$errors[] = 'Не удалось загрузить арты';
					}
					//big logo
					if($_FILES['logoBig']['size'] > 0)
					{
						$name_Biglogo = ucfirst(str_replace(' ', '_', $name)) . '300.jpg';
						$structure = ROOT . '/view/img/preview/';


						if(is_uploaded_file($_FILES['logoBig']['tmp_name']))
						{

							$uploads_dir = $structure;
							$error = $_FILES["logoBig"]["error"];

							if($error == UPLOAD_ERR_OK)
							{
								$tmp_name = $_FILES["logoBig"]["tmp_name"];
								move_uploaded_file($tmp_name, "$uploads_dir/$name_Biglogo");
								$b_path_big_logo = '/view/img/preview/' . $name_Biglogo;
							}
						}
						else
							$errors[] = 'Не удалось загрузить арты';
					}

					$res = Book ::addBook($name, $author, $ongoing, $year, $description, $b_path_logo, $b_path_big_logo,
										  $b_path_content);

					$id = Book ::getBookIdByName($name);
					$res = Book ::updateGenre($id, $genre);

					if(!$errors && $res)
					{

						header('Location: /admin');
					}


				}
			}

			require_once(ROOT . '/view/page/admin/add.php');
			return true;
		}

		public function actionUpdate($id)
		{

			User ::checkAdmin();

			$book = Book ::getBookById($id);
			header('Location: /admin/update/' . $book['name_book']);
		}

		public function actionDelete($id)
		{

			User ::checkAdmin();

			if($id) Book ::deleteBookById($id);

			header("Location: /");
		}

		public function actionAdminDelete()
		{

			User ::checkAdmin();

			$data = $_POST;
			$name = '';
			$res = false;
			$errors = '';
			if(isset($data['del']))
			{
				$name = $data['name'];
				if(Book ::checkNameBookExists($name))
				{
					$res = Book ::deleteBookByName($name);
				}
				else
				{
					$errors = 'Неправильное имя';
				}
			}


			require_once(ROOT . '/view/page/admin/delete.php');
			return true;
		}

		public function actionAdminUpdate()
		{

			User ::checkAdmin();
			$data = $_POST;
			$name = '';
			$res = false;
			if(isset($data['update']))
			{
				$name = $data['name'];
				if(Book ::checkNameBookExists($name)) header('Location: /admin/update/' . $name);
			}


			require_once(ROOT . '/view/page/admin/update.php');
			return true;
		}

		public function actionAdminUpdateByName($name)
		{

			User ::checkAdmin();

			$name = str_replace("%20", " ", $name);

			$data = $_POST;
			$res = false;
			$errors = false;

			$book = Book ::getBookByName($name);

			$id = $book['id_book'];
			$logo = $book['b_path_logo'];
			$logoBig = $book['b_path_logo_big'];
			$content = $book['b_path_content'];
			$name = $book['name_book'];
			$author = $book['author'];
			$year = $book['b_year'];
			$description = $book['b_description'];
			$genre = $book['genre'];
			if($book['ongoing'] == 'да') $ongoing = 1;
			else $ongoing = 0;


			if(isset($data['saveUpdate']))
			{

				//Если выбран +Том
				if(isset($data['addTom']))
				{

					$numTom = UploadFiles ::NumFolders($name) + 1;
					$structure =
						ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Tom' . $numTom . '/1';

					if(!mkdir($structure, 0777, true))
					{
						$errors[] = 'Не удалось создать том';
					}

					if($_FILES['content']['size'][0] > 0)
					{
						if(is_uploaded_file($_FILES['content']['tmp_name'][0]))
						{

							$uploads_dir = $structure;
							$i = 0;
							foreach($_FILES["content"]["error"] as $key => $error)
							{
								if($error == UPLOAD_ERR_OK)
								{
									$i++;
									$tmp_name = $_FILES["content"]["tmp_name"][$key];
									$name_file = $i . '.jpg';
									move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
								}
							}
						}
						else
							$errors[] = 'Не удалось загрузить';
					}

				}
				//Если выбрана +Глава
				else if(isset($data['addChapter']))
				{
					$numTom = UploadFiles ::NumFolders($name);
					$numChapter = UploadFiles ::NumChapters($name . '/Tom' . $numTom) + 1;

					$structure =
						ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Tom' . $numTom . '/' .
						$numChapter;

					if(!mkdir($structure, 0777))
					{
						$errors[] = 'Не удалось создать главу';
					}

					if($_FILES['content']['size'][0] > 0)
					{
						if(is_uploaded_file($_FILES['content']['tmp_name'][0]))
						{

							$uploads_dir = $structure;
							$i = 0;
							foreach($_FILES["content"]["error"] as $key => $error)
							{
								if($error == UPLOAD_ERR_OK)
								{
									$i++;
									$tmp_name = $_FILES["content"]["tmp_name"][$key];
									$name_file = $i . '.jpg';
									move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
								}
							}
						}
						else
							$errors[] = 'Не удалось загрузить';
					}


				}
				//Если выбрано только +контент
				else if($_FILES['content']['size'][0] > 0)
				{
					$numTom = UploadFiles ::NumFolders($name);
					$numChapter = UploadFiles ::NumChapters($name . '/Tom' . $numTom);

					$structure =
						ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Tom' . $numTom . '/' .
						$numChapter;


					if(is_uploaded_file($_FILES['content']['tmp_name'][0]))
					{

						$uploads_dir = $structure;
						$i = 0;
						foreach($_FILES["content"]["error"] as $key => $error)
						{
							if($error == UPLOAD_ERR_OK)
							{
								$i++;
								$tmp_name = $_FILES["content"]["tmp_name"][$key];
								$name_file = $i . '.jpg';
								move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
							}
						}
					}
					else
						$errors[] = 'Не удалось загрузить контент';
				}

				// загрузка артов
				if($_FILES['arts']['size'][0] > 0)
				{
					$structure = ROOT . '/view/content/' . strtolower(str_replace(' ', '_', $name)) . '/Arts';


					if(is_uploaded_file($_FILES['arts']['tmp_name'][0]))
					{

						$uploads_dir = $structure;
						$i = 0;
						foreach($_FILES["arts"]["error"] as $key => $error)
						{
							if($error == UPLOAD_ERR_OK)
							{
								$i++;
								$tmp_name = $_FILES["arts"]["tmp_name"][$key];
								$name_file = $_FILES['arts']['name'][$key];
								move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
							}
						}
					}
					else
						$errors[] = 'Не удалось загрузить арты';
				}

				//logo
				if($_FILES['logo']['size'] > 0)
				{
					$name_logo = ucfirst(str_replace(' ', '_', $name)) . '.jpg';
					$structure = ROOT . '/view/img/preview/';


					if(is_uploaded_file($_FILES['logo']['tmp_name']))
					{

						$uploads_dir = $structure;
						$error = $_FILES["logo"]["error"];

						if($error == UPLOAD_ERR_OK)
						{
							$tmp_name = $_FILES["logo"]["tmp_name"];
							move_uploaded_file($tmp_name, "$uploads_dir/$name_logo");
						}
					}
					else
						$errors[] = 'Не удалось загрузить арты';
				}
				//big logo
				if($_FILES['logoBig']['size'] > 0)
				{
					$name_Biglogo = ucfirst(str_replace(' ', '_', $name)) . '300.jpg';
					$structure = ROOT . '/view/img/preview/';


					if(is_uploaded_file($_FILES['logoBig']['tmp_name']))
					{

						$uploads_dir = $structure;
						$error = $_FILES["logoBig"]["error"];

						if($error == UPLOAD_ERR_OK)
						{
							$tmp_name = $_FILES["logoBig"]["tmp_name"];
							move_uploaded_file($tmp_name, "$uploads_dir/$name_Biglogo");
						}
					}
					else
						$errors[] = 'Не удалось загрузить арты';
				}

				if($data['name'])
				{
					$name = $data['name'];

					if(Book ::checkNameBookExists($name))
					{
						$errors[] = 'Такое имя уже есть';
					}
				}
				if($data['author']) $author = $data['author'];
				$ongoing = $data['ongoing'];
				if($data['year']) $year = $data['year'];
				if($data['description']) $description = $data['description'];
				if(isset($data['genre'])) $genre = $data['genre'];
				else
				{
					$genre = false;
				}

				if(!$errors)
				{
					$res = $ongoing;
					Book ::updateBookById($id, $name, $author, $ongoing, $year, $description);
					if($genre)
					{
						Book ::delForUpdateGenre($id);
						Book ::updateGenre($id, $genre);
					}
				}
				$res = true;
				if($res && !$errors)
				{
					header('Location: /admin');
				}
			}

			require_once(ROOT . '/view/page/admin/updateByName.php');
			return true;
		}


	}