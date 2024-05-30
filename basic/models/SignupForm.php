<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use yii\base\UserException;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
	public $first_name;
	public $middle_name;
	public $last_name;
	public $birthday;	
    public $username;
    public $email;	
    public $password;
	public $password_confirmation;
	public $phone;
	public $id_department;
	public $id_user_function;
	
	
	public function attributeLabels()
    {
        return [         
			'user_type' => Yii::t('app', 'User Type'),
			'id_user_type' => Yii::t('app', 'User Type'),
			'status' => Yii::t('app', 'Status'),
            'username' => Yii::t('app', 'Username'),					
            'id' => Yii::t('app', 'ID'),				
			'last_name'=> Yii::t('app', 'Last Name'),
			'first_name'=> Yii::t('app', 'First Name'),
			'middle_name'=> Yii::t('app', 'Middle Name'),					
			'phone'=> Yii::t('app', 'Phone'),					
			'nikname'=> Yii::t('app', 'Nikname'),		
			'created_at' => Yii::t('app', 'Created At'),	
			'updated_at' => Yii::t('app', 'Updated At'),			
			'password' => Yii::t('app', 'Password'),						
			'password_old' => Yii::t('app', 'Old Password'),
			'password_new' => Yii::t('app', 'New Password'),
			'password_confirmation' => Yii::t('app', 'Password Confirmation'),			
			'id_department'=> Yii::t('app', 'Id Department'),		
			'id_user_function'=> Yii::t('app', 'Id User Function'),		
			'birthday'=> Yii::t('app', 'Birthday'),		
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app', 'This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],			
			['password_confirmation', 'required'],
            ['password_confirmation', 'string', 'min' => 6],
			
			[['first_name', 'middle_name', 'last_name', 'phone'], 'string', 'max' => 255],								
			[['birthday'], 'safe'],			
            [['id_department', 'id_user_function'], 'integer'],				
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {			
			if ($this->password != $this->password_confirmation)			
				throw new UserException ('Пароль и подтверждение пароля не совпадают');					
            $user = new User();
			$user->id_user_type = User::USER_TYPE_USER;
            $user->username = $this->username;
            $user->email = $this->email;
			$user->first_name = $this->first_name;
			$user->middle_name = $this->middle_name;
			$user->last_name = $this->last_name;
			$user->phone = $this->phone;
			$user->birthday = $this->birthday;
			$user->id_department = $this->id_department;
			$user->id_user_function = $this->id_user_function;
			
			
            $user->setPassword($this->password);
            $user->generateAuthKey();
			$user->generateActivationToken();		
			$user->stored_password = $this->password;			
            if ($user->save()) 
			{
				/*
                return \Yii::$app->mailer->compose(['html' => 'activationToken-html', 'text' => 'activationToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject(Yii::t('app', 'Account activation for ') . \Yii::$app->name)
                    ->send();
                //return $user;
				*/
            }
        }

        return null;
    }
}
