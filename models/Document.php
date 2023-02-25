<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * Класс, реализующий модель для таблицы базы данных "document".
 *
 * @property int $id
 * @property string $registration_date
 * @property string $title
 * @property string $description
 * @property int $id_document_type
 * @property string $file_name
 * @property int $size
 * @property int $id_user
 *
 * @property User $user
 * @property DocumentType $documentType
 */
class Document extends \yii\db\ActiveRecord
{
	public $file;
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
            [['registration_date'], 'safe'],
            [['description'], 'string'],
            [['id_document_type', 'size', 'id_user'], 'integer'],
            [['title', 'file_name'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_document_type'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['id_document_type' => 'id']],
        ];
    }

    /**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'id_document_type' => Yii::t('app', 'Id Document Type'),
            'file_name' => Yii::t('app', 'File Name'),
            'size' => Yii::t('app', 'Size'),
            'id_user' => Yii::t('app', 'Id User'),
			'file' => Yii::t('app', 'File'),
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "User".
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "DocumentType".
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'id_document_type']);
    }
	
	public function UploadFile ()
	{		
		$file = UploadedFile::getInstances($this, 'file');							
		if (count ($file) > 0)
		{				
			$file = $file[0];		
				//print_r ($file);
				//exit();
			$uploaddir = Yii::getAlias(Yii::$app->params['ContentDirectory']) . '/';				
			if (file_exists($uploaddir) == false)			
				mkdir ($uploaddir, 0777, true);												
			$file_name = $uploaddir . $this->id . '.data';										
			if (!$file->saveAs ($file_name)) 
			{	
				throw new \yii\base\UserException (Yii::t('app', 'File not uploaded'));											
			} 	
			$this->file_name = $file->baseName . '.' . $file->extension;
			$this->size = $file->size;
			$this->save();												
		}
	}
}
