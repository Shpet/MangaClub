<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 12.08.2019
	 * Time: 16:53
	 */

	class User
	{
		public static function registerUser($nick, $email, $pass, $sex = NULL, $birthday = NULL)
		{
			$db = Db::getConnection();

			$sql = 'INSERT INTO `user`( `email`, `password`, `nickname`, `sex`, `u_birthday`)'.
				   ' VALUES (:email, :pass, :nick, :sex, :birthday)';

			$result = $db->prepare($sql);
			$result->bindParam(':email', $email, PDO::PARAM_STR);
			$result->bindParam(':pass', $pass, PDO::PARAM_STR);
			$result->bindParam(':nick', $nick, PDO::PARAM_STR);
			$result->bindParam(':sex', $sex, PDO::PARAM_STR);
			$result->bindParam(':birthday', $birthday, PDO::PARAM_STR);

			return $result->execute();
		}

		public static function checkNick($nick)
		{
			if(strlen($nick) > 2)
			{
				return true;
			}
			return false;
		}

		public static function checkPassword($pass)
		{
			if(strlen($pass) > 5)
			{
				return true;
			}
			return false;
		}

		public static function checkEmail($email)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				return true;
			}
			return false;
		}

		public static function checkSecondPass($pass1, $pass2)
		{
			if($pass1 == $pass2)
			{

				return true;
			}
			return false;
		}

		public static function checkEmailExists($email)
		{
			$db = Db ::getConnection();
			$sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

			$result = $db -> prepare($sql);
			$result -> bindParam(':email', $email, PDO::PARAM_STR);
			$result -> execute();

			if($result -> fetchColumn()) return true;
			return false;
		}
	}