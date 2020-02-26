<?php //отредактировать вывод формы, использовать checked
	require_once 'templates/header.php';	
?>		
		<h2>Форма</h2>
		<? 
			// проверяем имеются ли ошибки 
			$check = true;
			if (!empty($_POST)) {
				$errors = $pageObj->sendForm(htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["email"]), $_FILES["file"], $site["email"], $site["siteName"]);
				if (!empty($errors)) {		
					$name = htmlspecialchars($_POST["name"]);		
					$email = htmlspecialchars($_POST["email"]);
		?>
		<div class="errors">
			<? foreach ($errors as $error) { ?>
				<?=$error?><br/>
			<? } ?>
		</div>
		<? } else { 
			$check = false;
		?>
		Спасибо, форма отправлена!
		<? }
		} ?>

		<? if ($check) { ?>
		<form enctype="multipart/form-data" action="contacts.php" method="POST">
			ФИО <br />
			<input type="text" name = "name" value = "<?= $name?>" /><br />
			Email <br />
			<input type="email" name = "email" placeholder = "Email" value = "<?= $email?>" /><br />
			Файл для загрузки <br />
			<input type="file" name = "file" /><br />
			<input type="submit" name = "send" value="Отправить" /><br />
		</form>
		<? } ?>
	
<?php 
	require_once 'templates/footer.php';
?>