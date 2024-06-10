<?php

namespace app\models;
use Yii;

use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $birthday;
    public $hobbie_id;
    public $username;
    public $password;

    public $role_id = 1;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['name', 'email', 'birthday', 'hobbie_id',  'username', 'password'], 'required'],
            [['birthday'], 'safe'],
            [['birthday'], 'validateBirthday'],
            [['hobbie_id', 'role_id'], 'integer'],
            [['name', 'username'], 'string', 'max' => 255],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            [['hobbie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hobbie::class, 'targetAttribute' => ['hobbie_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRole::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Почта',
            'birthday' => 'День рождения',
            'hobbie_id' => 'Хобби',
            'role_id' => 'Роль',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
        ];
    }

    public function register()
{
    if ($this->validate()) {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->birthday = $this->birthday;
        $user->hobbie_id = $this->hobbie_id;
        $user->role_id = $this->role_id;
        $user->username = $this->username;
        $user->password = $this->password; 
        if ($user->save()) {
            Yii::$app->user->login($user);
            return true;
        }
    }
    return false;
}

public function validateBirthday($attribute, $params)
{
    $birthday = new \DateTime($this->$attribute);
    $today = new \DateTime();
    $age = $today->diff($birthday)->y;

    if ($age < 5) {
        $this->addError($attribute, 'Вы должны быть старше 5 лет.');
    }
}

}
