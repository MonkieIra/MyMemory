<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $birthday
 * @property int $color_id
 * @property int $hobbie_id
 * @property int $role_id
 * @property string $username
 * @property string $password
 *
 * @property Articles[] $articles
 * @property Color $color
 * @property FavoriteArticles[] $favoriteArticles
 * @property Hobbie $hobbie
 * @property Notes[] $notes
 * @property Plans[] $plans
 * @property UserRole $role
 * @property Statictic[] $statictics
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'birthday', 'hobbie_id', 'role_id', 'username', 'password'], 'required'],
            [['birthday'], 'safe'],
            [['hobbie_id', 'role_id'], 'integer'],
            [['name', 'email', 'username', 'password'], 'string', 'max' => 255],
            [['hobbie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hobbie::class, 'targetAttribute' => ['hobbie_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRole::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Почта',
            'birthday' => 'День рождения',
            'hobbie_id' => 'Хобби',
            'role_id' => 'Роль',
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::class, ['user_id' => 'id']);
    }

    

    /**
     * Gets query for [[FavoriteArticles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteArticles()
    {
        return $this->hasMany(FavoriteArticles::class, ['user_id' => 'id']);
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

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plans::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRole::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Statictics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatictics()
    {
        return $this->hasMany(Statictic::class, ['id_user' => 'id']);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implement findIdentityByAccessToken() method here
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // Implement getAuthKey() method here
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // Implement validateAuthKey() method here
    }
}
