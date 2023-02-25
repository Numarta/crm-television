<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "delivery".
 *
 * @property int $id Идентификатор
 * @property string $delivery_date Дата доставки
 * @property int $id_delivery_time Период доставки
 * @property string $note Примечание
 * @property bool $complete Выполнено
 *
 * @property Booking[] $bookings
 * @property DeliveryTime $deliveryTime
 */
class Delivery extends \yii\db\ActiveRecord
{
	
	public function getBooking_count () {
		return Booking::find ()
			->andWhere(['id_delivery' => $this->id])
			->count();
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);		
		$delivery_time = $this->deliveryTime; 
		$bookings = Booking::find ()
			->andWhere(['id_booking_status' => 1, 'cast(delivery_date AS DATE)' => $this->delivery_date, 'id_delivery_time' => $this->id_delivery_time])
			->andWhere('id_delivery is null')
			//->andWhere('((cast(delivery_date AS TIME) >= :begin_time) and (cast(delivery_date AS TIME) <= :end_time))')
			//->params ([':begin_time' => $delivery_time->begin_time, ':end_time' => $delivery_time->end_time])
			->all();
		
		foreach ($bookings as $booking) {
			$booking->id_delivery = $this->id;
			$booking->id_booking_status = 2;
			$booking->save();		
		}		
		
		if ($this->complete) {
			foreach ($this->bookings as $booking) {
				$booking->id_booking_status = 3;
				$booking->save();		
			}	
		}
		else
		{
			foreach ($this->bookings as $booking) {
				$booking->id_booking_status = 2;
				$booking->save();		
			}	
		}
	}
	
	
	/**
     * Название доставки
     */
	public function getTitle () {
		return 'Доставка # ' . $this->id;
	}
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['delivery_date'], 'safe'],
            [['id_delivery_time'], 'integer'],
            [['note'], 'string'],
            [['complete'], 'boolean'],
            [['id_delivery_time'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryTime::className(), 'targetAttribute' => ['id_delivery_time' => 'id']],
			[['id_delivery_time', 'delivery_date'], 'required'],
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'id_delivery_time' => Yii::t('app', 'Id Delivery Time'),
            'note' => Yii::t('app', 'Note'),
            'complete' => Yii::t('app', 'Complete'),
			'booking_count' => Yii::t('app', 'Booking Count'),
			
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Bookings".
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id_delivery' => 'id']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "DeliveryTime".
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryTime()
    {
        return $this->hasOne(DeliveryTime::className(), ['id' => 'id_delivery_time']);
    }
}
