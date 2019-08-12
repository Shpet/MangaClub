<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 09.06.2019
	 * Time: 20:36
	 */

	class UserController
	{

		public function actionRegister()
		{
			$nick = '';
			$email = '';
			$pass = '';
			$sex = '';
			$birthday = '';
			$checked = '';
			$result = false;

			if(isset($_POST['submit']))
			{
				$nick = trim(strip_tags($_POST['nick']));
				$email = trim(strip_tags($_POST['email']));
				$pass = trim(strip_tags($_POST['pass_register']));
				$pass_repeat = trim(strip_tags($_POST['pass_repeat']));
				if(isset($_POST['sex'])){
					$sex = $_POST['sex'];
				}
				$birthday = trim(strip_tags($_POST['birthday']));

				$errors = false;

				if(!User ::checkNick($nick))
				{
					$errors[] = 'Nick has been > 2 symbols';
				}

				if(!User ::checkEmail($email))
				{
					$errors[] = 'Its not a "email"';
				}

				if(!User::checkPassword($pass))
				{
					$errors[] = 'Password has been > 5 symbols';
				}

				if(!User::checkSecondPass($pass, $pass_repeat))
				{
					$errors[] = 'Password and password_repeat a not match';
				}
				if(User::checkEmailExists($email)){
					$errors[] = "Такой email уже есть";
				}

				if($errors == false){
					if($sex == '') $sex = NULL;
					if($birthday == '') $birthday = NULL;
					$result = User::registerUser($nick, $email, $pass, $sex, $birthday);
				}
			}

			require_once(ROOT . '/view/page/register.php');
			return true;
		}
	}