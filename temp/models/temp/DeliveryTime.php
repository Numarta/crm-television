<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_time".
 *
 * @property int $id Идентификатор
 * @property string $begin_time Начало периода
 * @property string $end_time Окончание периода
 *
 * @property Delivery[] $deliveries
 */
class DeliveryTime extends \yii\db\ActiveRecord
{
	public static function ToText () {
		$result = '';
		foreach (DeliveryTime::find()->all() as $item) {
			if ($result != '')
				$result .= ', ';
			$result .= $item->title;
		}
		return $result;
	}
	
	public function getTitle () {		
		return  \Yii::$app->formatter->asTime($this->begin_time) . ' - ' . \Yii::$app->formatter->asTime($this->end_time);
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'begin_time' => Yii::t('app', 'Begin Time'),
            'end_time' => Yii::t('app', 'End Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveries()
    {
        return $this->hasMany(Delivery::className(), ['id_delivery_time' => 'id']);
    }
}
