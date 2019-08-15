<?php
	include ROOT . '/view/layouts/header.php';
?>

	<link rel="stylesheet" href="/view/css/register.css">

<?php
	if($result):
		?>
		<h3 class="success">Изменения сохранены</h3>

	<?php
	endif;
?>
	<div class="container">



		<form action="#" method="post" id="main_form" class="w-auto">
			<h1>Редактирование данных</h1>
			<div class="row">
				<div class="col-5">
					<div class="row ">
						<label for="nick">Nickname:</label>
					</div>
					<div class="row ">
						<label for="pass_registr">Пароль:</label>
					</div>
					<div class="row">
						<label>
							Пол
						</label>
					</div>
					<div class="row ">
						<label for="birthday">Дата рождения:</label>
					</div>
					<div class="row ">
						<label for="u_description">Расскажите о себе:</label>
					</div>
				</div>
				<div class="col-7">
					<div class="row ">
						<input class="w-100" id="nick" name="nick" type="text" placeholder="<?= $nick ?>">
					</div>
					<div class="row ">
						<input class="w-100" id="pass" name="pass" type="password">
					</div>
					<div class="row">
						<?php
							if($sex == 'man') $checked = 'checked';
						?>
						<label class="sex_lab">
							<input type="radio" name="sex" value="man" <?= $checked ?>>Парень
						</label>
						<?php
							$checked = '';
							if($sex == 'woman') $checked = 'checked';
						?>
						<label class="sex_lab">
							<input type="radio" name="sex" value="woman" <?= $checked ?>>Девушка
						</label>
					</div>
					<div class="row">
						<input class="w-100" id="birthday" name="birthday" type="date" value="<?= $birthday ?>">
					</div>
					<div class="row">
						<textarea
								class="w-100" name="u_description" id="u_description" maxlength="500" rows="5"
								placeholder="<?= $description ?>"></textarea>
					</div>
					<div class="row">
						<input
								type="submit" id="saveChange" name="saveChange" class="btn btn-info w-100"
								value="Сохранить">
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
	include ROOT . '/view/layouts/footer.php';

?>