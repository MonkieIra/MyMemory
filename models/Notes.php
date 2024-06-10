<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property int $mood_id
 * @property string $text
 * @property string|null $img
 * @property string|null $audio
 *
 * @property Mood $mood
 * @property Statictic[] $statictics
 * @property User $user
 */
class Notes extends \yii\db\ActiveRecord
{

    public $imageFile;
    public $audioFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'mood_id', 'text'], 'required'],
            [['user_id', 'mood_id', 'frequency'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string'],
            [['img', 'audio'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['audioFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3, wav'],
            [['mood_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mood::class, 'targetAttribute' => ['mood_id' => 'id']],
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
            'mood_id' => 'Как прошел день?',
            'text' => 'Текст',
            'img' => 'Изображение',
            'imageFile' =>'Изображение',
            'audio' => 'Аудио',
            'audioFile' => 'Аудиофайл',
        ];
    }

    /**
     * Gets query for [[Mood]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMood()
    {
        return $this->hasOne(Mood::class, ['id' => 'mood_id']);
    }

    /**
     * Gets query for [[Statictics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatictics()
    {
        return $this->hasMany(Statictic::class, ['notes_id' => 'id']);
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

    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile) {
                $this->img = $this->imageFile->baseName . '.' . $this->imageFile->extension; 
                $this->imageFile->saveAs('uploads/' . $this->img);
            }
            
            if ($this->audioFile) {
                $this->audio = $this->audioFile->baseName . '.' . $this->audioFile->extension; 
                $this->audioFile->saveAs('uploads/' . $this->audio);
            }
            
            $this->save(false);
            return true;
        } else {
            return false;
        }
    }    


    public static function statistic($currentUserId)
{
    $currentDate = date('Y-m-d');

    $firstDayOfMonth = date('Y-m-01');


    $statistic = (new \yii\db\Query())
        ->select(['mood_id', 'COUNT(*) as frequency'])
        ->from('notes')
        ->where(['user_id' => $currentUserId]) 
        ->andWhere(['>=', 'date', $firstDayOfMonth]) 
        ->andWhere(['<=', 'date', $currentDate]) 
        ->groupBy('mood_id')
        ->orderBy('frequency DESC')
        ->limit(5) 
        ->all();

    return $statistic;
}
}
