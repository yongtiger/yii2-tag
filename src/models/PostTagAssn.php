<?php ///[yongtiger/yii2-tag]

/**
 * Yii2 tag
 *
 * @link        http://www.brainbook.cc
 * @see         https://github.com/yongtiger/yii2-tag
 * @author      Tiger Yong <tigeryang.brainbook@outlook.com>
 * @copyright   Copyright (c) 2017 BrainBook.CC
 * @license     http://opensource.org/licenses/MIT
 */

namespace yongtiger\tag\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "post_tag_assn".
 *
 * @property integer $post_id
 * @property integer $tag_id
 *
 * @property Tag $tag
 * @property Post $post
 */
class PostTagAssn extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Module::instance()->articlePostTagTableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::instance()->postModelClass, 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Module::instance()->postModelClass, ['id' => 'post_id']);
    }
}
