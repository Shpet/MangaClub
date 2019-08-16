<?php
	include ROOT . '/view/layouts/header.php';
?>

	<link rel="stylesheet" href="/view/css/register.css">

<?php
	if($res):
		?>
		<h3 class="success">Удаление успешно</h3>

	<?php
	endif;
?>
	<div class="container">

		<form action="#" method="post" id="main_form">
			<h1>Удаление</h1>
			<div class="row">
				<div class="col-3 offset-1">
					<label for="name">Название: </label>
				</div>
				<div class="col-7">
					<input class="w-100" id="name" name="name" type="text">
				</div>
			</div>
			<div class="row">
				<div class="col-7 offset-4">
					<input name="del" type="submit" value="Удалить" class="btn btn-danger w-100 mt-3">
				</div>
			</div>
		</form>
	</div>
<?php
	include ROOT . '/view/layouts/footer.php';

?>