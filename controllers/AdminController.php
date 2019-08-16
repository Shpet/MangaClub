<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 16.08.2019
	 * Time: 12:51
	 */

	class AdminController
	{

		public  function actionIndex(){

			User::checkAdmin();



			require_once ROOT . '/view/page/admin/adminPanel.php';
			return true;
		}

		public function actionAdd(){

			return true;
		}
		public function actionUpdate($id){

			User::checkAdmin();

			$book = Book::getBookById($id);
			header('Location: /admin/update/'.$book['name_book']);
		}
		public function actionDelete($id){

			User::checkAdmin();

			if($id) Book::deleteBookById($id);

			header("Location: /");
		}
		public function actionAdminDelete(){

			User::checkAdmin();

			$data = $_POST;
			$name = '';
			$res = false;
			$errors = '';
			if(isset($data['del'])){
				$name = $data['name'];
				if(Book::checkNameBookExists($name)){
					$res = Book::deleteBookByName($name);
				}
				else{
					$errors = 'Неправильное имя';
				}
			}


			require_once (ROOT.'/view/page/admin/delete.php');
			return true;
		}

		public function actionAdminUpdate(){

			User::checkAdmin();
			$data = $_POST;
			$name = '';
			$res = false;
			if(isset($data['update'])){
				$name = $data['name'];
				if(Book::checkNameBookExists($name))
					header('Location: /admin/update/'.$name);
			}


			require_once(ROOT . '/view/page/admin/update.php');
			return true;
		}

		public function actionAdminUpdateByName($name){

			User::checkAdmin();

			$data = $_POST;
			$res = false;
			$errors = '';
			$book = Book::getBookByName($name);
			$id = $book['id_book'];
			$name = $book['name_book'];
			$author = $book['author'];
			if($book['ongoing'] == 'да') $ongoing = '1';
			else $ongoing = '0';
			$year = $book['b_year'];
			$description = $book['b_description'];

			if(isset($data['saveUpdate']))
			{
				if($data['name'])
				{
					$name = $data['name'];

					if(!Book ::checkNameBookExists($name))
					{
						$errors = 'Такое имя уже есть';
					}
				}
				if($data['author']) $author = $data['author'];
				if($data['ongoing']) $ongoing = $data['ongoing'];
				if($data['year']) $year = $data['year'];
				if($data['description']) $description = $data['description'];

				if($errors){
					Book::updateBookById($id, $name, $author, $ongoing, $year, $description);
					$res = true;
				}
			}

			require_once(ROOT . '/view/page/admin/updateByName.php');
			return true;
		}




	}