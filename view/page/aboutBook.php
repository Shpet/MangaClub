<?php

	include ROOT.'/view/layouts/header.php';
?>
<link rel="stylesheet" href="/view/css/aboutBook.css">
<div class="content">
	<div class="row py-3">
		<div class="col-3">
			<img src="<?=$bookItem['b_path_logo_big'] ?>" alt="<?=$bookItem['name_book']  ?>">
		</div>
		<div class="col-7 pl-0">
			<h2 class="my-3"><?=$bookItem['name_book'] ?> </h2>
			<p class="h5"><b>Автор:</b> <?=$bookItem['author'] ?></p>
			<p class="h5"><b>Год выхода:</b> <?=$bookItem['b_year'] ?></p>
			<p class="h5"><b>Жанр: </b><span class="text-lowercase"><?=$bookItem['genre'] ?></span> </p>
			<p class="h5"><b>Онгоинг:</b> <?=$bookItem['ongoing'] ?></p>
			<p class="h5"><b>Описание:</b> <?=$bookItem['b_description'] ?></p>
			<p class="h5 text-right"><b>Рейтинг:</b> <?=$bookItem['b_rating'] ?></p>
		</div>
	</div>
</div>
<?php
	include ROOT.'/view/layouts/footer.php';
?>


