<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017-2018 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n;

use yii\base\BaseObject;
use yii\base\InvalidConfigException;

/**
 * Config language provider.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class ConfigLanguageProvider extends BaseObject implements LanguageProviderInterface
{
    /**
     * Application languages list.
     *
     * @var array
     */
    public $languages = [];
    /**
     * Default application language.
     *
     * @var array
     */
    public $defaultLanguage = [];


    /**
     * Check whether provider config is correct.
     *
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->languages)) {
            throw new InvalidConfigException("'languages' field cannot be empty");
        }
        if (empty($this->defaultLanguage)) {
            throw new InvalidConfigException("defaultLanguage' field cannot be empty");
        }
    }

    /**
     * @inheritdoc
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @inheritdoc
     */
    public function getDefaultLanguage()
    {
        return $this->defaultLanguage;
    }

    /**
     * @inheritdoc
     */
    public function getLanguageLabel($locale)
    {
        foreach ($this->languages as $language) {
            if ($language['locale'] == $locale) {
                return $language['label'];
            }
        }

        return null;
    }
}
