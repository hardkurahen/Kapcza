<?php
/*
 * Kapcza - captcha verification based on pregenerated animated gif images.
 * Usage: $capcha = new Captcha();
 */

    $my_captcha = new Captcha();

    class Captcha
    {

        function __construct()
        {
            $this->Initialize();
            $this->Get_Data();
        }

        private function Initialize()
        {
            session_start();
            header('Content-Type: image/gif');
        }

        private function Get_Data()
        {
            $captcha_array = glob("data/{*.gif}", GLOB_BRACE);
            /* temporary (this will be replaced with randomizing without repetition mechanism) */
            shuffle($captcha_array);
            $captcha = $captcha_array[array_rand($captcha_array)];
            /* end of temporary section */

            $captcha_code = basename($captcha, '.gif');
            $_SESSION['security_code'] = $captcha_code;
            $this->Display($captcha);
        }

        public function Display($captcha)
        {
            $this->captcha_content = file_get_contents($captcha);
            echo $this->captcha_content;
        }

    }



?>