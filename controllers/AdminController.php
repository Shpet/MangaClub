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
		public function actionUpdate(){

			return true;
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
			if(isset($data['del'])){
				$name = $data['name'];
			}
			if($name){
				$res = Book::deleteBookByName($name);
			}

			require_once (ROOT.'/view/page/admin/delete.php');
			return true;
		}



	}