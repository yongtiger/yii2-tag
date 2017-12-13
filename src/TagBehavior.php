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

use yii\base\Behavior;
use yii\validators\Validator;
use yongtiger\tag\models\Tag;
use yongtiger\tag\models\PostTagAssn;

/**
 * Class TagBehavior
 *
 * @package yongtiger\tag
 */
class TagBehavior extends Behavior
{
    /**
     * @inheritdoc
     */
    public function attach($owner)
    {
        parent::attach($owner);

        if (isset(\Yii::$app->getModule('article')->postBehaviors['taggable'])) {
            $validator = Validator::createValidator('safe', $owner, 'tagValues');
            $owner->validators->append($validator);
            // $owner->validators[] = $validator;   ///alternative
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->owner->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable(Module::instance()->articlePostTagAssnTableName, ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTagAssns()
    {
        return $this->owner->hasMany(PostTagAssn::className(), ['post_id' => 'id']);
    }
}
