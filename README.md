# Recommendation
A Publisher Mode to fill an Entry as a recommendation.

The recommendation contains
    - a title
    - a message (required)
    - an URL

# Installation
The recommended way to install this is through [composer](http://getcomposer.org).

Edit your `composer.json` and add:

```json
{
    "require": {
        "publisher/mode_recommendation": "dev-master"
    }
}
```

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

# Form (symfony/form)
You can find a symfony form in src/Recommendation/Form/Type/
and a twig template in Resources/view/.

# Validation with symfony/validator
A general validation config for the entity is provided in Resources/config/validation.yml.
For futher configuration please refer to the packages that implement the entities.

# EntryModeEntity Packages that implement this mode
- publisher/entity_facebook_recommendation
- publisher/entity_twitter_recommendation
- publisher/entity_xing_recommendation