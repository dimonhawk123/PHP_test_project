<?php    
    require './libs/index.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <title><?= $pageObj->page["name"]; ?> - <?= $site["siteName"];?></title>
</head>
<body>
<div class = "wrap">
    <header>
        <div class="logo">
            <div class="logo_img">
                <img src= <?= $site["logo"];?> alt= <?= $site["siteName"];?> title= <?= $site["siteName"];?> />
            </div>
            <div class="logo_text">
                <a href="/">
                    <?= $site["name"];?>
                </a>
            </div>
        </div>

        <?php
            include 'nav.php';            
        ?>    

        <div>
            <form action = "../search.php" method="POST">
                <input type="text" name = "q" value = "<?= $pageObj->search; ?>" />
                <input type="submit" value = "Поиск" />
            </form>
        </div>
    </header>
    
    <div class="wrapper">
        <h1><?= $pageObj->page["name"]; ?></h1>
        <div class="content">