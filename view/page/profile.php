<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 13.08.2019
	 * Time: 18:58
	 */
	include(ROOT . '/view/layouts/header.php');
?>


<?php

	if(!$userId):
		?>
		<link rel="stylesheet" href="/view/css/register.css">
		<div class="container">
			<form action="signIn" method="post" id="main_form">
				<h1>Авторизация</h1>
				<div class="row">
					<div class="col-3">
						<div class="row p-3">
							<label for="login">Email:</label>
						</div>
						<div class="row p-3">
							<label for="pass">Пароль:</label>
						</div>
					</div>
					<div class="col-9">
						<div class="row p-3">
							<input class="w-100" autofocus id="login" name="login" type="email">
						</div>
						<div class="row p-3">
							<input class="w-100" id="pass" name="pass" type="password">
						</div>
						<div class="row p-3">
							<input
									type="submit" name="butt_signIn" id="butt_signIn" class="btn btn-info w-100"
									value="Войти">
						</div>
					</div>
				</div>
			</form>
			<?php
				if(isset($errors) && is_array($errors)):
					?>
					<ul class="col-3">
						<?php foreach($errors as $item): ?>
							<li>- <?= $item ?></li>
						<?php
						endforeach;
						?>
					</ul>

				<?php
				endif;
			?>
		</div>

	<?php
	else:

		?>
		<link rel="stylesheet" href="/view/css/profile.css">


		<div class="container">
			<div class="row">
				<img src="<?= $user['u_path_avatar'] ?>" alt="avatar.png" class="col-2" id="avatar">
				<ul class="col-4 userInfo">
					<li>Ник: <span><?= $user['nickname'] ?></span></li>
					<li>Пол: <span><?= $user['sex'] ?></span></li>
					<?php
						if(isset($user['u_birthday'])):
							?>
							<li>День рождения: <span><?= $user['u_birthday'] ?></span></li>
						<?php
						endif;
					?>
					<li>Описание: <span><?= $user['u_description'] ?></span></li>
				</ul>
			</div>
			<div class="row">
				<ul class="buttList col-4">
					<li><a class="btn btn-info w-100" href="reading">Читаю</a></li>
					<li><a class="btn btn-info" href="alereadyRead">Прочитано</a></li>
					<li><a class="btn btn-info" href="willRead">Буду читать</a></li>
					<li><a type="submit" name="edit" class="btn btn-dark" href="editProfile">Редактировать профиль</a></li>
				</ul>
			</div>
		</div>


	<?php
	endif;
?>
<?php
	include(ROOT . '/view/layouts/footer.php');
?>