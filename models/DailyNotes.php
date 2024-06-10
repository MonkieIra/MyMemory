<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dailyNotes".
 *
 * @property int $id
 * @property string|null $img
 * @property string $text
 * @property string $author
 * @property string $date
 * @property int $hobbie_id
 *
 * @property Hobbie $hobbie
 */
class DailyNotes extends \yii\db\ActiveRecord
{
    
    
   
   
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dailyNotes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'author', 'date', 'hobbie_id', 'imageFile'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['date'], 'safe'],
            [['hobbie_id'], 'integer'],
            [['img', 'text', 'author'], 'string', 'max' => 255],
            [['hobbie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hobbie::class, 'targetAttribute' => ['hobbie_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Изображение',
            'imageFile' =>'Изображение',
            'text' => 'Текст',
            'author' => 'Автор',
            'date' => 'Дата',
            'hobbie_id' => 'Хобби',
        ];
    }

    /**
     * Gets query for [[Hobbie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHobbie()
    {
        return $this->hasOne(Hobbie::class, ['id' => 'hobbie_id']);
        
    }
    public function upload()
    {
        $this->img = $this->imageFile->baseName . '.' . $this->imageFile->extension; 
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->save(false);
            return true;
            } else {
                return false;
            }
        } 
}
