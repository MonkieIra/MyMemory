<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hobbie".
 *
 * @property int $id
 * @property string $hobbie
 *
 * @property DailyNotes[] $dailyNotes
 * @property User[] $users
 */
class Hobbie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hobbie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hobbie'], 'required'],
            [['hobbie'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hobbie' => 'Hobbie',
        ];
    }

    /**
     * Gets query for [[DailyNotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDailyNotes()
    {
        return $this->hasMany(DailyNotes::class, ['hobbie_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['hobbie_id' => 'id']);
    }
}
