<?php
	include ROOT . '/view/layouts/header.php';
?>
<script src="/Resource/library/jquery.fancybox.min.js" defer></script>
<script src="/view/js/aboutBook.js" defer></script>

<link rel="stylesheet" href="/view/css/aboutBook.css">
<link rel="stylesheet" href="/Resource/library/jquery.fancybox.min.css">


<div class="content">
	<div class="row my-4">
		<div class="col-3">
			<img src="<?= $bookItem['b_path_logo_big'] ?>" alt="<?= $bookItem['name_book'] ?>">
		</div>
		<div class="col-7 pl-0">
			<h2 class="my-3"><?= $bookItem['name_book'] ?>
				<?php if(User ::checkAdmin()): ?>
					<a id="deleteBook" href="/delete/<?= $bookItem['id_book'] ?>"><i class="fas fa-trash-alt"></i></a>
					<a id="updateBook" href="/update/<?= $bookItem['id_book'] ?>"><i class="fas fa-pen"></i></a>
				<?php
				endif;
				?>
			</h2>
			<p class="h5"><b>Автор:</b> <?= $bookItem['author'] ?></p>
			<p class="h5"><b>Год выхода:</b> <?= $bookItem['b_year'] ?></p>
			<p class="h5"><b>Жанр: </b><span class="text-lowercase"><?= $bookItem['genre'] ?></span></p>
			<p class="h5"><b>Онгоинг:</b> <?= $bookItem['ongoing'] ?></p>
			<p class="h5"><b>Описание:</b> <?= $bookItem['b_description'] ?></p>
			<a href="/book/<?= $bookItem['id_book'] ?>/read" class="btn btn-info">Читать</a>
			<p class="rating text-right">
				<a href="#" data-book-id="<?= $bookItem['id_book'] ?>" class="like">
					<i class="fas fa-thumbs-up success"></i>
				</a>
				<span><?= $countLikes ?></span>
				<a href="#" data-book-id="<?= $bookItem['id_book'] ?>" class="dislike">
					<i class="fas fa-thumbs-down denied"></i>
				</a>
				<span><?= $countDislikes ?></span>
			</p>
		</div>
	</div>
	<div class="row justify-content-center mt-5">
		<h1>Arts</h1>
	</div>
	<div class="row">
		<div class="album py-5">
			<div class="container-fluid">
				<div class="row">
					<?php
						foreach($arts as $item):
							?>

							<div class=" col-md-3 my-3">
								<a data-fancybox="gallery" href="<?= $item ?>">
									<img class="card-img-top" alt="Art" src="<?= $item ?>" data-holder-rendered="true">
								</a>
							</div>
						<?php
						endforeach;
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/view/js/rating.js" defer></script>

<?php
	include ROOT . '/view/layouts/footer.php';
?>


