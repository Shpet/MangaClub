<?php
	include ROOT . '/view/layouts/header.php';
?>

	<link rel="stylesheet" href="/view/css/crud.css">

<?php
	$checked = '';
	if($res):
		?>
		<h3 class="success">Обновление успешно</h3>

	<?php
	endif;
?>
	<div class="container">

		<form action="" method="post" id="main_form">
			<h1>Изменение</h1>

			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Название: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="name" name="name" type="text" value="<?=$book['name_book'] ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Автор: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="author" name="author" type="text" value="<?=$book['author'] ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Оноинг </label>
				</div>
				<div class="col-7">
					<select name="ongoing" id="ongoing">
						<?php
							$checked = '';
							if($book['ongoing'] == 'нет')
								$checked = 'checked';
						?>
						<option value="0" <?=$checked ?>>Нет</option>
						<?php
							$checked = '';
							if($book['ongoing'] == 'да')
							$checked = 'checked';
						?>
						<option value="1">Да</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Год выхода: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="year" name="year" type="number" maxlength="4" value="<?=$book['b_year']?>">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Описание: </label>
				</div>
				<div class="col-7">
					<textarea name="description" id="description" cols="30" rows="5" placeholder="<?=$book['b_description'] ?>"></textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-7 offset-4">
					<input name="saveUpdate" type="submit" value="Сохранить изменения" class="btn btn-light w-100 mt-3">
				</div>
			</div>
		</form>
		<?php
			if($errors && !$res):
				?>
				<ul class="col-3">
						<li><?= $errors ?></li>
				</ul>

			<?php
			endif;
		?>
	</div>
<?php
	include ROOT . '/view/layouts/footer.php';

?>