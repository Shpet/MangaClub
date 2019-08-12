<?php
	include ROOT . '/view/layouts/header.php';
?>

<link rel="stylesheet" href="/view/css/register.css">


<div class="container">
<?php
	if($result):
	?>
	<div>Register success</div>
<?php
	else:
?>
	<form action="register" method="post" id="main_form">
		<div class="row">
			<div class="col">
				<div class="row ">
					<label for="email">Email:</label>
				</div>
				<div class="row ">
					<label for="nick">Nickname:</label>
				</div>
				<div class="row ">
					<label for="pass_registr">Пароль:</label>
				</div>
				<div class="row ">
					<label for="pass_repeat">Повторите пароль:</label>
				</div>
				<div class="row">
					<label>
						Пол
					</label>
				</div>
				<div class="row ">
					<label for="birthday">Дата рождения:</label>
				</div>
			</div>
			<div class="col">
				<div class="row ">
					<input
							class="w-100" autofocus id="email" name="email" type="email"
							placeholder="example@gmail.com" required value="<?= $email ?>">
				</div>
				<div class="row ">
					<input
							class="w-100" id="nick" name="nick" type="text" placeholder="Nickname" required
							value="<?= $nick ?>">
				</div>
				<div class="row ">
					<input
							class="w-100" id="pass_register" name="pass_register" type="password" required
							value="<?= $pass ?>">
				</div>
				<div class="row">
					<input
							class="w-100" id="pass_repeat" name="pass_repeat" type="password" required>
				</div>
				<div class="row">
					<?php
						if($sex == 'man') $checked = 'checked';
					?>
					<label class="sex_lab">
						<input type="radio" name="sex" value="man" <?=$checked?>>Парень
					</label>
					<?php
						if($sex == 'woman') $checked = 'checked';
					?>
					<label class="sex_lab">
						<input type="radio" name="sex" value="woman" <?=$checked?>>Девушка
					</label>
				</div>
				<div class="row">
					<input class="w-100" id="birthday" name="birthday" type="date" value="<?= $birthday ?>">
				</div>
				<div class="row">
					<input
							type="submit" id="submit" name="submit" class="btn btn-info w-100"
							value="Зарегистрироваться">
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
	endif;
	?>
</div>
<?php
	include ROOT . '/view/layouts/footer.php';

?>
