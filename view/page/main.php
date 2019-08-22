<?php
	include ROOT . '/view/layouts/header.php';
?>


<div class="content">
	<!--	полоса недавно добавленных-->
	<section>
		<div id="recently_added" class="carousel slide" data-interval="7000" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item text-center active">
					<a href="/newBook">
						<img src="/view/img/preview/text.jpg" alt="Akame Ga Kill" class="d-inline-flex">
					</a>

					<?php
						$count = 0;
						for($i = 0; $i < count($newBook); $i++):

							?>

							<a href="/book/<?= $newBook[$i]['id_book'] ?>/about">
								<img src="<?= $newBook[$i]['b_path_logo'] ?>" alt="<?= $newBook[$i]['name_book'] ?>">
							</a>

							<?php
							$count++;
							if($count > 5)
							{
								// 12 = 2 слайда
								for($i = 0; $i < 12 - $count; $i++)
								{
									$newBook2[$i] = $newBook[$count];
									$count++;
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
					<a href="/newBook">
						<img src="/view/img/preview/text.jpg" alt="Akame Ga Kill" class="d-inline-flex">
					</a>
					<?php
						foreach($newBook2 as $bookItem):
							?>
							<a href="/book/<?= $bookItem['id_book'] ?>/about">
								<img
										src="<?= $bookItem['b_path_logo'] ?>" alt="<?= $bookItem['name_book'] ?>"
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
									<img
											class="card-img-top" src="<?= $item['b_path_logo_big'] ?>"
											alt="Card image cap" height="515px">
									<div class="card-body">
										<h5 class="card-text"><?= $item['name_book'] ?></h5>
										<p class="description">Описание: <?= $item['description'] ?></p>
										<div class="d-flex justify-content-between">
											<div class="btn-group">
												<a
														href="/book/<?= $item['id_book'] ?>/read"
														class="btn btn-outline-light">Читать</a>
												<a href="book/<?= $item['id_book'] ?>/about" class="btn btn-outline-light">Подробнее</a>
											</div>
											<span class="rating">
										<a href="#" data-book-id="<?= $item['id_book'] ?>" class="like"><i
													class="fas fa-thumbs-up success"></i></a> <span>
											<?php
												foreach($countLikes as $value)
												{
													if($value['id_book'] == $item['id_book']) echo($value['count']);
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
						<?php
						endforeach;
					?>
				</div>
			</div>
		</div>
	</article>
</div>
<script src="/view/js/rating.js"></script>

<?php
	include ROOT . '/view/layouts/footer.php';
?>
