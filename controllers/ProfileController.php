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
			$u_path_avatar = $user['u_path_avatar'];
			$checked = '';

			$result = false;

			if(isset($data['saveChange'])){

				if($data['nick'] ) $nick = $data['nick'];
				if($data['pass']){
					$pass = $data['pass'];
				}
				if($_FILES['avatar']['size'] > 0)
				{
					$name_file = $userId . '.jpg';
					$structure = ROOT . '/view/img/user_avatar/';


					if(is_uploaded_file($_FILES['avatar']['tmp_name']))
					{

						$uploads_dir = $structure;
						$error = $_FILES["avatar"]["error"];

						if($error == UPLOAD_ERR_OK)
						{
							$tmp_name = $_FILES["avatar"]["tmp_name"];
							move_uploaded_file($tmp_name, "$uploads_dir/$name_file");
							$u_path_avatar = '/view/img/user_avatar/' . $name_file;
						}
					}
					else
						$errors[] = 'Не удалось загрузить аватар';
				}
				if(isset($data['sex'])) $sex = $data['sex'];
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
					$result = User::edit($userId, $nick, $pass, $sex, $birthday, $description, $u_path_avatar);
				}
			}
			require_once(ROOT . '/view/page/editProfile.php');
			return true;
		}
	}