<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * 
 */
class ImageLoader extends Model
{
	public $images;  
	public $title;
    public $description;	
	public $id_service;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            ['title', 'string', 'max'=>255],
			['description', 'string'],	
			['id_service', 'integer'],
			['images', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif', 'maxFiles' => 100],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [           
			'images' => Yii::t('app', 'Images'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),	
			'id_service' =>  Yii::t('app', 'Id Service'),	
			
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getIdService()
    {
        return Service::find()->where(['id' => $this->id_service])->one();
    }
	    
}
