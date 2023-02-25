<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $title
 * @property double $cost
 * @property string $description
 *
 * @property RequestService[] $requestServices
 * @property ServiceImage[] $serviceImages
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cost'], 'number'],
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
            'title' => Yii::t('app', 'Title'),
            'cost' => Yii::t('app', 'Cost'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestServices()
    {
        return $this->hasMany(RequestService::className(), ['id_service' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceImages()
    {
        return $this->hasMany(ServiceImage::className(), ['id_service' => 'id']);
    }
}
