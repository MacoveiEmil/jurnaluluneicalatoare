
# Clone & code
Before starting, be sure you have installed [Docker](https://www.docker.com/), an IDE (we are using Visual Studio Code) and a database dump.

Clone the repository and update WordPress submodule.
```
git clone git@github.com:MacoveiEmil/jurnaluluneicalatoare.git

cd jurnaluluneicalatoare

git submodule update --init

docker-compose up -d
```

Create a `wp-config.php` file in the root folder with the following contents:
```php
<?php
$env = getenv( 'ENV' ) ? getenv( 'ENV' ) : 'dev';

define( 'WP_ENV', $env );
if ( file_exists( dirname( __FILE__ ) . '/wp-config-' . $env . '.php' ) ) {
	require_once dirname( __FILE__ ) . '/wp-config-' . $env . '.php';
}
unset( $env );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
```

## Coding Rules

To ensure consistency throughout the source code, keep these rules in mind as you are working:

* Abides by the [WordPress coding standards][wp-coding-standards]:
  * [PHP coding standards][wp-coding-php-standards]
  * [JavaScript coding standards][wp-coding-javascript-standards]
  * [HTML coding standards][wp-coding-html-standards]
  * [CSS coding standards][wp-coding-css-standards]
  * [Documentation standards][wp-documentation-standards]
* All features or bug fixes **must be tested** according to the [Testing guidelines][wp-testing]
  * [GitLab][gitlab] runs automatically all unit tests
* Consider setting the WordPress code style in your IDE.
* We believe in [DRY][dry] and [KISS][kiss] and somewhat in ["Don't Reinvent the Wheel"][dont-reinvent-the-wheel]

## Database update

Put the database dump inside `.docker/docker-entrypoint-initdb.d` folder in .sql format before starting the container to sync with production.

To delete the existent data (if you want just to update your database), you should first delete the database volume:

```
docker-compose down

docker volume rm jurnaluluneicalatoare_db-data

docker-compose up -d
```
[wp-coding-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/
[wp-coding-php-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
[wp-coding-javascript-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/
[wp-coding-html-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/html/
[wp-coding-css-standards]: https://make.wordpress.org/core/handbook/best-practices/coding-standards/css/
[wp-documentation-standards]: https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/
[wp-testing]: https://make.wordpress.org/core/handbook/testing/automated-testing/phpunit/
[gitlab]: https://gitlab.com
[dont-reinvent-the-wheel]: https://blog.codinghorror.com/dont-reinvent-the-wheel-unless-you-plan-on-learning-more-about-wheels/
[dry]: https://en.wikipedia.org/wiki/Don%27t_repeat_yourself
[kiss]: https://en.wikipedia.org/wiki/KISS_principle
