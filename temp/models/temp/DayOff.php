<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day_off".
 *
 * @property int $id Идентификатор
 * @property string $day Дата
 */
class DayOff extends \yii\db\ActiveRecord
{
	
	public function getTitle () {
		if (empty ($this->day))
			return null;
		return  \Yii::$app->formatter->asDate($this->day);
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'day_off';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          
            [['day'], 'safe'],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'day' => Yii::t('app', 'Day'),
        ];
    }
}
