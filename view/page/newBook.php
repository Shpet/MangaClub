<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 19.06.2019
	 * Time: 13:24
	 */
	include ROOT . '/view/layouts/header.php';
?>
<script src='/view/js/newBookPage.js' defer></script>
<script src="/Resource/library/jquery.fancybox.min.js" defer></script>

<link rel="stylesheet" href="/view/css/newBook.css">
<link rel="stylesheet" href="/Resource/library/jquery.fancybox.min.css">

<div class="content">
	<div class="container-fluid">
		<?php
			foreach($newBook as $item):
				?>
				<div class="row">
					<div class="col-1">
						<a data-fancybox="gallery" href="<?= $item['b_path_logo_big'] ?>">
							<img src="<?= $item['b_path_logo'] ?>" alt="1" width="100">
						</a>

					</div>
					<div class="col-9">
						<p class="text-uppercase h5"><a
									href="/book/<?= $item['id_book'] ?>/about"><?= $item['name_book'] ?></a></p>
						<b>Автор:</b> <?= $item['author'] ?>
						<br>
						<b>Жанр:</b> <?= $item['name_genre'] ?>
						<br>
						<span><b>Описание:</b> <?= $item['b_description'] ?></span>
						<div class="row">


							<div class="col-6">
								<div class="btn-group-sm p-2">
									<a href="/book/<?= $item['id_book'] ?>/about" class="btn btn-dark text-left">Подробнее</a>
									<a
											href="/book/<?= $item['id_book'] ?>/read" class="btn btn-dark text-left">Читать</a>
								</div>
							</div>
							<div class="col-6 text-right pt-3">
								<span class="rating">
										<a href="#" data-book-id="<?= $item['id_book'] ?>" class="like"><i
													class="fas fa-thumbs-up success"></i></a> <span>
											<?php
												foreach($countLikes as $value)
												{
													if($value['id_book'] == $item['id_book']) echo ($value['count']);
												}
											?>
												</span>
										<a href="#" data-book-id="<?= $item['id_book'] ?>" class="dislike"><i
													class="fas fa-thumbs-down denied"></i></a> <span>
													<?php
														foreach($countDislikes as $value)
														{
															if($value['id_book'] ==
															   $item['id_book']) echo($value['count']);
														}
													?>
												</span>
									</span>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
	</div>
</div>

<script src="/view/js/rating.js"></script>

<?php
	include ROOT . '/view/layouts/footer.php';
?>


