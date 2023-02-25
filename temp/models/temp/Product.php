<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class ProductInfo 
{
	public $date;
	public $amount;
	public $id_product;
	public $forecast;
}

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
class Product extends \yii\db\ActiveRecord
{
	public $image;	
	
	/*
	* Метод вычисления цены товара от его количества
	*/
	public function getCostByAmount ($amount) {
		$result = $this->cost;
		$model = ProductCost::find ()->andWhere(['id_product' => $this->id])->andWhere('amount_min <= :amount and :amount <= amount_max')->params([':amount' => $amount])->one();
		if ($model != null)
			$result = $model->cost;		
		return $result;
	}
	
	/*
	* Метод получения истории цены товара
	*/
	public function getProductCostHistory ($now, $size) {
			
		$start = date('Y-m-d', strtotime($now . ' -' . ($size - 1) . ' day'));	
		$data = [];		
		for ($i = 0; $i < $size; $i ++) {
			$model = new ProductInfo ();
			$data[] = $model;
			$model->id_product = $this->id;
			$model->now = date('Y-m-d', strtotime($start . ' +' . $i . ' day'));		
			$model->amount = 0;
			
			$product_amount = BookingItem::find()
			->leftJoin('booking', 'booking.id = booking_item.id_booking')			
			->andWhere(['id_product' => $this->id])
			->andWhere('date(registration_date) = date(:now)', [':now' => $model->now])->sum('amount');
			
			if (!empty($product_amount)) {
				$model->amount = $product_amount;
			}						
		}		
		return $data;
	}
	
	/*
	* Метод вычисления прогноза
	*/
	public function getProductCostForecast ($now, $size, $forecast, $alpha = 0.6, $beta = 0.3) {			
						
		$dataset = $this->getProductCostHistory ($now, $size, $forecast);
		$forecastset = [];
		{
		
			$a_ = null;
			$b_ = 0;
			$y_ = 0;
			$y = null;
			$k = 0;		
		
			foreach ($dataset as $data) 
			{
				$y = $data->amount;
				
				if (is_null($a_))
					$a_ = $y;		
				// Экспоненциально-сглаженный ряд
				$a = $alpha * $y + (1 - $alpha) * ($a_ + $b_);
				// Определяем значение тренда
				$b = $beta * ($a - $a_) + (1 - $beta) * $b_;						
			
				$a_ = $a;
				$b_ = $b;
				$y_ = $y;				
			}
		
			for ($i = 1; $i <= $forecast; $i ++) 
			{										
				if (!isset($forecastset[$i])) {
					$data = new ProductInfo();		
					$data->now = date('Y-m-d', strtotime($now . ' +' . $i . ' day'));											
					$data->id_product = $this->id;
					$data->forecast = true;
					$forecastset[$i] = $data;
				}
				$data = $forecastset[$i];				
				$y = $a + $b * $i;	
				$data->amount = round($y);					
			}
		}		
		return array_merge($dataset, $forecastset);
	}
	
	/**
     * Метод, возвращает адрес изображения товара
     */
	public function getImage_url ()
	{
		if (!empty ($this->image_file_name))
			return Yii::$app->params['ImageDirectoryAddress'] . '/' . $this->id . '/' . $this->image_file_name;	
		return null;
	}
	
	/**
     * Метод загрузки изображения товара
     */
	public function UploadImage ()
	{		
		$image = UploadedFile::getInstances($this, 'image');							
		if (count ($image) > 0)
		{	
			$image = $image[0];			
			$uploaddir = Yii::$app->params['ImageDirectory']  . '/' . $this->id . '/';				
			if (file_exists($uploaddir) == false)			
				mkdir ($uploaddir, 0777, true);												
			$file_name = $uploaddir . $image->baseName . '.' . $image->extension;						
			if (!$image->saveAs ($file_name)) 
			{	
					
				throw new \yii\base\UserException (Yii::t('app', 'File not uploaded'));											
			}	
			$this->image_file_name = $image->baseName . '.' . $image->extension;
			$this->save();												
		}
	}
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['cost'], 'number'],
            [['available'], 'boolean'],
            [['title', 'image_file_name'], 'string', 'max' => 255],
			['image', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif', 'maxFiles' => 1],
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
            'description' => Yii::t('app', 'Description'),
            'image_file_name' => Yii::t('app', 'Image File Name'),
			'image_url' => Yii::t('app', 'Image File Name'),
            'cost' => Yii::t('app', 'Cost'),
            'available' => Yii::t('app', 'Available'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "BookingItems".
     * @return \yii\db\ActiveQuery
     */
    public function getBookingItems()
    {
        return $this->hasMany(BookingItem::className(), ['id_product' => 'id']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "ProductCosts".
     * @return \yii\db\ActiveQuery
     */
    public function getProductCosts()
    {
        return $this->hasMany(ProductCost::className(), ['id_product' => 'id']);
    }
}
