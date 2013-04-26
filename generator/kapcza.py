import os, random, subprocess, glob

class GenerateCaptchaSet:
    def __init__(self):
        self.create_dictionary()
        self.generate()
    def create_dictionary(self):
        captcha_file = open('dictionary.txt')

        self.captcha_list = []

        for line in captcha_file:
            self.captcha_list.append(line.rstrip('\n'))
    def generate(self):
        for captcha in self.captcha_list:
            bg_id = random.choice(glob.glob('bg/*.gif'))

            command_handler = subprocess.Popen('identify -format "%h" '+bg_id, stdout=subprocess.PIPE) 
            (height, err) = command_handler.communicate()
            height = int(height[:3])

            pos_1 = random.randrange(height/2)
            l1 = str(random.randrange(0, 45))
            l2 = str(random.randrange(0, 25))
            l3 = str(random.randrange(45, 90))
            l4 = str(random.randrange(0, 25))

            font_size = random.randrange(16, 20)
            os.system('convert '+bg_id+' -crop 90x25+'+str(pos_1)+'+'+str(pos_1/2)+' +repage \
                        -fill #ffffff33 -stroke #00000033 -strokewidth 2 -draw "line '+l1+','+l2+' '+l3+','+l4+'" \
                        -gravity center -font zektonbo.ttf -fill #ffffff77 -stroke #00000044 -strokewidth 4 -pointsize '+str(font_size)+' \
                        -weight bold -draw "text 0,-1 '+captcha+'" -coalesce -layers OptimizeFrame gen/'+captcha+'.gif ')

GenerateCaptchaSet()