# Test Api For Consume External Api
Symfony 4.4 project with mongo db 

#START
1. In project directory: ``` docker-compose up -d ```
2. Enter to docker container  ``` docker exec -it (containerId) sh ```
3. composer install

#USAGE
API DOC: http://localhost:8080/api/doc

First please refresh result list to add result games to mongo:

```POST ​/api​/v1​/result​/game​/refresh​/{gameId}```

After this, we can GET result game

```GET ​/api​/v1​/result​/game​/{gameId}```

#TESTS
```./bin/phpunit```