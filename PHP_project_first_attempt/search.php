<?php 
	require_once 'templates/header.php';
	// получаем массив совпадений используя метод "search" класса "Pages"
	$result = $pageObj->search(htmlspecialchars($_POST["q"]));
?>

	<div class="content">
		<?php
			// выводим массив совпадений
			if (count($result) > 0) { ?>
				Найдено страниц: <?= count($result)?> <br />
			<ol>
			<?php
				foreach($result as $val) { ?>
					<li><a href=<?= $val["file"]?>> <?=$val["name"]?> </a></li>
				<?php }
				} else { ?>
				Ничего не найдено, попробуйте другой запрос!
			<?php } ?>			
	</div>	

<?php 
	require_once 'templates/footer.php';
?>