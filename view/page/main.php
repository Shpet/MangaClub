<?php
include ROOT.'/view/layouts/header.php';
?>


<div class="content">
<!--	полоса недавно добавленных-->
	<section>
		<div id="recently_added" class="carousel slide" data-interval="7000" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item text-center active">
					<a href="#">
						<img src="view/img/preview/text.jpg" alt="Akame Ga Kill" class="d-inline-flex">
					</a>

					<?php
						$count = 0;
						for($i = 0; $i < count($newBook); $i++):

							?>

							<a href="#">
								<img src="<?= $newBook[$i]['b_path_logo'] ?>" alt="<?= $newBook[$i]['name_book'] ?>">
							</a>

							<?php
							$count++;
							if($count > 5)
							{
								for($i = $count; $i < count($newBook); $i++)
								{
									$newBook2[$i] = $newBook[$i];
								}
								break;
							}
						endfor;
					?>

				</div>

				<?php
					if($count > 5):
				?>
				<div class="carousel-item text-center">
					<a href="#">
						<img src="view/img/preview/text.jpg" alt="Akame Ga Kill" class="d-inline-flex">
					</a>
					<?php
						foreach($newBook2 as $bookItem):
							?>
							<a href="#">
								<img src="<?= $bookItem['b_path_logo'] ?>" alt="<?= $bookItem['name_book'] ?>"
										class="d-inline-flex">
							</a>
						<?php
						endforeach;
					?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</section>

	<article>
		<div class="album py-5">
			<div class="container">
				<p class="h3 text-center">Топ рейтинг</p>
				<div class="row ">
					<?php
						foreach($popularBook as $item):
					?>
					<div class="col-md-4">
						<div class="card mb-4 box-shadow">
							<img class="card-img-top" src="<?=$item['b_path_logo_big'] ?>" alt="Card image cap" width="300" >
							<div class="card-body">
								<h5 class="card-text"><?=$item['name_book'] ?></h5>
								<p>Жанр: <?=$item['name_genre'] ?></p>
								<div class="d-flex justify-content-between">
									<div class="btn-group">
										<a class="btn btn-outline-light">Читать</a>
										<a class="btn btn-outline-light">Подробнее</a>
									</div>
									<small>Рейтинг: <?=$item['b_rating']?></small>
								</div>
							</div>
						</div>
					</div>
					<?php
						endforeach;
					?>
				</div>
			</div>
		</div>
	</article>
</div>
<?php
	include ROOT.'/view/layouts/footer.php';
?>
