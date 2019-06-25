<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 16.06.2019
	 * Time: 13:59
	 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="Манга, комиксы, японские комиксы, онлайн">
	<meta name="description" content="На данном сайте вы можете читать мангу и комиксы онлайн">
	<meta name="author" content="Vadim Shpet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="Resource/framework/bootstrap4/css/bootstrap.css">
	<link rel="stylesheet" href="view/css/main_body.css">
	<link rel="stylesheet" href="view/css/header.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
			integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="icon" href="view/img/favicon.ico">

	<script src="Resource/framework/bootstrap4/js/jquery-3.4.1.min.js" defer></script>
	<script src="Resource/framework/bootstrap4/js/bootstrap.bundle.min.js" defer></script>
	<script src="Resource/framework/bootstrap4/js/bootstrap.min.js" defer></script>
	<script src="view/js/anchors.js" defer></script>
	<title>Manga Club</title>
</head>
<body>
<header>
	<nav class="navbar navbar-expand-md  navbar-dark bg-dark fixed-top">
		<a href="/" class="navbar-brand">
			<img src="view/img/logo_site.png" alt="logo site"> MangaClub
		</a>

		<button class="navbar-toggler" type="button" data-target="#main_nav" data-toggle="collapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="main_nav" class="navbar-collapse collapse ">

			<ul class="nav navbar-nav">
				<li class="nav-item active">
					<a href="/" class="nav-link">Главная</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Расширенный поиск</a>
				</li>
				<li class="nav-item">
					<a href="/newBook" class="nav-link">Новинки</a>
				</li>
			</ul>

			<div class="custom-control-inline directionColumn">
				<div class="dropdown open">
					<a
							href="#" class="nav-link btn btn-secondary dropdown-toggle" id="dropdownAccount"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Аккаунт</a>
					<div class="dropdown-menu" aria-labelledby="dropdownAccount">
						<button
								type="button" data-toggle="modal" data-target="#signIn"
								class="btn btn-outline-info w-100">Войти
						</button>
						<div class="dropdown-divider"></div>
						<button
								type="button" data-toggle="modal" data-target="#signUp"
								class="btn btn-outline-secondary w-100">Регистрация
						</button>
					</div>
				</div>

				<form class="form-inline ml-3">
					<input type="search" placeholder="Поиск" class="form-control search_inp">
					<button type="submit" class="btn btn-outline-success search_btn"><i
								class="fas fa-arrow-alt-circle-right"></i></button>
				</form>
			</div>
		</div>
	</nav>

	<!--	Sign in-->
	<div class="modal fade" id="signIn">
		<div class="modal-dialog modal-sm">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header">
					<h5 class="modal-title">Вход</h5>
					<button class="close text-white" data-dismiss="modal">
						<span>&times</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="row">
							<div class="col-3">
								<div class="row p-3">
									<label for="login">Логин:</label>
								</div>
								<div class="row p-3">
									<label for="pass">Пароль:</label>
								</div>
							</div>
							<div class="col-9">
								<div class="row p-3">
									<input class="w-100" autofocus id="login" type="text">
								</div>
								<div class="row p-3">
									<input class="w-100" id="pass" type="password">
								</div>
								<div class="row p-3">
									<button class="btn btn-info w-100">Войти</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--	Sign up-->
	<div class="modal fade" id="signUp">
		<div class="modal-dialog">
			<div class="modal-content bg-dark text-white">
				<div class="modal-header">
					<h5 class="modal-title">Регистрация</h5>
					<button class="close text-white" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="row">
							<div class="col-5">
								<div class="row p-3">
									<label for="email">Email:</label>
								</div>
								<div class="row p-3">
									<label for="nick">Nickname:</label>
								</div>
								<div class="row p-3">
									<label for="pass_registr">Пароль:</label>
								</div>
								<div class="row p-3">
									<label for="pass_repeat">Повторите пароль:</label>
								</div>
								<div class="row p-3">
									<label for="birthday">Дата рождения:</label>
								</div>
							</div>
							<div class="col-7">
								<div class="row p-3">
									<input class="w-100" autofocus id="email" type="email">
								</div>
								<div class="row p-3">
									<input class="w-100" id="nick" type="text">
								</div>
								<div class="row p-3">
									<input class="w-100" id="pass_registr" type="password">
								</div>
								<div class="row p-3">
									<input class="w-100" id="pass_repeat" type="password">
								</div>
								<div class="row p-3">
									<input class="w-100" id="birthday" type="date">
								</div>
								<div class="row p-3">
									<button class="btn btn-info w-100">Зарегистрироваться</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</header>