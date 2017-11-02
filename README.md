Language providers kit
======================

Language providers kit for modules based on Yii2 Framework.

[![Build Status](https://travis-ci.org/motion-web-production/yii2-language-provider.svg?branch=master)](https://travis-ci.org/motion-web-production/yii2-language-provider)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/motion-web-production/yii2-language-provider/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/motion-web-production/yii2-language-provider/?branch=master)
[![Total Downloads](https://poser.pugx.org/motion/yii2-language-provider/downloads)](https://packagist.org/packages/motion/yii2-language-provider)
[![Latest Stable Version](https://poser.pugx.org/motion/yii2-language-provider/v/stable)](CHANGELOG.md)
[![Latest Unstable Version](https://poser.pugx.org/motion/yii2-language-provider/v/unstable)](CHANGELOG.md)

This extension provides one interface for languages storage.
From the box you can use:

* Configuration language provider
* Database language provider

If you can create your implementation of language provider you should implement methods
of `motion\i18n\LanguageProviderInterface` interface.

Installation
------------

#### Install package

Run command
```bash
$ composer require motion/yii2-language-provider
```

or add
```json
"motion/yii2-language-provider": "~1.0"
```
to the require section of your `composer.json` file.

Usage
-----

### Config language provider

| Option | Description | Type | Default |
|--------|-------------|------|---------|
| languages | Should contains array with application languages. | array | `[]` |
| defaultLanguage | Should contains default application language. | array | `[]` |

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
$provider->getLanguages(); // returns array with languages
$provider->getDefaultLanguage(); // returns default language in array
$provider->getLanguageLabel('en'); // returns language label by locale (`English`)
```

### Db language provider

| Option | Description | Type | Default |
|--------|-------------|------|---------|
| db | Database connection instance. | string, array, \yii\db\Connection | `db` |
| tableName | Name of language entity in database. | string | `language` |
| localeField | Name of locale field in language entity. | string | `locale` |
| labelField | Name of label field in language entity. | string | `label` |
| defaultField | Is default language flag field name in language entity. | string | `is_default` | 


#### Example

```php
$config = [
    'db' => 'secondDb',
    'labelField' => 'title',
];
$provider = new \motion\i18n\DbLanguageProvider($config);
$provider->getLanguages(); // returns array with languages
$provider->getDefaultLanguage(); // returns default language in array
$provider->getLanguageLabel('uk'); // returns language label by locale
```

Tests
-----
You can run tests with composer command

```bash
$ composer test
```

or using following command

```bash
$ codecept build && codecept run
```

Licence
-------
[![License](https://poser.pugx.org/motion/yii2-language-provider/license)](LICENSE)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2017, Motion Web Production

