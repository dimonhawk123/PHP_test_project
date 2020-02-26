<?php 
	require_once 'templates/header.php';
	if ((isset($_POST["name"]) && $_POST["name"]) ||
		(isset($_POST["email"]) && $_POST["email"]) 
	) {		
		$resulr_errors = $pageObj->sendForm(htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["email"]), $_FILES["file"], $site["email"]);
	}
?>	
	<div class="content">
		<h2>Форма</h2>
		<?php 			
			if(isset($resulr_errors)) { ?>
			<div class = errors> 
				
		<?php if (count($resulr_errors) > 0) { ?>
			<ul>
		<?php	foreach ($resulr_errors as $val) { ?>
					<li> <?= $val ?> </li>
		<?php	} ?>
			</ul>
		<?php } 
			if (count($resulr_errors) == 0) {  ?>
				Спасибо, форма отправлена!
		<?php	} ?>
			</div>
		<?php
		}
		?>
		<form enctype="multipart/form-data" action="contacts.php" method="POST">
			ФИО<br />
			<input type="text" name = "name" /><br />
			Email<br />
			<input type="email" name = "email" /><br />
			Файл для загрузки<br />
			<input type="file" name = "file" /><br />
			<input type="submit" name = "send" value="Отправить" /><br />
		</form>
	</div>		
	
<?php 
	require_once 'templates/footer.php';
?>