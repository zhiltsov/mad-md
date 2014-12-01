#MadMD, Markdown CMS

```php
<?php
// web/index.php
require_once __DIR__ . '/../vendor/autoload.php';

echo \MadMD\Application::getInstance();
```
Works with PHP 5.4 or later.


## Installation
Just create a `composer.json` file:
```json
{
    "require": {
        "zhiltsov/MadMD": "dev-master"
    }
}
```

## Skeleton
```
/
├── md/
|   └── index.md
├── templates/
|   └── default.html.twig
├── vendor/
└── web/
    ├── css/
    ├── js/
    └── index.php
```

##License
MIT license.