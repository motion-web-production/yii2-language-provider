<?php
/**
 * @link https://github.com/motion/yii2-language-provider
 * @copyright Copyright (c) 2017-2018 Motion Web Production
 * @license BSD 3-Clause License
 */

namespace motion\i18n;

/**
 * Interface for language provider.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
interface LanguageProviderInterface
{
    /**
     * Method should returns list of languages in following format:
     * each item of this list it's array with `label` and `locale` keys,
     * in `label` key should be a language label for displaying in view,
     * in `locale` key should be a language locale. It is recommended that you
     * use [IETF language tags](http://en.wikipedia.org/wiki/IETF_language_tag).
     *
     * @example
     * ```php
     * return [
     *      [
     *          'label' => 'English',
     *          'locale' => 'en-US',
     *      ],
     *      // other languages ...
     * ];
     * ```
     *
     * @return array
     */
    public function getLanguages();

    /**
     * Method should returns a default language of application.
     *
     * @example
     * ```php
     * return [
     *      'label' => 'English',
     *      'locale' => 'en-US',
     * ];
     * ```
     *
     * @return array
     */
    public function getDefaultLanguage();

    /**
     * Method should returns label for concrete language.
     *
     * @param string $locale Language locale.
     *
     * @return mixed
     */
    public function getLanguageLabel($locale);
}
