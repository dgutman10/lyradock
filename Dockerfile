FROM webdevops/php:7.2

COPY . /app

COPY --from=library/docker:latest /usr/local/bin/docker /usr/local/bin/docker

RUN apt-get update && apt-get install -y \
    curl

RUN curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
RUN chmod +x /usr/local/bin/docker-compose

WORKDIR /app

ENTRYPOINT ["php", "./console.php"]