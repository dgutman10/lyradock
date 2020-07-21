[![Build Status](https://travis-ci.org/dgutman10/lyradock.svg?branch=master)](https://travis-ci.org/dgutman10/lyradock)

## Lyradock

[Run with docker](https://hub.docker.com/repository/docker/dgutman/lyradock)

##### Add this helper function in your .bash_profile

```
lyradock() {
	docker volume inspect lyradock > /dev/null 2>&1
	if [ $? -ne 0 ]; then
		echo "Se ha creado el siguiente volumen en docker para persistencia de datos..."
		docker volume create lyradock 
	fi
	docker run -it --rm -v /var/run/docker.sock:/var/run/docker.sock -v lyradock:/app/storage --env CWD=$PWD dgutman/lyradock $@
}

```