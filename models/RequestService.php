<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_service".
 *
 * @property integer $id
 * @property integer $id_request
 * @property string $registration_date
 * @property integer $id_service
 * @property double $amount
 * @property double $cost
 * @property string $description
 *
 * @property Request $idRequest
 * @property Service $idService
 */
class RequestService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_service';
    }
	
	public function getTitle ()
	{
		return 'Услуга #' . $this->id;
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_request', 'id_service'], 'integer'],
            [['registration_date'], 'safe'],
            [['amount', 'cost', 'total'], 'number'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_request' => Yii::t('app', 'Id Request'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'id_service' => Yii::t('app', 'Id Service'),
            'amount' => Yii::t('app', 'Amount'),
            'cost' => Yii::t('app', 'Cost'),
			'total' => Yii::t('app', 'Total'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'id_request']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdService()
    {
        return $this->hasOne(Service::className(), ['id' => 'id_service']);
    }
}
