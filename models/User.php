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

		public static function checkUserData($email, $pass){

			$db = Db::getConnection();


			//создём hash пароля
			$sql_pass = 'SELECT id_user, email, password FROM user WHERE email = :email';
			$hash = $db->prepare($sql_pass);
			$hash->bindParam(':email', $email,PDO::PARAM_STR);
			$hash->execute();
			$res = $hash->fetch();
			$hash_pass = $res['password'];
			if(password_verify($pass, $hash_pass) && $res){
				return $res['id_user'];
			}
			return false;
		}

		public static function edit($userId, $nick, $pass, $sex, $birthday, $description){
			$db = Db::getConnection();

			$sql = 'UPDATE user '.
				   ' SET nickname = :nick, password = :pass, sex = :sex, u_birthday = :birthday, u_description = :description'.
				   ' WHERE id_user = :id';

			$res = $db->prepare($sql);
			$res -> bindParam(':id', $userId, PDO::PARAM_INT);
			$res -> bindParam(':nick', $nick, PDO::PARAM_STR);
			$res -> bindParam(':pass', $pass, PDO::PARAM_STR);
			$res -> bindParam(':sex', $sex, PDO::PARAM_STR);
			$res -> bindParam(':birthday', $birthday, PDO::PARAM_STR);
			$res -> bindParam(':description', $description, PDO::PARAM_STR);

			return $res->execute();
		}

		public static function getUserById($id){
			if($id){
				$db = Db::getConnection();
				$sql = 'SELECT * FROM user WHERE id_user = :id';

				$res = $db->prepare($sql);
				$res->bindParam(':id', $id, PDO::PARAM_INT);

				$res->setFetchMode(PDO::FETCH_ASSOC);
				$res->execute();

				return $res->fetch();
			}
		}
		public static function addInSession($id){
			$_SESSION['user'] = $id;
		}

		public static function isGuess(){

			if(isset($_SESSION['user'])){
				return false;
			}
			return true;
		}

		public static function checkLogged(){

			if(isset($_SESSION['user'])){
				return $_SESSION['user'];
			}
			return false;
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