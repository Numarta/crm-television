<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "review_status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Review[] $reviews
 */
class ReviewStatus extends \yii\db\ActiveRecord
{
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'review_status';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
	 * Метод, реализующий выборку данных по логической связи "Reviews".
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id_review_status' => 'id']);
    }
}
