<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $file_name
 * @property integer $size
 * @property integer $height
 * @property integer $width
 * @property integer $check_sum
 * @property integer $id_user
 */
class Image extends \yii\db\ActiveRecord
{

	public function getImageAddress ()
	{
		return Yii::$app->params['ImageDirectoryAddress'] . '/' . $this->file_name;		
	}
	
	public function getThumbImageAddress ()
	{
		return Yii::$app->params['ThumbImageDirectoryAddress'] . '/' . $this->file_name;		
	}


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'height', 'width', 'check_sum', 'id_user'], 'integer'],
            [['file_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_name' => Yii::t('app', 'File Name'),
            'size' => Yii::t('app', 'Size'),
            'height' => Yii::t('app', 'Height'),
            'width' => Yii::t('app', 'Width'),
            'check_sum' => Yii::t('app', 'Check Sum'),
            'id_user' => Yii::t('app', 'Id User'),
        ];
    }

    /**
     * @inheritdoc
     * @return ImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImageQuery(get_called_class());
    }
}
