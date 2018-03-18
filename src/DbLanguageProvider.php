<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017-2018 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n;

use yii\base\BaseObject;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;

/**
 * Database language provider.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class DbLanguageProvider extends BaseObject implements LanguageProviderInterface
{
    /**
     * Database connection instance.
     *
     * @var Connection|string|array
     */
    public $db = 'db';
    /**
     * Name of table with languages in database.
     *
     * @var string
     */
    public $tableName = 'language';
    /**
     * Language locale field name in table.
     *
     * @var string
     */
    public $localeField = 'locale';
    /**
     * Language name field name in table.
     *
     * @var string
     */
    public $labelField = 'label';
    /**
     * Name of field in table with default language flag.
     *
     * @var string
     */
    public $defaultField = 'is_default';

    /**
     * @var array Application languages list.
     */
    protected $languages = [];
    /**
     * @var array Default application language.
     */
    protected $defaultLanguage = [];


    /**
     * Get database connection instance.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    /**
     * @inheritdoc
     */
    public function getLanguages()
    {
        if (empty($this->languages)) {
            $languages = (new Query())
                ->select([$this->localeField, $this->labelField])
                ->from($this->tableName)
                ->all($this->db);

            foreach ($languages as $language) {
                $this->languages[] = [
                    'locale' => $language[$this->localeField],
                    'label' => $language[$this->labelField]
                ];
            }
        }

        return $this->languages;
    }

    /**
     * @inheritdoc
     */
    public function getDefaultLanguage()
    {
        if (empty($this->defaultLanguage)) {
            $language = (new Query())
                ->select([$this->localeField, $this->labelField])
                ->from($this->tableName)
                ->where([$this->defaultField => true])
                ->one($this->db);

            if (false !== $language) {
                $this->defaultLanguage = [
                    'locale' => $language[$this->localeField],
                    'label' => $language[$this->labelField]
                ];
            }
        }

        return $this->defaultLanguage;
    }

    /**
     * @inheritdoc
     */
    public function getLanguageLabel($locale)
    {
        foreach ($this->getLanguages() as $language) {
            if ($language['locale'] == $locale) {
                return $language['label'];
            }
        }

        return null;
    }
}
