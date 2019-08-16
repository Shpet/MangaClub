<?php
	/**
	 * Created by PhpStorm.
	 * User: Neznayka
	 * Date: 16.08.2019
	 * Time: 12:54
	 */
	include ROOT . '/view/layouts/header.php';
?>
	<link rel="stylesheet" href=/view/css/adminPanel.css>
<div class="container">
	<ul class="panel">
		<li><a href="admin/add" class="btn btn-success">Добавить</a></li>
		<li><a href="admin/update" class="btn btn-light">Изменить</a></li>
		<li><a href="admin/delete" class="btn btn-danger">Удалить</a></li>
	</ul>
</div>


<?php

	include ROOT . '/view/layouts/footer.php';

