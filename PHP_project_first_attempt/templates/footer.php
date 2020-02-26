</div>
<footer>
    <?php
        require 'nav.php';
    ?>
    <div class="copyright"> <?= $site["siteName"];?> &copy; <?= date("Y");?></div>
</footer>
</div>
<style>
    * {
        box-sizing: border-box;            
    }
    header, footer {
        padding: 10px;
        background: #eee;
    }		
    .errors {
        color: red;
    }
    .wrap {
        padding: 8px;
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    .wrapper {            
        flex: 1;
    }
    body {           
        margin: 0; 
    }
    input {
        margin-bottom: 10px;
    }
        
</style>
</body>
</html>