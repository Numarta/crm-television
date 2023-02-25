<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "token_type".
 *
 * @property int $id Идентификатор
 * @property string $title Название
 *
 * @property Token[] $tokens
 */
class TokenType extends \yii\db\ActiveRecord
{
	const TOKEN_TYPE_AUTHORIZATION_CODE = 1;
	const TOKEN_TYPE_ACCESS_TOKEN = 2;
	const TOKEN_TYPE_REFRESH_TOKEN = 3;
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'token_type';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Tokens".
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['id_token_type' => 'id']);
    }
}
