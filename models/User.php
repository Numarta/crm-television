<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	const STATUS_REGISTRED = 1;
	
	const USER_TYPE_ADMIN = 1;
	const USER_TYPE_MANAGER = 2;
	const USER_TYPE_CLIENT = 3;
	
	
	public $password_change = "";			
	public $password_old = "";		
	public $password_new = "";		
	public $password_confirmation = "";	
	public $stored_password;
		
	
		
	
	public function getRequestSum ()
	{
		$Settings = Settings::findOne(Yii::$app->user->identity->id);		
		$Q = new Yii\db\Query ();
		return $Q->select('*')->from(['request'])->where('(id_request_status = 3 or id_request_status = 4) and (id_executor = :id or id_creator = :id)')
		->params (
			[			
			':id'=> $this->id,
		])->Sum('cost');
	}
	
	
	public function getRegistredClientCount ()
	{
		return 0;
	}
	
	public function getRegistredRequestCount ()
	{
		$Settings = Settings::findOne(Yii::$app->user->identity->id);		
		$Q = new Yii\db\Query ();
		return $Q->select('*')->from(['request'])->orWhere('id_creator = :id')->orWhere('id_executor = :id')
		->params (
			[			
			':id'=> $this->id,
		])->Count();
	}
	
	public function getRegistredServicesCount ()
	{
		$Settings = Settings::findOne(Yii::$app->user->identity->id);		
		$Q = new Yii\db\Query ();
		return $Q->select('*')->from(['request_service'])->where('id_creator = :id')
		->params (
			[			
			':id'=> $this->id,
		])->Count();
	}
	
	
	
	public function getIsAdmin ()
	{
		return $this->id_user_type == self::USER_TYPE_ADMIN;		
	}
		
	public function getIsManager ()
	{
		return $this->id_user_type == self::USER_TYPE_MANAGER;		
	}
	
	public function getIsClient ()
	{
		return $this->id_user_type == self::USER_TYPE_CLIENT;		
	}
	
	
	public function getTitle ()
	{
		return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name . ', т.:' . $this->phone;		
	}
	
	public function attributeLabels()
    {
        return [         
			'user_type' => Yii::t('app', 'User Type'),
			'id_user_type' => Yii::t('app', 'User Type'),
			'status' => Yii::t('app', 'Status'),
            'username' => Yii::t('app', 'Username'),					
            'id' => Yii::t('app', 'ID'),	
			//'user_status' => Yii::t('app', 'User Status'),
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
			
			'RequestCountCreated' => Yii::t('app', 'Request Count Created'),
			'RequestCountWorked' => Yii::t('app', 'Request Count Worked'),
			'RequestCountWorking' => Yii::t('app', 'Request Count Working'),
			'RequestCountSended'  => Yii::t('app', 'Request Count Sended'),
			
        ];
    }
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_REGISTRED],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_REGISTRED]],
			
			['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],
						
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => Yii::t('app', 'This email address has already been taken.')],
			
			
            [['password_new', 'password_confirmation'], 'string', 'min' => 6],			
			[['first_name', 'middle_name', 'last_name', 'phone', 'nikname'], 'string', 'max' => 255],			
			[['id_user_type', 'id'], 'integer'],	
			
			[['report_date_1', 'report_date_2'], 'safe'],
			
			
			[['password_new', 'password_confirmation'], 'required', 'on' => 'create'],
			
			
        ];
    }
	
	/*
	public function scenarios()
    {
        return [
            'create' => ['password_new', 'password_confirmation'],
            'update' => ['username', 'email', 'password'],
        ];
    }
	*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

	
	public function getPassword()
    {
        return '';
    }
	
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	
	
	public function generateActivationToken()
    {
        $this->activation_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
	
	
    public function removeActivationToken()
    {
        $this->activation_token = null;
    }
	
	public static function findByActivationToken($token)
    {
        
		if (!static::isActivationTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'activation_token' => $token,
            'status' => self::STATUS_REGISTRED,
        ]);
    }

    public static function isActivationTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.activationTokenExpire'];
        return $timestamp + $expire >= time();
    }

    
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserType()
    {
        return $this->hasOne(UserType::className(), ['id' => 'id_user_type']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
	public function getIdCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'id_country']);
    }
}
