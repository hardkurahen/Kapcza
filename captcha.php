<?php
/*
 * Kapcza - captcha verification based on pregenerated animated gif images.
 * Usage: $capcha = new Captcha();
 */

    $main = new Captcha();

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
            $this->captcha_array = glob("data/{*.gif}", GLOB_BRACE);
            $number_of_captchas = count(scandir('data/')) - 2;
            $captcha = $this->Get_Random_Captcha();

            while ($this->Save_Captcha($captcha) == 0)
            {
                if ($number_of_captchas >= $this->Count_Used())
                {
                    $captcha = $this->Get_Random_Captcha();
                }
                else
                {
                    file_put_contents('occurences.txt', '');
                    break;
                }
            }

            $this->Display($captcha);
            $_SESSION['security_code'] = $this->Get_Strict_Code($captcha);
        }

        private function Count_Used()
        {
            $number_of_lines = 0;
            $occurences = fopen('occurences.txt', "r");
            while(!feof($occurences))
            {
                $line = fgets($occurences);
                $number_of_lines++;
            }
            fclose($occurences);
            return $number_of_lines;
        }

        private function Get_Random_Captcha()
        {
            $captcha = $this->captcha_array[array_rand($this->captcha_array)];
            return $captcha;
        }

        private function Get_Strict_Code($captcha)
        {
            return basename($captcha, '.gif');
        }

        private function Save_Captcha($captcha_to_check)
        {
            $occurences  = file_get_contents('occurences.txt');
            if (strpos($occurences, $captcha_to_check) == false)
            {
                $occurences .= $captcha_to_check;
                $occurences .= "\r\n";
                file_put_contents('occurences.txt', $occurences);
                return 1;
            }
            else
                return 0;
        }

        public function Display($captcha)
        {
            $this->captcha_content = file_get_contents($captcha);
            echo $this->captcha_content;
        }

    }



?>