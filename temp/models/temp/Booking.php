<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "booking".
 *
 * @property int $id Идентификатор
 * @property string $registration_date Дата/время заказа
 * @property double $total_cost Сумма заказа
 * @property string $delivery_address Адрес доставки
 * @property string $delivery_date Дата/время доставки
 * @property int $id_user Идентификатор пользователя
 * @property string $note Примечание
 * @property int $id_booking_status Статус заказа
 *
 * @property BookingStatus $bookingStatus
 * @property User $user
 * @property BookingItem[] $bookingItems
 * @property DeliveryItem[] $deliveryItems
 * @property Delivery[] $deliveries
 */
class Booking extends \yii\db\ActiveRecord
{
	/**
     * Название заказа
     */
	public function getTitle () {
		return 'Заказ # ' . $this->id;
	}
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'booking';
    }
	
	/**
     * Метод вычисления стоимости заказа.
     */
	public function ComputeCost() {
		$bookingItems = $this->bookingItems;
		$cost = 0;
		foreach ($bookingItems as $item) {
			$cost += $item->total;
		}
		$this->total_cost = $cost;
		$this->save();
		return $cost;
	}
	
	/**
     * Метод, реализующий валидацию даты доставки (выбрасывает исключение Exception).
     */
	public static function ValidateDeliveryDateWithException ($date) {
		$now = date('Y-m-d');
		
		if (strtotime($date) <= strtotime($now)) {
			throw new \Exception ('Вы можете заказать доставку на следующий рабочий день после текущего ('.\Yii::$app->formatter->asDate($now).')');	
		}	
		
		if (DayOff::find()->andWhere(['day' => $date])->count() > 0 || date("N", strtotime($date)) == 7) {
			throw new \Exception ('Выбранная дата является выходным днем');	
		}				
	}
	
	

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['registration_date', 'delivery_date'], 'safe'],
            [['total_cost'], 'number'],
            [['delivery_address', 'note'], 'string'],
            [['id_user', 'id_booking_status', 'id_delivery', 'id_delivery_time'], 'integer'],
            [['id_delivery_time'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryTime::className(), 'targetAttribute' => ['id_delivery_time' => 'id']],
			[['id_booking_status'], 'exist', 'skipOnError' => true, 'targetClass' => BookingStatus::className(), 'targetAttribute' => ['id_booking_status' => 'id']],
			[['id_delivery'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['id_delivery' => 'id']],			
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
			[[/*'id_user',*/ 'id_booking_status', 'delivery_address', 'delivery_date', 'id_delivery_time'], 'required'],			
			//['delivery_date', 'ValidateDeliveryDate'],
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
            'total_cost' => Yii::t('app', 'Total Cost'),
            'delivery_address' => Yii::t('app', 'Delivery Address'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'id_user' => Yii::t('app', 'Id User'),
            'note' => Yii::t('app', 'Note'),
            'id_booking_status' => Yii::t('app', 'Id Booking Status'),
			'id_delivery_time' => Yii::t('app', 'Id Delivery Time'),
			'id_delivery' => Yii::t('app', 'Id Delivery'),
        ];
    }

	/**
	 * Метод, реализующий выборку данных по логической связи "DeliveryTime".
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryTime()
    {
        return $this->hasOne(DeliveryTime::className(), ['id' => 'id_delivery_time']);
    }
	
    /**
	 * Метод, реализующий выборку данных по логической связи "BookingStatus".
     * @return \yii\db\ActiveQuery
     */
    public function getBookingStatus()
    {
        return $this->hasOne(BookingStatus::className(), ['id' => 'id_booking_status']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "User".
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
	
	/**
	 * Метод, реализующий выборку данных по логической связи "Delivery".
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'id_delivery']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "BookingItems".
     * @return \yii\db\ActiveQuery
     */
    public function getBookingItems()
    {
        return $this->hasMany(BookingItem::className(), ['id_booking' => 'id']);
    }

}
