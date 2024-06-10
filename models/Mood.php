<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mood".
 *
 * @property int $id
 * @property string $mood
 *
 * @property Notes[] $notes
 * @property Statictic[] $statictics
 */
class Mood extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mood';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mood'], 'required'],
            [['mood'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mood' => 'Mood',
        ];
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::class, ['mood_id' => 'id']);
    }

    /**
     * Gets query for [[Statictics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatictics()
    {
        return $this->hasMany(Statictic::class, ['mood_id' => 'id']);
    }
}
