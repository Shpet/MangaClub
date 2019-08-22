<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.06.2019
	 * Time: 20:36
	 */

	class UserController
	{

		public function actionSignIn()
		{
			$data = $_POST;
			$login = '';
			$pass = '';

			if(isset($data['butt_signIn']))
			{

				$login = trim(strip_tags($data['login']));
				$pass = $data['pass'];

				$errors = false;

				$userId = User ::checkUserData($login, $pass);

				if($userId == false)
				{
					$errors[] = 'Неправильно введены данные';
				}
				else
				{
					User ::addInSession($userId);
					header('Location: /');
				}
			}
			require_once(ROOT . '/view/page/profile.php');
			return true;
		}

		public function actionRegister()
		{
			$nick = '';
			$email = '';
			$pass = '';
			$sex = '';
			$birthday = '';
			$checked = '';
			$result = false;

			$data = $_POST;

			if(isset($data['submit']))
			{
				$nick = trim(strip_tags($data['nick']));
				$email = trim(strip_tags($data['email']));
				$pass = ($data['pass_register']);
				$pass_repeat = ($data['pass_repeat']);
				if(isset($data['sex']))
				{
					$sex = $data['sex'];
				}
				$birthday = trim(strip_tags($data['birthday']));

				$errors = false;

				if(!User ::checkNick($nick))
				{
					$errors[] = 'Nick has been > 2 symbols';
				}

				if(!User ::checkEmail($email))
				{
					$errors[] = 'Its not a "email"';
				}

				if(!User ::checkPassword($pass))
				{
					$errors[] = 'Password has been > 5 symbols';
				}

				if(!User ::checkSecondPass($pass, $pass_repeat))
				{
					$errors[] = 'Password and password_repeat a not match';
				}
				if(User ::checkEmailExists($email))
				{
					$errors[] = "Такой email уже есть";
				}

				if($errors == false)
				{
					if($sex == '') $sex = NULL;
					if($birthday == '') $birthday = NULL;
					$pass = password_hash($pass, PASSWORD_DEFAULT);
					$result = User ::registerUser($nick, $email, $pass, $sex, $birthday);
					if($result){
						$userId = User::checkUserData($email, $pass);
						User ::addInSession($userId);
						header('Location: /');
					}
				}
			}

			require_once(ROOT . '/view/page/register.php');
			return true;
		}


		public static function actionLogout(){
			unset($_SESSION["user"]);
			header("Location: /");
		}
	}