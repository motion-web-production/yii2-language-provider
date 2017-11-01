<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n;

use yii\base\Object;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;

/**
 * Database language provider.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class DbLanguageProvider extends Object implements LanguageProviderInterface
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
     * Is default language flag field name in table.
     *
     * @var string
     */
    public $defaultField = 'is_default';

    /**
     * @var array
     */
    protected $languages = [];
    /**
     * @var array
     */
    protected $defaultLanguage = [];


    /**
     * @inheritdoc
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

            $this->defaultLanguage = ($language !== false)
                ? [
                    'locale' => $language[$this->localeField],
                    'label' => $language[$this->labelField]
                ]
                : [];
        }
        return $this->defaultLanguage;
    }

    /**
     * @inheritdoc
     */
    public function getLanguageLabel($locale)
    {
        $languages = $this->getLanguages();
        foreach ($languages as $language) {
            if ($language['locale'] == $locale) {
                return $language['label'];
            }
        }
        return null;
    }
}
