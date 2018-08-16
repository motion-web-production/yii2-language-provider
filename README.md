Language provider interface
===========================

This package provides interface for language provider for accessing application languages from any storage for Yii2 Framework.
It's allows to you create multi-language modules for using in Yii2 based application.
As example of integration to module you can see [yii2-email-template](https://github.com/yiimaker/yii2-email-templates) extension.

[![Latest Stable Version](https://img.shields.io/packagist/v/motion/yii2-language-provider.svg)](CHANGELOG.md)
[![Monthly Downloads](https://img.shields.io/packagist/dm/motion/yii2-language-provider.svg)](https://packagist.org/packages/motion/yii2-language-provider)
[![Total Downloads](https://img.shields.io/packagist/dt/motion/yii2-language-provider.svg)](https://packagist.org/packages/motion/yii2-language-provider)
[![Build Status](https://travis-ci.org/motion-web-production/yii2-language-provider.svg?branch=master)](https://travis-ci.org/motion-web-production/yii2-language-provider)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/motion-web-production/yii2-language-provider/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/motion-web-production/yii2-language-provider/?branch=master)

From the box you can use:

* [Config language provider](#config-language-provider)
* [Database language provider](#database-language-provider)

If you want to create your implementation of language provider you should implement interface
`motion\i18n\LanguageProviderInterface`.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require motion/yii2-language-provider
```

or add

```
"motion/yii2-language-provider": "~2.1"
```

to the `require` section of your `composer.json`.

Usage
-----

### Config language provider

|Option            |Description                                       |Type  |Default   |
|------------------|--------------------------------------------------|------|----------|
|languages         |Should contains list of application languages.    |array |`[]`      |
|defaultLanguage   |Should contains default application language.     |array |`[]`      |

#### Example

```php
$config = [
    'languages' => [
        [
            'label' => 'English',
            'locale' => 'en',
        ],
        [
            'label' => 'Ukrainian',
            'locale' => 'uk',
        ],
        [
            'label' => 'Russian',
            'locale' => 'ru',
        ],
    ],
    'defaultLanguage' => [
        'label' => 'English',
        'locale' => 'en',
    ],
];

$provider = new \motion\i18n\ConfigLanguageProvider($config);
$provider->getLanguages(); // returns list of languages
$provider->getDefaultLanguage(); // returns default language
$provider->getLanguageLabel('en'); // returns language label by locale (`English`)
```

### Database language provider

|Option         |Description                                         |Type                                   |Default        |
|---------------|----------------------------------------------------|---------------------------------------|---------------|
|db             |Database connection instance.                       |string, array, `\yii\db\Connection`    |`db`           |
|tableName      |Name of language entity in database.                |string                                 |`language`     |
|localeField    |Name of locale field in language entity.            |string                                 |`locale`       |
|labelField     |Name of label field in language entity.             |string                                 |`label`        |
|defaultField   |Name of field in table with default language flag.  |string                                 |`is_default`   | 


#### Example

```php
$config = [
    'db' => 'secondDb',
    'labelField' => 'title',
];

$provider = new \motion\i18n\DbLanguageProvider($config);
$provider->getLanguages(); // returns list of languages
$provider->getDefaultLanguage(); // returns default language
$provider->getLanguageLabel('uk'); // returns language label by locale
```

Tests
-----

You can run tests with composer command

```
$ composer test
```

or using following command

```
$ codecept build && codecept run
```

Licence
-------

[![License](https://img.shields.io/github/license/motion-web-production/yii2-language-provider.svg)](LICENSE)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2017-2018, Motion Web Production
