<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 19.06.2019
	 * Time: 13:24
	 */
	include ROOT.'/view/layouts/header.php';
	?>
<script src='view/js/newBookPage.js' defer></script>
<script src="Resource/Librarry/jquery.fancybox.min.js" defer></script>

<link rel="stylesheet" href="view/css/newBook.css">
<link rel="stylesheet" href="Resource/Librarry/jquery.fancybox.min.css">

<div class="content" >
	<div class="container-fluid">
		<?php
			foreach($newBook as $item):
		?>
		<div class="row">
			<div class="col-1">
				<a data-fancybox="gallery" href="<?=$item['b_path_logo_big']?>">
					<img src=<?=$item['b_path_logo'] ?> alt="1" width="100">
				</a>

			</div>
			<div class="col-9">
				<p class="text-uppercase h5"><a href="#"><?=$item['name_book'] ?></a></p>
				<b>Автор:</b> <?=$item['author']?>
				<br>
				<b>Жанр:</b> <?=$item['name_genre']?>
				<br>
				<span><b>Описание:</b> <?=$item['b_description'] ?></span>

				<p class="text-right pt-3">Рейтинг: <?=$item['b_rating']?></p>
			</div>
		</div>

		<?php endforeach; ?>
	</div>

</div>
<?php
	include ROOT.'/view/layouts/footer.php';
	?>


