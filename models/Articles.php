<?php

namespace app\models;

use Yii;
use app\models\Articles;
use app\models\Rating;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string|null $img_art
 * @property int $hastag_id
 * @property string $title
 * @property string $text
 * @property int $user_id
 *
 * @property FavoriteArticles[] $favoriteArticles
 * @property Hashtag $hastag
 * @property User $user
 */
class Articles extends \yii\db\ActiveRecord

    
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hastag_id', 'title', 'text', 'user_id', 'imageFile'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['hastag_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['img_art', 'title'], 'string', 'max' => 255],
            [['hastag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hashtag::class, 'targetAttribute' => ['hastag_id' => 'id']],
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
            'img_art' => 'Img Art',
            'hastag_id' => 'Хэштег',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'imageFile' =>'Изображение',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[FavoriteArticles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteArticles()
    {
        return $this->hasMany(FavoriteArticles::class, ['article_id' => 'id']);
    }

    public function getRatings()
    {
        return $this->hasMany(Rating::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Hastag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHastag()
    {
        return $this->hasOne(Hashtag::class, ['id' => 'hastag_id']);
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
        $this->img_art = $this->imageFile->baseName . '.' . $this->imageFile->extension; 
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->save(false);
            return true;
            } else {
                return false;
            }
    }   
    
    //РЕЙТИНГ
    public function getAverageRating()
    {
        $ratings = $this->ratings; // Получаем все оценки для данного рецепта
        $totalRating = 0;

        foreach ($ratings as $rating) {
            $totalRating += $rating->rating;
        }

        // Вычисляем средний рейтинг
        $averageRating = count($ratings) > 0 ? $totalRating / count($ratings) : 0;

        return $averageRating;
    }

    // // СТАТЬЯ ДНЯ
    // public static function getArticlesOfTheDay()
    // {
    //     // Получаем все рецепты
    //     $articles = Articles::find()->all();
    
    //     // Инициализируем переменные для рецепта дня и его среднего рейтинга
    //     $articlesOfTheDay = null;
    //     $highestAverageRating = 0;
    
    //     // Проходимся по всем рецептам и ищем рецепт с наивысшим средним рейтингом
    //     foreach ($articles as $articles) {
    //         $averageRating = $articles->getAverageRating(); // Метод, возвращающий средний рейтинг
    //         if ($averageRating > $highestAverageRating) {
    //             $highestAverageRating = $averageRating;
    //             $articlesOfTheDay = $articles;
    //         }
    //     }
    
    //     return $articlesOfTheDay;
    // }
}
