<?php ///[yii2-tag]

/**
 * Yii2 tag
 *
 * @link        http://www.brainbook.cc
 * @see         https://github.com/yongtiger/yii2-tag
 * @author      Tiger Yong <tigeryang.brainbook@outlook.com>
 * @copyright   Copyright (c) 2017 BrainBook.CC
 * @license     http://opensource.org/licenses/MIT
 */

namespace yongtiger\tag;

use Yii;

/**
 * Class Module
 *
 * @package yongtiger\tag
 */
class Module extends \yii\base\Module
{
    /**
     * @var string module name
     */
    public static $moduleName = 'tag';

    /**
     * @var string table name
     */
    public $tagTableName = '{{%tag}}';

    /**
     * @var string table name
     */
    public $articlePostTagAssnTableName = '{{%article_post_tag_assn}}';

    /**
     * @var string Post model class name
     */
    public $postModelClass;

    /**
     * @return static
     */
    public static function instance()
    {
        return Yii::$app->getModule(static::$moduleName);
    }

    /**
     * Registers the translation files.
     */
    public static function registerTranslations()
    {
        ///[i18n]
        ///if no setup the component i18n, use setup in this module.
        if (!isset(Yii::$app->i18n->translations['extensions/yongtiger/yii2-tag/*']) && !isset(Yii::$app->i18n->translations['extensions/yongtiger/yii2-tag'])) {
            Yii::$app->i18n->translations['extensions/yongtiger/yii2-tag/*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => '@vendor/yongtiger/yii2-tag/src/messages',
                'fileMap' => [
                    'extensions/yongtiger/yii2-tag/message' => 'message.php',  ///category in Module::t() is message
                ],
            ];
        }
    }

    /**
     * Translates a message. This is just a wrapper of Yii::t().
     *
     * @see http://www.yiiframework.com/doc-2.0/yii-baseyii.html#t()-detail
     *
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        static::registerTranslations();
        return Yii::t('extensions/yongtiger/yii2-tag/' . $category, $message, $params, $language);
    }
}
