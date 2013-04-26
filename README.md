Kapcza
======

Kapcza - captcha verification based on pregenerated animated gif images.
------

Usage:<br>
1. Put background images to ./generator/bg.<br>
2. Run generator script: python kapcza.py.<br>
3. Copy generated images from ./generator/gen/ to ./data/.<br>
4. Set chmod 777 on occurences.txt.<br>
5. File example.php show how to use script on website.<br><br>

Requirements:<br>
- Python (tested on 2.7)
- Imagemagick (tested on 6.7.9-3)
<br><br>

Notes:<br>
Python script is used for generating new captcha sets. Be aware that it may
work couple of minutes and take the lion's share system's resources, so please don't use it on
production environment. It's absolutely ok to generate set on any other machine
and then copy it.