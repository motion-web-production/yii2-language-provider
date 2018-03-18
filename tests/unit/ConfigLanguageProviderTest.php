<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017-2018 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n\tests\unit;

use motion\i18n\ConfigLanguageProvider;

/**
 * Test case for config language provider.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class ConfigLanguageProviderTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf(
            'motion\i18n\LanguageProviderInterface',
            new ConfigLanguageProvider(['languages' => true, 'defaultLanguage' => true])
        );
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitFail1()
    {
        $config['defaultLanguage'] = [
            'label' => 'en',
            'locale' => 'en'
        ];
        new ConfigLanguageProvider($config);
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitFail2()
    {
        $config['languages'] = [
            [
                'label' => 'en',
                'locale' => 'en',
            ],
        ];
        new ConfigLanguageProvider($config);
    }

    public function testGetLanguages()
    {
        $languages = [
            [
                'label' => 'en',
                'locale' => 'en',
            ],
            [
                'label' => 'ru',
                'locale' => 'ru',
            ],
        ];

        $provider = new ConfigLanguageProvider([
            'languages' => $languages,
            'defaultLanguage' => true,
        ]);

        $this->assertEquals($languages, $provider->getLanguages());
    }

    public function testGetDefaultLanguage()
    {
        $defaultLanguage = [
            'label' => 'en',
            'locale' => 'en',
        ];
        $provider = new ConfigLanguageProvider([
            'languages' => true,
            'defaultLanguage' => $defaultLanguage,
        ]);

        $this->assertEquals($defaultLanguage, $provider->getDefaultLanguage());
    }

    public function testGetLanguageLabel()
    {
        $languages = [
            [
                'label' => 'english',
                'locale' => 'en',
            ],
            [
                'label' => 'russian',
                'locale' => 'ru',
            ],
        ];

        $provider = new ConfigLanguageProvider([
            'languages' => $languages,
            'defaultLanguage' => true,
        ]);

        $this->assertEquals('english', $provider->getLanguageLabel('en'));
        $this->assertEquals('russian', $provider->getLanguageLabel('ru'));
        $this->assertNull($provider->getLanguageLabel('not exists'));
    }
}
