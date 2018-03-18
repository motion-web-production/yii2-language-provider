<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017-2018 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n\tests\unit;

use motion\i18n\DbLanguageProvider;

/**
 * Test case for database language provider.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class DbLanguageProviderTest extends TestCase
{
    /**
     * @var DbLanguageProvider
     */
    protected $provider;


    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->provider = new DbLanguageProvider();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(
            'motion\i18n\LanguageProviderInterface',
            $this->provider
        );
    }

    public function testGetLanguages()
    {
        $expected = [
            [
                'label' => 'english',
                'locale' => 'en'
            ],
            [
                'label' => 'russian',
                'locale' => 'ru',
            ],
        ];

        $this->assertEquals($expected, $this->provider->getLanguages());
    }

    public function testGetDefaultLanguage()
    {
        $expected = [
            'label' => 'english',
            'locale' => 'en',
        ];

        $this->assertEquals($expected, $this->provider->getDefaultLanguage());
    }

    public function testGetLanguageLabel()
    {
        $this->assertEquals('english', $this->provider->getLanguageLabel('en'));
        $this->assertEquals('russian', $this->provider->getLanguageLabel('ru'));
        $this->assertNull($this->provider->getLanguageLabel('not exists'));
    }
}
