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
<link rel="stylesheet" href="view/css/newBook.css">
<div class="content" >
	<div class="container-fluid">
		<?php
			foreach($newBook as $item):
		?>
		<div class="row">
			<div class="col-1"><img src=<?=$item['b_path_logo'] ?> alt="1" width="100"></div>
			<div class="col-9">
				<p class="text-uppercase h5"><?=$item['name_book'] ?></p>
				<b>Жанр:</b> <?=$item['name_genre']?>
				<br>
				<span><b>Описание:</b> <?=$item['b_description'] ?></span>
			</div>
		</div>

		<?php endforeach; ?>
	</div>

</div>
<?php
	include ROOT.'/view/layouts/footer.php';
	?>


