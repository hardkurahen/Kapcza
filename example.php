<script type="text/javascript">
    function showCaptcha()
    {
        document.getElementById("captcha_image").src = "captcha.php";
    }
</script>

<center>
    <form method="post">
        <a href="javascript:;" onclick="showCaptcha()"><img src="click.png" alt="Captcha" id="captcha_image"></a><br>
        <input type="text" name="captcha"><br>
        <input type="submit" name="submit" value="Sprawdz">
    </form>
    <br>
    <?php
        if(isset($_POST['submit']))
        {
            session_start();
            if($_SESSION['security_code'] != $_POST['captcha']){ 
                echo 'Not ok!'; 
            } else { 
                echo 'Ok!'; 
            }
        } 
    ?>
</center>