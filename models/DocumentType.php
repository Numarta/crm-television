<?php

namespace app\models;

use Yii;

/**
 * Класс, реализующий модель для таблицы базы данных "document_type".
 *
 * @property int $id
 * @property string $title
 *
 * @property Document[] $documents
 */
class DocumentType extends \yii\db\ActiveRecord
{
    /**
     * Название таблицы
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * Метод, задает правила редактирования данных.
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
	 * Метод, реализующий выборку данных по логической связи "Documents".
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['id_document_type' => 'id']);
    }
}
