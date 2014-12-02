# MadMD, Markdown CMS

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
        "zhiltsov/mad-md": "dev-master"
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

## Meta Markdown
```html
<!--
@title Title page
@description Description page
@keywords Keywords page
@template Template file name
-->
```

## License
MIT license.

***

![SensioLabsInsight](http://insight.sensiolabs.com/projects/6902374e-4b85-478b-9382-37d66d78f343/big.png)
