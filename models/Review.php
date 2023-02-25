<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "review".
 *
 * @property int $id
 * @property string $registration_date
 * @property string $description
 * @property int $id_user
 * @property int $id_review_status
 *
 * @property ReviewStatus $reviewStatus
 * @property User $user
 */
class Review extends \yii\db\ActiveRecord
{
	
	public function getTitle () {
		return "Отзыв #" . $this->id;
	}
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['registration_date'], 'safe'],
            [['description'], 'string'],
            [['id_user', 'id_review_status'], 'integer'],
            [['id_review_status'], 'exist', 'skipOnError' => true, 'targetClass' => ReviewStatus::className(), 'targetAttribute' => ['id_review_status' => 'id']],
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
            'registration_date' => Yii::t('app', 'Registration Date'),
            'description' => Yii::t('app', 'Content'),
            'id_user' => Yii::t('app', 'Id User'),
            'id_review_status' => Yii::t('app', 'Id Review Status'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "ReviewStatus".
     * @return \yii\db\ActiveQuery
     */
    public function getReviewStatus()
    {
        return $this->hasOne(ReviewStatus::className(), ['id' => 'id_review_status']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "User".
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
