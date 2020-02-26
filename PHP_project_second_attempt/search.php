<?php 
	require_once 'templates/header.php';
	// получаем массив совпадений используя метод "search" класса "Pages"
	if (isset($_POST["q"]) && $_POST["q"]) {
		$result = $pageObj->search($_POST["q"]);
		$count_result = count($result);
	}

	// выводим массив совпадений
	if ($count_result) { ?>
		Найдено страниц: <?= $count_result?> <br />
	<ol>
	<?php
		foreach($result as $val) { ?>
			<li><a href=<?= $val["file"]?>> <?=$val["name"]?> </a></li>
		<?php }
		} else { ?>
		Ничего не найдено, попробуйте другой запрос!
	<?php } ?>	

<?php 
	require_once 'templates/footer.php';
?>