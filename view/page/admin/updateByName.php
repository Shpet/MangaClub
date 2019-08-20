<?php
	include ROOT . '/view/layouts/header.php';
?>

	<link rel="stylesheet" href="/view/css/crud.css">


	<div class="container update">
		<form action="#" method="post" id="main_form" enctype="multipart/form-data">

			<?php
				$selected = '';
				?>
			<h1>Изменение</h1>

			<div class="row">
				<div class="col-4 pr-0">
					<label for="addTom">Добавить новый том: </label>
				</div>
				<div class="col-7">
					<input type="checkbox" name="addTom" id="addTom" value="1">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="addChapter">Добавить главу: </label>
				</div>
				<div class="col-7">
					<input type="checkbox" name="addChapter" id="addChapter" value="1">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="addFile">Добавить страницы: </label>
				</div>
				<div class="col-7">
					<input type="file" multiple name="content[]" accept="image/*">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="addArts">Добавить арты: </label>
				</div>
				<div class="col-7">
					<input type="file" multiple name="arts[]" accept="image/*">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="logo">Изменить логотип: </label>
				</div>
				<div class="col-7">
					<input type="file" id="logo" name="logo" accept="image/jpeg">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="logoBig">Изменить логотип(Высота 300px): </label>
				</div>
				<div class="col-7">
					<input type="file" id="logoBig" name="logoBig" accept="image/jpeg">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Название: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="name" name="name" type="text" placeholder="<?=$book['name_book'] ?>">
				</div>
			</div>
			<div class="row row_genre">
				<div class="col-4 pr-0">
					<label for="genre[]">Жанр (зажав ctrl выбрать все жанры, которые соответствуют): </label>
				</div>
				<div class="col-3">
					<select name="genre[]" id="genre" multiple size="11">
						<option value="1">Апокалиптика</option>
						<option value="2">Боевые Искуства</option>
						<option value="3">Детектив</option>
						<option value="4">Добуцу</option>
						<option value="5">Драма</option>
						<option value="6">Киберпанк</option>
						<option value="7">Комедия</option>
						<option value="8">Меха</option>
						<option value="10">Мистика</option>
						<option value="11">Романтика</option>
						<option value="12">Фэнтези</option>
					</select>
				</div>
				<div class="col-4">
					<textarea name="active_genre" id="active_genre" rows="4" readonly>Активные: <?=$book['genre']; ?></textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-4 pr-0">
					<label for="author">Автор: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="author" name="author" type="text" placeholder="<?=$book['author'] ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="ongoing">Оноинг </label>
				</div>
				<div class="col-7">
					<select name="ongoing" id="ongoing">
						<?php
							if(!$ongoing)
								$selected = 'selected';
						?>
						<option value="0" <?=$selected ?>>Нет</option>
						<?php
							$selected = '';
							if($ongoing)
								$selected = 'selected';
						?>
						<option value="1" <?=$selected ?>>Да</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="year">Год выхода: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="year" name="year" type="number" maxlength="4" placeholder="<?=$book['b_year']?>">
				</div>
			</div>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="description">Описание: </label>
				</div>
				<div class="col-7">
					<textarea name="description" id="description" cols="30" rows="5" placeholder="<?=$book['b_description'] ?>"></textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-7 offset-4">
					<input  type="submit" name="saveUpdate" value="Сохранить изменения" class="btn btn-light w-100 mt-3">
				</div>
			</div>
		</form>
		<?php
			if($errors):
				?>
				<ul class="col-3">
					<?php
						foreach($errors as  $item)
							echo'<li>'.$item.'</li>';
					?>
				</ul>

			<?php
			endif;
		?>
	</div>

<?php
	include ROOT . '/view/layouts/footer.php';

?>