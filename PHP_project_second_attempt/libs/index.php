<?php   
    //массив с основной информацией сайта 
    $site = [
        "siteName" => "Рыжков",
        "logo" => "../libs/star.png",
        "name" => "Рыжков Д.В.",
        "email" => "ryzhkov.eecs@gmail.com",
    ];

    class Pages {
        function __construct()
        {            
            //определение текущей страницы
            $now_page = str_replace("/", "", $_SERVER['SCRIPT_NAME']);
            if(isset($this->pages[$now_page])) {
                $this->page = $this->pages[$now_page];

                //если заходим на страницу поиска 
                if ($this->page["file"] == "search.php") {
                    if (isset($_POST["q"]) && $_POST["q"]) {
                        $search = trim($_POST["q"]);
                        $search = htmlspecialchars($search);
                        if($search) {
                            // устанавливаем cookie 
                            setcookie("search", $search);
                            $this->search = $search;
                        }                        
                    } else {
                        //если зашли на страницу - нужно вернуть значение в поле поиска
                        if (isset($_COOKIE["search"]) && $_COOKIE["search"]) {
                            $q = trim($_COOKIE["search"]);
                            $q = htmlspecialchars($q);
                            if ($q) {
                                $this->search = $q;
                            }
                        }
                    }
                }

            }
        }

        // для поля поиска
        public $search = "";

        // для текущей страницы 
        public $page = [];

        // инфомация о страницах 
        private $pages = [
            "about.php" => [
                "file" => "about.php",
                "name" => "О компании",
            ],
            "contacts.php" => [
                "file" => "contacts.php",
                "name" => "Контакты",
            ],
            "index.php" => [
                "file" => "index.php",
                "name" => "Главная",
            ],
            "search.php" => [
                "file" => "search.php",
                "name" => "Поиск",
            ],
        ];

        // разрешенные типы файлов для загрузки 
        private $allowedTypes = [
            //jpg, jpeg, png
            "image/jpeg",
            "image/png",
            "image/pjpeg",
            "image/jpg",
        ];

        //Возвращает массив страницы 
        public function getPages() {
            return $this->pages;
        }
        
        //поиск 
        public function search(string $str = null) {
            $str = trim($str);
            $str = htmlspecialchars($str);
            $tmp_arr = [];
            if (!empty($str)) {
                foreach ($this->pages as $key => $val) {
                    if (strpos(mb_strtolower($val["name"]), mb_strtolower($str)) !== false) {                        
                        $tmp_arr[] = $this->pages[$key];
                    }
                }                
            } 
            return $tmp_arr;            
        }
        
        // отправка формы
        public function sendForm($name, $email, $file, $site, $siteName) { //функция должена принимать массив, а не кучу атрибутов
            $errors = [];
            // проверяем на ошибки
            if (!$_POST["name"]) {
                $errors[] = "Введите ФИО!";
            }
            if (!$_POST["email"]) {
                $errors[] = "Введите email!";
            }     
            if ($_FILES["file"]["error"] == 0) {
                $attach = $_FILES["file"];
                if (!in_array($attach["type"], $this->allowedTypes)) {
                    $errors[] = "Можно загружать только jpg, jpeg, png";
                }
            }
            if(count($errors) == 0) {
                $new_file = $_SERVER["DOCUMENT_ROOT"]."/upload/".basename($file["name"]); 
                
                if (!$file["error"]) {
                    move_uploaded_file($file["tmp_name"], $new_file);
                }
                // формируем сообщение для отправки 
                $message = "С сайта '".$siteName."' отправлено сообщение:\r\n";
                if($name) {
                    $message .= "ФИО: ".$name."\r\n";
                }
                if($email) {
                    $message .= "E-mail: ".$email."\r\n";
                }
                if($file["name"]) {
                    $message .= "Файл: http://codingclass.local/upload/".basename($file["name"])."\r\n";
                }                
                
                //день, месяц, год, час, минуту и секунду                
                $file_name = "msg_".date("d.m.Y_H-i-s").".txt";
                $file_root = $_SERVER["DOCUMENT_ROOT"]."/emails/".$file_name;
                
                // записываем текстровый документ
                $fp = fopen($file_root, "w");
                fwrite($fp, $message);
                fclose($fp);
                 
                $subject = "Вам сообщение с сайта siteName '".$siteName."'.";
                mail($site, $subject, $message); 
            }
            
            return $errors;
        }

    };
    
    $pageObj = new Pages;
?>