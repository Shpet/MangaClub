<?php
	include ROOT . '/view/layouts/header.php';
?>

	<link rel="stylesheet" href="/view/css/register.css">
<?php
	if(!$res && $name != ''):
?>
		<h1 class="denied">Имя "<?=$name ?>" не найдено</h1>
		<?php
		endif;
		?>
	<div class="container">

		<form action="#" method="post" id="main_form">
			<h1>Изменение</h1>
			<div class="row">
				<div class="col-4 pr-0">
					<label for="name">Название манги: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="name" name="name" type="text" placeholder="Укажите точное название">
				</div>
			</div>
			<div class="row">
				<div class="col-7 offset-4">
					<input name="update" type="submit" value="Измененить" class="btn btn-light w-100 mt-3">
				</div>
			</div>
		</form>
	</div>
<?php
	include ROOT . '/view/layouts/footer.php';

?>