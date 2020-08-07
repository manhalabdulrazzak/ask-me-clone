# ask-me-clone
ask-me-clone- question-answer web app +chat real time


what we need to start 

# **Install libraries**

`composer require twig
`\
` composer require annotations
`\
`composer require symfony/maker-bundle --dev
`\
`composer require doctrine form security validation
`\
`php bin/console make:auth
`\
`php bin/console make:registration-form
`\
`composer require cboden/ratchet`

------

Add in composer.json

`"repositories":
[{
	"type": "vcs
"	"url": "https://github.com/simPod/Ratchet.git"
}],`

🔴 Important ! you need add this commends for websocket to allow in dev in Symfony 5
 
`composer require cboden/ratchet:dev-allow-symfony-5
`\
for More Frontend – Javascript chat real time for test 
run this commend

`php bin/console run:websocket-server
`\
\
\


 update : for make social login system  we need install
 \
 \
 \
 
[oauth2-client-bundle](https://github.com/knpuniversity/oauth2-client-bundle)


`composer require knpuniversity/oauth2-client-bundle
`\
\

**You'll need to configure one client for each OAuth2 server
 (GitHub, Facebook, etc) that you want to talk to.**




# and We are done! ❤️

