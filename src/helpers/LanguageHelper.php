<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017-2018 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n\helpers;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Helper for making work with language provider easily.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 2.1
 */
class LanguageHelper
{
    /**
     * @var \motion\i18n\LanguageProviderInterface
     */
    protected $provider;

    /**
     * @var LanguageHelper
     */
    private static $_instance;


    /**
     * Gets the instance via lazy initialization.
     *
     * @return LanguageHelper
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
            self::$_instance->provider = Yii::$container->get('motion\i18n\LanguageProviderInterface');
        }

        return self::$_instance;
    }

    /**
     * Returns list of languages.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->provider->getLanguages();
    }

    /**
     * Returns default application language.
     *
     * @return array
     */
    public function getDefault()
    {
        return $this->provider->getDefaultLanguage();
    }

    /**
     * Returns language label.
     *
     * @param null|string $locale By default uses current application language.
     *
     * @return string
     */
    public function getLabel($locale = null)
    {
        $locale = null === $locale ? Yii::$app->language : $locale;

        return $this->provider->getLanguageLabel($locale);
    }

    /**
     * Returns language locales.
     *
     * @return array
     */
    public function getLocales()
    {
        return ArrayHelper::getColumn($this->provider->getLanguages(), 'locale');
    }

    /**
     * Is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from getInstance() instead.
     */
    private function __construct()
    {
    }

    /**
     * Prevent the instance from being cloned (which would create a second instance of it).
     */
    private function __clone()
    {
    }

    /**
     * Prevent from being unserialized (which would create a second instance of it).
     */
    private function __wakeup()
    {
    }
}
