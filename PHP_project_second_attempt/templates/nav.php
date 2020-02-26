<?php
    $nav = $pageObj->getPages();
?>
<nav>    
	<ul>
        <?php 
            // выводим меню навигации с помощью метода "getPages" класса "Pages"
            foreach ($nav as $key => $val) { ?>
                <li><a href=<?= ($val["file"] == $pageObj->page["file"]) ? "#" : $val["file"] ?>> <?=$val["name"];?> </a> </li> 
        <?php } ?>
	</ul>
</nav>






