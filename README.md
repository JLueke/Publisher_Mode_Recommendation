# Recommendation
A Publisher Mode to fill an Entry as a recommendation.

The recommendation contains
    - a title
    - a message (required)
    - an URL
    - a date (for scheduled publishing)

Please note: Not every Entry supports scheduled publishing.

# Installation
The recommended way to install this is through [composer](http://getcomposer.org).

Edit your `composer.json` and add:

```json
{
    "require": {
        "publisher/recommendation": "dev-master"
    }
}
```

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```