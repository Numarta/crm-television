<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "material".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property double $cost
 *
 * @property ServiceMaterial[] $serviceMaterials
 */
class Material extends \yii\db\ActiveRecord
{
	
	public function getNecessaryMaterialsAmount ()
	{
		$Q = new Yii\db\Query ();
		return 		
		$Q->		
		select('*')
			->from(['service_material'])
			->leftJoin('material', 'service_material.id_material = material.id')
			->leftJoin('request_service', 'request_service.id_service = service_material.id_service')
			->leftJoin('request', 'request_service.id_request = request.id')
			//->leftJoin('', '')
		->andWhere('material.id = :id')
		->andWhere(['id_request_status' => [1, 2, 3]])
		->params (
			[			
			':id'=> $this->id,
		])->sum('service_material.amount * request_service.amount');
		
	}
	
	public function getNecessaryMaterialsCost ()
	{
		$Q = new Yii\db\Query ();
		return 		
		$Q->		
		select('*')
			->from(['service_material'])
			->leftJoin('material', 'service_material.id_material = material.id')
			->leftJoin('request_service', 'request_service.id_service = service_material.id_service')
			->leftJoin('request', 'request_service.id_request = request.id')
			//->leftJoin('', '')
		->andWhere('material.id = :id')
		->andWhere(['id_request_status' => [1, 2, 3]])
		->params (
			[			
			':id'=> $this->id,
		])->sum('service_material.amount * request_service.amount * material.cost');
	}
	
	public function getUsedMaterialsAmount ()
	{
		$Q = new Yii\db\Query ();
		return 		
		$Q->		
		select('*')
			->from(['service_material'])
			->leftJoin('material', 'service_material.id_material = material.id')
			->leftJoin('request_service', 'request_service.id_service = service_material.id_service')
			->leftJoin('request', 'request_service.id_request = request.id')
			//->leftJoin('', '')
		->andWhere('material.id = :id')
		->andWhere(['id_request_status' => [4]])
		->params (
			[			
			':id'=> $this->id,
		])->sum('service_material.amount * request_service.amount');
		
	}
	
	public function getUsedMaterialsCost ()
	{
		$Q = new Yii\db\Query ();
		return 		
		$Q->		
		select('*')
			->from(['service_material'])
			->leftJoin('material', 'service_material.id_material = material.id')
			->leftJoin('request_service', 'request_service.id_service = service_material.id_service')
			->leftJoin('request', 'request_service.id_request = request.id')
			//->leftJoin('', '')
		->andWhere('material.id = :id')
		->andWhere(['id_request_status' => [4]])
		->params (
			[			
			':id'=> $this->id,
		])->sum('service_material.amount * request_service.amount * material.cost');
	}
	
	
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['cost'], 'number'],
            [['title'], 'string', 'max' => 255],
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
            'cost' => Yii::t('app', 'Cost'),
			'necessaryMaterialsAmount' => Yii::t('app', 'Necessary materials'),
			'necessaryMaterialsCost' => Yii::t('app', 'Necessary materials cost'),
			'usedMaterialsAmount' => Yii::t('app', 'Used materials'),
			'usedMaterialsCost' => Yii::t('app', 'Used materials cost'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "ServiceMaterials".
     * @return \yii\db\ActiveQuery
     */
    public function getServiceMaterials()
    {
        return $this->hasMany(ServiceMaterial::className(), ['id_material' => 'id']);
    }
}
