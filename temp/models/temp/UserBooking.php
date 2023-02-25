<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\base\UserException;


/**
 * Класс, реализующий модель для таблицы базы данных "product".
 *
 * @property int $id Идентификатор
 * @property string $title Название
 * @property string $description Описание
 * @property string $image_file_name Имя файла изображения товара
 * @property double $cost Стоимость
 * @property bool $available Есть в наличии
 *
 * @property BookingItem[] $bookingItems
 * @property ProductCost[] $productCosts
 */
class UserBooking extends Model
{
	
	public $delivery_date;
	public $delivery_address;
	public $note;
	public $size;
	public $id_delivery_time;
	
	/*
	* Метод создания заказа из корзины.
	*/
	public function CreateBooking ($items) {
		
		$total_cost = null;
		foreach ($items as $item) {
			$total_cost += $item->total;
		}
		
		$booking = new Booking ();
		$booking->registration_date = date('Y-m-d H:i:s');
		$booking->total_cost = $total_cost;
		$booking->delivery_address = $this->delivery_address;
		$booking->delivery_date = $this->delivery_date;
		$booking->id_delivery_time = $this->id_delivery_time;		
		//$booking->id_user = Yii::$app->user->identity->id;
		$booking->note = $this->note;
		$booking->id_booking_status = 1;
		$booking->id_delivery = null;
		$booking->save();
		
		foreach ($items as $item) {
			$booking_item = new BookingItem ();
			$booking_item->id_booking = $booking->id;
			$booking_item->id_product = $item->id_product;
			$booking_item->amount = $item->amount;
			$booking_item->cost = $item->cost;
			$booking_item->save();
		}
		
		return $booking;
	}
	

	
	/**
     * Метод, реализующий валидацию даты доставки.
     */
	public function ValidateDeliveryDate ($attribute, $params) {		

		try
		{
			Booking::ValidateDeliveryDateWithException ($this->$attribute);
		}
		catch (\Exception $e)
		{
			$this->addError($attribute, $e->getMessage());	
		}
	}
	
	/*
	* Метод вычисления суммы по товару
	*/
	public function getTotal () {
		return $this->amount * $this->cost;
	}
	
    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['delivery_date'], 'safe'],   
			[['delivery_address', 'note'], 'string'], 
			[['size', 'id_delivery_time'], 'integer', 'min' => 1],
			[['delivery_date', 'id_delivery_time', 'delivery_address', 'size'], 'required'],
			['delivery_date', 'ValidateDeliveryDate'],
			[['id_delivery_time'], 'exist', 'skipOnError' => true, 'targetClass' => DeliveryTime::className(), 'targetAttribute' => ['id_delivery_time' => 'id']],
			
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'delivery_address' => Yii::t('app', 'Delivery Address'),
            'note' => Yii::t('app', 'Note'),
			'size' => Yii::t('app', 'Products In Basket'),
			'id_delivery_time' => Yii::t('app', 'Id Delivery Time'),
			
        ];
    }

   
}
