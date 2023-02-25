<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "service_material".
 *
 * @property int $id
 * @property int $id_service
 * @property int $id_material
 * @property double $amount
 *
 * @property Material $material
 * @property Service $service
 */
class ServiceMaterial extends \yii\db\ActiveRecord
{
	
	public function getTitle () {
		$material = $this->material;
		if (empty($this->material))
			return $this->id;		
		return $this->material->title;
	}
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'service_material';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['id_service', 'id_material'], 'integer'],
            [['amount'], 'number'],
            [['id_material'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['id_material' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['id_service' => 'id']],
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_service' => Yii::t('app', 'Id Service'),
            'id_material' => Yii::t('app', 'Id Material'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Material".
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'id_material']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Service".
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }
}
