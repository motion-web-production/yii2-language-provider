<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n\tests\unit\helpers;

use Yii;
use motion\i18n\tests\unit\TestCase;
use motion\i18n\ConfigLanguageProvider;
use motion\i18n\helpers\LanguageHelper;
use yii\helpers\ArrayHelper;

/**
 * Test case for language helper.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 2.1
 */
class LanguageHelperTest extends TestCase
{
    /**
     * @var array
     */
    private $languages = [
        ['locale' => 'en', 'label' => 'English'],
        ['locale' => 'uk', 'label' => 'Ukrainian'],
        ['locale' => 'fr', 'label' => 'French'],
    ];
    /**
     * @var array
     */
    private $defaultLanguage = ['locale' => 'en', 'label' => 'English'];


    /**
     * @inheritdoc
     */
    protected function _before()
    {
        Yii::$container->set('motion\i18n\LanguageProviderInterface', [
            'class' => ConfigLanguageProvider::className(),
            'languages' => $this->languages,
            'defaultLanguage' => $this->defaultLanguage,
        ]);
    }

    public function testGetAll()
    {
        $this->assertSame($this->languages, LanguageHelper::getInstance()->getAll());
    }

    public function testGetDefault()
    {
        $this->assertSame($this->defaultLanguage, LanguageHelper::getInstance()->getDefault());
    }

    public function testGetLabel()
    {
        $this->assertSame('French', LanguageHelper::getInstance()->getLabel('fr'));
        $this->assertSame('Ukrainian', LanguageHelper::getInstance()->getLabel('uk'));
        $this->assertSame('English', LanguageHelper::getInstance()->getLabel('en'));
    }

    public function testGetLocales()
    {
        $this->assertSame(
            ArrayHelper::getColumn($this->languages, 'locale'),
            LanguageHelper::getInstance()->getLocales()
        );
    }
}
