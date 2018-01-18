SubscriptionBundle Example Project (Symfony 4)
==============================================

This project is only an example of the implementation of [http://www.github.com/terox/SubscriptionBundle](SubscriptionBundle).

<img src="https://raw.githubusercontent.com/terox/sf4-subscription-example/master/doc/images/screenshot.png" alt="Screenshot">

## Requeriments

* Docker (to start the development environment).

## Start to test:

Start the development environment
```
$ docker-compose up
```
**Wait some minutes until the environment is downloaded and compiled.**

#### 1. Enter into container:

```sh
$ docker exec -ti terox.sf4.subscription-example.php /bin/bash
```

#### 2. Install project dependencies:
```sh
root@3ee8e902e63b:/var/www/application# composer install
```

#### 3. Create database:
```sh
root@3ee8e902e63b:/var/www/application# bin/console doctrine:schema:update --force
```

#### 3. Fill data with fixtures:
```sh
root@3ee8e902e63b:/var/www/application# bin/console doctrine:fixtures:load
```

#### 4. Test the bundle in your browser:

***http://localhost:8088***