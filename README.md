[![Build Status](https://travis-ci.org/dgutman10/lyradock.svg?branch=master)](https://travis-ci.org/dgutman10/lyradock)

## Lyradock

[Run with docker](https://hub.docker.com/repository/docker/dgutman/lyradock)

##### Add this helper function in your .bash_profile

```
lyradock() {
	docker run -it -v /var/run/docker.sock:/var/run/docker.sock --env CWD=$PWD dgutman/lyradock $@
}
```