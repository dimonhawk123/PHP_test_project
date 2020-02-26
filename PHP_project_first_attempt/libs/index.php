<?php   

    $site = [
        "siteName" => "Рыжков",
        "logo" => "../libs/star.png",
        "name" => "Рыжков Д.В.",
        "email" => "ryzhkov.eecs@gmail.com",
    ];

    class Pages {

        function __construct()
        {
            foreach ($this->pages as $key => $val) {
                if (strpos($_SERVER['SCRIPT_NAME'], $key) !== false) {
                    $this->page = $this->pages[$key];
                    break;  
                }                
            }            
        }

        public $page;

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

        public function getPages() {
            return $this->pages;
        }

        public function search(string $str = null) {
            $tmp_arr = [];
            
            if (isset($str)) {
                foreach ($this->pages as $key => $val) {
                    if (mb_strtolower($str, "UTF-8") == mb_strtolower($val["name"], "UTF-8")) {                        
                        $tmp_arr[] = $this->pages[$key];
                    }
                }
                return $tmp_arr;
            } else {
                return $tmp_arr;
            }
        }

        private $allowedTypes = [
            //jpg, jpeg, png
            "image/jpeg",
            "image/png",
            "image/pjpeg",
            "image/jpg",
        ];

        public function sendForm($name, $email, $file, $site) {
            $errors = [];
            $cheaked = false;
            
            if (empty($name)) {
                $errors[] = "Введите ФИО!";
            }
            if (empty($email)) {
                $errors[] = "Введите email!";
            }
            if (!empty($file["size"])) {
                foreach ($this->allowedTypes as $val) {
                    if($file["type"] == $val) {
                        $cheaked = !$cheaked;
                        break;
                    }
                }
                if ($cheaked === false) {
                    $errors[] = "Тип документа не поддерживается!";
                }
            }
            if(count($errors) == 0) {
                $new_file = $_SERVER["DOCUMENT_ROOT"]."/upload/".basename($file["name"]);
                if (!$file["error"]) {
                    move_uploaded_file($file["tmp_name"], $new_file);
                }

                $message = "С сайта siteName отправлено сообщение:\r\n
                ФИО: ".$name."\r\n
                E-mail: ".$email."\r\n
                Файл: ".$new_file."\r\n";
                //день, месяц, год, час, минуту и секунду                
                $file_name = "msg_".date("d.m.Y_H-i-s").".txt";
                $file_root = $_SERVER["DOCUMENT_ROOT"]."/emails/".$file_name;
                
                $fp = fopen($file_root, "w");
                fwrite($fp, $message);
                fclose($fp);
                 
                $subject = "Вам сообщение с сайта siteName";
                mail($site, $subject, $message); 
            }
            $_POST["name"] = [];
            $_POST["email"] = [];
            $_FILES["file"] = [];

            return $errors;
        }
    };

    $pageObj = new Pages;
?>