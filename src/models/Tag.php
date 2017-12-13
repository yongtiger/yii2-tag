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
use yongtiger\tag\Module;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 *
 * @property PostTagAssn[] $postTagAssns
 * @property Post[] $posts
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Module::instance()->tagTableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('message', 'ID'),
            'name' => Module::t('message', 'Name'),
            'frequency' => Module::t('message', 'Frequency'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTagAssns()
    {
        return $this->hasMany(PostTagAssn::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Module::instance()->postModelClass, ['id' => 'post_id'])->viaTable(PostTagAssn::tableName(), ['tag_id' => 'id']);
    }
}
