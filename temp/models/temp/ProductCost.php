<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "product_cost".
 *
 * @property int $id Идентификатор
 * @property int $id_product Идентификатор товара
 * @property int $amount_min Минимальное количество
 * @property int $amount_max Максимальное количество
 * @property double $cost Стоимость
 */
class ProductCost extends \yii\db\ActiveRecord
{
	public function getTitle () {
		
		
		return $this->cost . ' руб.';
	}
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'product_cost';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['id_product'], 'integer'],
			[['amount_min', 'amount_max'], 'integer', 'min' => 1],
            [['cost'], 'number'],
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_product' => Yii::t('app', 'Id Product'),
            'amount_min' => Yii::t('app', 'Amount Min'),
            'amount_max' => Yii::t('app', 'Amount Max'),
            'cost' => Yii::t('app', 'Cost'),
        ];
    }
}
