<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "token".
 *
 * @property int $id Идентификатор
 * @property string $token Токен доступа (access_token)
 * @property int $expires Срок действия (действует до)
 * @property int $id_client Идентификатор клиентского приложения
 * @property int $id_user Идентификатор пользователя
 * @property int $id_token_type Идентификатор типа токена
 *
 * @property Client $client
 * @property TokenType $tokenType
 * @property User $user
 */
class Token extends \yii\db\ActiveRecord
{
	
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['token', 'expires', 'id_client', 'id_user', 'id_token_type'], 'required'],
            [['expires', 'id_client', 'id_user', 'id_token_type', 'life_time'], 'integer'],
            [['token'], 'string', 'max' => 255],
            [['token'], 'unique'],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id']],
            [['id_token_type'], 'exist', 'skipOnError' => true, 'targetClass' => TokenType::className(), 'targetAttribute' => ['id_token_type' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'token' => Yii::t('app', 'Token'),
            'expires' => Yii::t('app', 'Expires'),
            'id_client' => Yii::t('app', 'Id Client'),
            'id_user' => Yii::t('app', 'Id User'),
            'id_token_type' => Yii::t('app', 'Id Token Type'),
			'life_time' => Yii::t('app', 'Life Time'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Client".
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "TokenType".
     * @return \yii\db\ActiveQuery
     */
    public function getTokenType()
    {
        return $this->hasOne(TokenType::className(), ['id' => 'id_token_type']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "User".
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
	
	
	public function isValidToken()
    {
        return $this->expires >= time();
    }	
	
	public static function Generate ($id_client, $id_token_type, $id_user) {
		$model = new Token();
		switch ($id_token_type) {
			case 1 : 
				$model->life_time = 60 * 5;
			break;
			case 2 : 
				$model->life_time = 60 * 60 * 24 * 10;
			break;
			case 3 : 
				$model->life_time = 60 * 60 * 24 * 10;
			break;
		}				
		$model->token = Yii::$app->security->generateRandomString();
		$model->expires = time() + $model->life_time;
		$model->id_client = $id_client;
		$model->id_user = $id_user;
		$model->id_token_type = $id_token_type;
		$model->save();
		return $model;
	}
	
	
	
}
