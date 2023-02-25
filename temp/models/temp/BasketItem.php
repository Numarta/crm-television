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
class BasketItem extends Model
{
	public $id;
	public $product;
	public $id_product;
	public $amount;
	public $cost;
	
	
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
			[['id', 'id_product', 'amount'], 'integer'],          
            [['cost'], 'number'],            
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id_product' => Yii::t('app', 'Id Product'),
            'amount' => Yii::t('app', 'Amount'),
            'cost' => Yii::t('app', 'Cost'),
			'total' => Yii::t('app', 'Total'),
        ];
    }

   
}
