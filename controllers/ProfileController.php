<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 13.08.2019
	 * Time: 18:57
	 */

	class ProfileController
	{
		public function actionIndex(){

			$userId = User::checkLogged();
			$user = User::getUserById($userId);

			require_once (ROOT.'/view/page/profile.php');
			return true;
		}

		public function actionEdit(){

			$userId = User::checkLogged();
			$user = User::getUserById($userId);

			$data = $_POST;
			$nick = $user['nickname'];
			$pass = $user['password'];
			$sex = $user['sex'];
			$birthday = $user['u_birthday'];
			$description = $user['u_description'];
			$checked = '';

			$result = false;

			if(isset($data['saveChange'])){

				if($data['nick'] ) $nick = $data['nick'];
				if($data['pass']){
					$pass = $data['pass'];
				}
				if($data['sex']) $sex = $data['sex'];
				if($data['birthday']) $birthday = $data['birthday'];
				if($data['u_description']) $description = $data['u_description'];

				$errors = false;

				if(!User::checkNick($nick)){
					$errors[] = 'Имя должно состоять с 3 и больше символов';
				}
				if(!User::checkPassword($pass)){
					$errors[] = 'Пароль должен состоять с 6 и больше символов';
				}
				if($errors == false){
					$pass = password_hash($pass, PASSWORD_DEFAULT);
					$result = User::edit($userId, $nick, $pass, $sex, $birthday, $description);
				}
			}
			require_once(ROOT . '/view/page/editProfile.php');
			return true;
		}
	}