<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 11.06.2019
	 * Time: 16:20
	 */

	abstract class Db
	{
		private static $conection;

		public static function getConnection()
		{
			if (!self::$conection)
			{
				$host = 'localhost';
				$db   = 'mangaclubbd';
				$user = 'root';
				$pass = '';
				$charset = 'utf8';
				$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
				$opt = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
				];
				self::$conection = new PDO($dsn, $user, $pass, $opt);
			}
			return self::$conection;
		}
	}