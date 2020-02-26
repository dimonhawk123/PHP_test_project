<nav>    
	<ul>
        <?php
            foreach ($pageObj->getPages() as $key => $val) { ?>
                <li><a href=<?= ($val["name"] == $pageObj->page["name"]) ? "#" : $val["file"] ?>> <?=$val["name"];?> </a> </li> 
            <?php } ?>
	</ul>
</nav>






