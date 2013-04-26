<center>
    <form method="post">
        <img src="captcha.php" alt="Captcha"><br>
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