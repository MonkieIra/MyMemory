<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property int $user_id
 * @property string $task_text
 * @property string $time
 *
 * @property User $user
 */
class Plans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_text','date', 'time'], 'required'],
            [['user_id'], 'integer'],
            [['time'], 'safe'],
            [['date'], 'safe'],
            [['task_text'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date' => 'Дата',
            'task_text' => 'Текст',
            'time' => 'Время',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
