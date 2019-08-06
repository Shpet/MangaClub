<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 28.06.2019
	 * Time: 11:04
	 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="Манга, комиксы, японские комиксы, онлайн">
	<meta name="description" content="На данном сайте вы можете читать мангу и комиксы онлайн">
	<meta name="author" content="Vadim Shpet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="/Resource/framework/bootstrap4/css/bootstrap.css">
	<link rel="icon" href="/view/img/favicon.ico">
	<link rel="stylesheet" href="/view/css/readBook.css">
	<link
			rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
			integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="/Resource/library/jquery.fancybox.min.css">

	<script src="/Resource/framework/bootstrap4/js/jquery-3.4.1.min.js" defer></script>
	<script src="/Resource/framework/bootstrap4/js/bootstrap.bundle.min.js" defer></script>
	<script src="/Resource/framework/bootstrap4/js/bootstrap.min.js" defer></script>
	<script src="/view/js/anchors.js" defer></script>
	<script src="/view/js/readBook.js" defer></script>
	<script src="/Resource/library/jquery.fancybox.min.js" defer></script>

	<title>Manga Club</title>
</head>
<body>
<header>
	<div class="container">
		<div class="row mt-3">
			<div class="col-4 text-center">
				<div>
					<select name="Toms" id="selectToms" class="btn-lg btn-secondary">
						<?
							for($i = 0; $i < $tomsCount; $i++)
							{
								$count = $i+1;
								echo '<option value="Tom'.$count.'">Том '. $count .'</option >';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-4 text-center">
				<div>
					<select name="chapters" id="selectChapters" class="btn-lg btn-secondary">
						<option value="1">Глава 1</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</header>
<nav class="fixed-top m-3">
	<a href="/"><i class="fas fa-home"></i></a>
	<br>
	<a class="backPage"><i class="fas fa-arrow-circle-left"></i></a>
</nav>
<div class="container">
	<div class="album py-5">
		<div class="container">
			<div id='content' class="row">
				<div class="col-md-2">
					<div class="card bg-secondary mb-4 box-shadow">
						<a data-fancybox="gallery" href="/view/content/tokyo_ghoul/Tom1/1/01.jpg">
							<img
									class="card-img-top"
									data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
									alt="" style="height: auto;  display: block;"
									src="/view/content/tokyo_ghoul/Tom1/1/01.jpg" data-holder-rendered="true">
						</a>

						<div class="card-body p-2">
							<h6 class="card-text text-center"></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
