<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hashtag".
 *
 * @property int $id
 * @property string $hashtag
 *
 * @property Articles[] $articles
 */
class Hashtag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hashtag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hashtag'], 'required'],
            [['hashtag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hashtag' => 'Hashtag',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::class, ['hastag_id' => 'id']);
    }
}
