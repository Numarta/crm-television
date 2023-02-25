<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_image".
 *
 * @property integer $id
 * @property integer $id_service
 * @property integer $id_image
 * @property string $title
 * @property string $description
 *
 * @property Service $idService
 * @property Image $idImage
 */
class ServiceImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_service', 'id_image'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_service' => Yii::t('app', 'Id Service'),
            'id_image' => Yii::t('app', 'Id Image'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'id_image']);
    }
}
