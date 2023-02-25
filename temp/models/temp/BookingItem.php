<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_item".
 *
 * @property int $id Идентификатор
 * @property int $id_booking Идентификатор заказа
 * @property int $id_product Идентификатор товара
 * @property int $amount Количество
 * @property double $cost Стоимость
 *
 * @property Product $product
 * @property Booking $booking
 */
class BookingItem extends \yii\db\ActiveRecord
{
	
	/**
     * Название элемента заказа
     */
	public function getTitle () {
		$product = $this->product;
		if ($product != null)
			return $this->product->title;
		return $this->id;
	}
	
	/*
	* Метод вычисления суммы по товару
	*/
	public function getTotal () {
		return $this->amount * $this->cost;
	}
	
	/*
	* Метод вычисления цены товара от количества
	*/
	public function beforeSave($insert) {
		if (parent::beforeSave($insert)) {
 
			$product = $this->product;
			$this->cost = $product->getCostByAmount($this->amount);
			return true;
		}
		return false;
	}
	/*
	* Пересчет стоимости заказа
	*/
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);	

		$booking = $this->booking;
		if ($booking != null)
			$booking->ComputeCost();				
	}
	
	public function afterDelete() {  
		$this->booking->ComputeCost();
		return parent::afterDelete();
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_booking', 'id_product', 'amount'], 'integer'],
            [['cost'], 'number'],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['id_product' => 'id']],
            [['id_booking'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['id_booking' => 'id']],
			
			[['amount'], 'integer', 'min' => 1],
			[['id_product', 'amount'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_booking' => Yii::t('app', 'Id Booking'),
            'id_product' => Yii::t('app', 'Id Product'),
            'amount' => Yii::t('app', 'Amount'),
            'cost' => Yii::t('app', 'Cost'),
			'total' => Yii::t('app', 'Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'id_booking']);
    }
}
