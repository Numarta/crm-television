<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "client".
 *
 * @property int $id Идентификатор
 * @property string $client_id ID клиентского приложения
 * @property string $client_secret Секретный ключ клиентского приложения
 * @property string $redirect_uri Адрес редиректа
 *
 * @property Token[] $tokens
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['client_id', 'client_secret', 'redirect_uri'], 'required'],
           
            [['redirect_uri'], 'string'],
            [['client_id', 'client_secret'], 'string', 'max' => 80],
            [['client_id'], 'unique'],
            
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'client_secret' => Yii::t('app', 'Client Secret'),
            'redirect_uri' => Yii::t('app', 'Redirect Uri'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Tokens".
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['id_client' => 'id']);
    }
}
