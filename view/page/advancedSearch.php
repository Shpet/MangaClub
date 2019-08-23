<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 22.08.2019
	 * Time: 22:05
	 */
	include ROOT . "/view/layouts/header.php";
?>
	<script src="/view/js/search.js" defer></script>

	<link rel="stylesheet" href="/view/css/newBook.css">
	<link rel="stylesheet" href="/view/css/search.css">

	<div class="content">
		<?php
			if(!isset($bookList)):
				?>
		<div class="container">
			<ul>
				<li>
					<form action="#" method="post">
						<label for="name" class="col-2">По имени</label>
						<input type="text" name="name" required id="name" class="col-3">
						<input type="submit" name="searchName" class="btn-sm btn-info col-1" value="Искать">
					</form>
				</li>
				<li>
					<form action="#" method="post">
						<label for="genre" class="col-2">По жанру</label>
						<select name="genre" required id="genre" class="col-3">
							<option value="Апокалиптика">Апокалиптика</option>
							<option value="Боевые искусства">Боевые искусства</option>
							<option value="Детектив">Детектив</option>
							<option value="Добуцу">Добуцу</option>
							<option value="Драма">Драма</option>
							<option value="Киберпанк">Киберпанк</option>
							<option value="Комедия">Комедия</option>
							<option value="Меха">Меха</option>
							<option value="Мистика">Мистика</option>
							<option value="Романтика">Романтика</option>
							<option value="Фэнтези">Фэнтези</option>
						</select>
						<input type="submit" name="searchGenre" class="btn-sm btn-info col-1" value="Искать">
					</form>
				</li>
				<li>
					<form action="#" method="post">
						<label for="author" class="col-2">По автору</label>
						<input type="text" name="author" required id="author" class="col-3">
						<input type="submit" name="searchAuthor" class="btn-sm btn-info col-1" value="Искать">
					</form>
				</li>
				<li>
					<form action="#" method="post">
						<label for="year" class="col-2">По году выхода</label>
						<input type="number" minlength="4" maxlength="4" name="year" id="year" class="col-3">
						<input type="submit" name="searchYear" class="btn-sm btn-info col-1" value="Искать">
					</form>
				</li>
			</ul>
		</div>
		<?php
			else:
		?>

		<div class="container-fluid">
			<?php
					foreach($bookList as $item):
			?>
			<div class="row">
				<div class="col-1">
					<img src="<?= $item['b_path_logo'] ?>" alt="1" width="100">
				</div>
				<div class="col-9">
					<p class="text-uppercase h5"><a href="/book/<?= $item['id_book'] ?>/about"><?= $item['name_book'] ?></a></p>
					<b>Автор:</b> <?= $item['author'] ?> <br>
					<b>Жанр:</b> <?= $item['name_genre'] ?><br>
					<span><b>Описание:</b>  <?= $item['b_description'] ?></span>
					<div class="row">


						<div class="col-6">
							<div class="btn-group-sm p-2">
								<a href="/book/<?= $item['id_book'] ?>/about" class="btn btn-dark text-left">Подробнее</a>
								<a href="/book/<?= $item['id_book'] ?>/read" class="btn btn-dark text-left">Читать</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				endforeach;
			?>
		</div>
				<?php
			endif;
				?>

	</div>

<?php
	include ROOT . "/view/layouts/footer.php";
